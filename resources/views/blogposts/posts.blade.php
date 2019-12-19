@extends('layouts.app')


@section('title', 'Blog Post')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<div class="container">
    <div class="card text-center">
        <div class="card-header">
            <h2>{{$blogpost->blog_title}}</h2>
        <label>by: {{$blogpost->blogUser->first_name}} {{$blogpost->blogUser->surname}} <br/> ID: {{ $bloguser->user->id }}</label><br/>
            @if ($blogpost->image != null)
                <img src="{{ asset('images/' . $blogpost->image)}}" height="300" width="600"/><br/>
            @endif
            <ul>
                Tag(s):
                {{-- Looping through tags and displaying the tag_name --}}
                 @foreach ($blogpost->blogTags as $tag)
                      <label>{{$tag->tag_name ?? 'None'}}, </label>
                @endforeach
            </ul>
        </div>
        <div class="card-body">
                <hr>
            <label>Content: </label><br>
            <p class="lead">
                {{$blogpost->blog_content}}
            </p>
        </div>

        {{-- Checking if the author is logged in the be able to edit post --}}
        <div class="card-footer text-muted">
            @if (Auth::check() != null)
                @if ($blogpost->blog_user_id == auth()->user()->id)
                    <form action="{{route('blog_post.edit', $blogpost->id)}}">
                        @csrf
                        <button class="btn btn-success">Edit Blog</button>
                    </form>
                @endif
            @endif
        </div>
    </div>
{{-- Display Comments --}}
<div>
    @foreach ($blogpost->blogComments as $comment)
        <div class="media" style="margin-top:20px;">
            <div class="media-body">
                <div class="card">
                    <div class="card-header">
                        <label>Posted by: {{$comment->commentuser->first_name}} {{$comment->commentuser->surname}}</label><br>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$comment->commentuser->first_name}}'s comment is.....</h5>
                        <p class="card-text">{{$comment->comment_for_blog}}</p>
                        <div class="media-right">
                            {{-- Auth check to see if comment author is logged in to edit.--}}
                            @if (Auth::check() != null)
                                @if ($comment->commentuser->id == auth()->user()->id)
                                    <form action="{{ route('blog_comment.edit', $comment->id)}}">
                                        @csrf
                                        <button class="btn btn-success">Edit Comment</button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    @endforeach
</div>
    {{-- Create comment area and store button --}}
    <div style="margin:50px 0px" id="root">
        @if (Auth::check() != null)
            <form method="POST" action="{{ route('blog_comment.store', $blogpost->id) }}">
                @csrf
                <textarea class="form-control" rows='3' placeholder="Leave a comment...." type="text" name="content" value="{{ old('content') }}" v-model="commentBox"></textarea>
                <button class="btn btn-success" style="margin-top:10px" type="submit" value="Submit">Save Comment</button>
            </form>
        @else
            {{-- Display if user is not logged in. --}}
            <h4>You must be logged in to submit a comment!</h4> <a href="/login">Login Now >></a>
        @endif

    </div>
</div>

@endsection

@section('scripts')

<script>
    const app = new Vue({
        el: '#root',
        data: {
            comments: {},
            commentBox: '',
            post: {!! $blogpost->toJson() !!},
            user: {!! Auth::check() ? Auth::user()->toJson() : 'null' !!},
        },
        mounted() {
            this.getComments();
        },
        methods: {
            getComments() {
                axios.get('/api/posts/' + this.post.id + '/comments')
                     .then((response) => {
                         this.comments = response.data.comment
                     })
                     .catch(function (error) {
                         console.log(error);
                     });
            },
            postComment() {
                axios.post('/api/posts/' + this.post.id + '/comment', {
                    //api_token: this.user.api_token,
                    content: this.commentBox
                })
                .then((response) => {
                    this.comments.unshift(response.data);
                    this.commentBox = '';
                })
                .catch(function (error) {
                         console.log(error);
                     });
            }
        }
    });
</script>

@endsection
