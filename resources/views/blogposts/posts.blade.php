@extends('layouts.app')


@section('title', 'Blog Post')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

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
{{-- Original Comments --}}
<div>
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
                            <br>
                </div>
            </div>
        </div>
    @endforeach
</div>
    <div style="margin:50px 0px">
        @if (Auth::check() != null)
            {{--@if ($blogpost->blog_user_id == auth()->user()->id)--}}
                <form method="POST" action="{{ route('blog_comment.store', $blogpost->id) }}">
                    @csrf
                    <textarea class="form-control" rows='3' placeholder="Leave a comment...." type="text" name="content" value="{{ old('content') }}" ></textarea> {{--v-model="commentBox"--}}
                    <button class="btn btn-success" style="margin-top:10px" type="submit" value="Submit">Save Comment</button>
                </form>
            {{--@endif--}}
        @endif

    </div>

    {{-- Ajax attempt--}}

    <h3>Comments:</h3>
    <div id="root">

        <div style="margin-bottom:50px;" v-if="user">
            <textarea class="form-control" rows="3" name="content" placeholder="Leave a comment" v-model="commentBox"></textarea>
            <button class="btn btn-success" style="margin-top:10px" @click.prevent="postComment">Save Comment</button>
        </div>

        <div v-else>
            <h4>You must be logged in to submit a comment!</h4> <a href="/login">Login Now >></a>
        </div>
        <div class="media" style="margin-top:20px;" v-for="comment in comments">
            <div class="media-left">
                <a href="#">
                    <img class="media-object" src="http://placeimg.com/80/80" alt="...">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">@{{post}} said...</h4>
                <p>
                @{{comment.body}}
                </p>
                <span style="color: #aaa;">on @{{comment.created_at}}</span>
            </div>
        </div>
    </div>

    {{--<div id="root">
        <div class="media" style="margin-top:20px;" v-for="comment in comments">
                <div class="media-body">
                    <div class="card">
                        <div class="card-header">
                            <label>Posted by: @{{comment.name}}</label><br>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">@{{comment.name}}'s comment is.....</h5>
                        <p class="card-text">@{{comment.comment}}</p>
                        <textarea class="form-control" rows='3' placeholder="Leave a comment...." id="content" type="text" name="content" v-model="newComment"></textarea> {{--v-model="commentBox"
                        <button class="btn btn-success update_button" style="margin-top:10px" @click="createComment">Save Comment</button>
                        <div v-else>
                            <h4>You must be logged in to submit a comment!</h4> <a href="/login">Login Now >></a>

                            <div class="media-right">
                                {{--@if (Auth::check() != null)
                                    @if ($blogpost->blogComments()->commentuser->first_name == auth()->user()->id)
                                        <form action="{{ route('blog_comment.edit', $comment->id)}}">
                                            @csrf
                                            <button class="btn btn-success">Edit Comment</button>
                                        </form>

                                   {{-- @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>

            {{-- Create a new blog comments !!!! --}
        <div style="margin:50px 0px" v-if="user">
            {{--@if (Auth::check() != null)--}}
                {{--@if ($blogpost->blog_user_id == auth()->user()->id)--}}
                    {{--<form method="POST" action="{{ route('blog_comment.store', $blogpost->id) }}">--}}
                        {{--@csrf--}
                        <textarea class="form-control" rows='3' placeholder="Leave a comment...." id="content" type="text" name="content" v-model="newComment"></textarea> {{--v-model="commentBox"--}
                        <button class="btn btn-success update_button" style="margin-top:10px" @click="createComment">Save Comment</button>
                        <div v-else>
                            <h4>You must be logged in to submit a comment!</h4> <a href="/login">Login Now >></a>
                        </div>
                    </form>
                {{--@endif
            @endif--}

        </div>
    </div>--}}
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
                         this.comments = response.data
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
{{--
<script>
    var app = new Vue({
        el: "#root",
        data: {
            comment: [''],
            newComment: '',
        },
        mounted(){
            this.getComment();
        },
        methods: {
            getComment: function() {
                axios.get("{{ route('api.comments.index', '$blogpost->id') }}")
                    .then(response => {
                        this.comment = response.data;
                    })
                    .catch(response => {
                        console.log(response);
                    })
            },
            createComment: function () {
                axios.post("{{ route('api.comment.store', '$blogpost->id') }}", {
                    commentContent: this.newComment
                })
                .then(response => {
                    console.log(response);
                    this.comment.push(response.data);
                    this.newComment = '';
                })
                .catch(response => {
                    console.log(response);
                })

            }
        }
    });
</script>

@endsection
{{--
@section('scripts')
  <script>
      const app = new Vue({
          el: '#app',
          data: {
              comments: {},
              commentBox: '',
              post: {!! $blogpost->toJson() !!},
              user: {!! Auth::check() ? Auth::user()->toJson() : 'null' !!}
          },
          mounted() {
              this.getComments();
          },
          methods: {
              getComments() {
                  axios.get('/api/posts/'+this.post.id+'/comments')
                       .then((response) => {
                           this.comments = response.data
                       })
                       .catch(function (error) {
                           console.log(error);
                       }
                  );
              },
              postComment() {
                  axios.post('/api/posts/'+this.post.id+'/comment', {
                      api_token: this.user.api_token,
                      comment_for_blog: this.commentBox
                  })
                  .then((response) => {
                      this.comments.unshift(response.data);
                      this.commentBox = '';
                  })
                  .catch((error) => {
                      console.log(error);
                  })
              }
          }
      })
  </script>
@endsection
--}}
