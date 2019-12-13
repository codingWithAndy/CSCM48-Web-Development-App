@extends('layouts.app')


@section('title', 'Blog Post')

@section('content')

<div class="container">
    <div class="card text-center">
        <div class="card-header">
            <h2>{{$blogpost->blog_title}}</h2>
    <label>by: {{$blogpost->blogUser->first_name}} {{$blogpost->blogUser->surname}}</label><br>
    @if ($blogpost->image != null)
            <img src="{{ asset('images/' . $blogpost->image)}}" height="300" width="600"><br>
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

    <h3>Comments:</h3>

    @foreach ($blogpost->blogComments as $comment)
    <div class="media" style="margin-top:20px;">



            <div class="media-body">
                <div class="card">
                    <div class="card-header">
                        <label>Posted by: {{$comment->commentuser->first_name}}</label><br>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$comment->commentuser->first_name}}'s comment is.....</h5>
                        <p class="card-text">{{$comment->comment_for_blog}}</p>
                        <div class="media-right">
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

            </div>


            </div>
            <br>

    </div>
    @endforeach

<div style="margin:50px 0px">
    <form method="POST" action="{{ route('blog_comment.store', $blogpost->id) }}">
        @csrf
        <textarea class="form-control" rows='3' placeholder="Leave a comment...." type="text" name="content" value="{{ old('content') }}" ></textarea> {{--v-model="commentBox"--}}
        <button class="btn btn-success" style="margin-top:10px" type="submit" value="Submit">Save Comment</button>

    </form>
</div>
</div>
@endsection
{{--
@section('scripts')
    <script>
        const app = new Vue({
            el:'#app',
            data: {
                comments: {},
                commentBox: '',
                post:{!! $blogpost->toJson-> !!},
                user:{!! Auth::check() ? Auth:user()->toJson() : ' null' !!}
            },
            mounted(){
                this.getComments();
            },
            methods: {
                getComments(){
                    axios.get('/api/posts/'+this.post.id+'/comments')
                         .then((response) => {
                            this.comments = response.data
                         })
                         .catch(function (error){
                             console.log(error);
                         });
                },
                postComment(){
                        axios.post('/api/posts/'+this.post.id+'/comment', {
                            api_token: this.user.api_token,
                            comment_for_blog: this.commentBox
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
--}}
