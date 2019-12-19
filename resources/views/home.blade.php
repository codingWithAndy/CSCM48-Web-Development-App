@extends('layouts.app')

@section('title', 'Welcome Home! ..... Time to write?')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                    display all the user details here!!!!

                    <p>The Blog Posts:</p>
                    <ol>
                        @foreach ($blogposts as $blogPost)
                            @if ($blogPost->blog_user_id == Auth::id())
                                <li>Title: <a href="{{ route('blog_post.show',$blogPost->id)}}">{{ $blogPost->blog_title}}</a> <br/>
                                    comment count: {{ $blogPost->blogComments()->count() }}<br/>
                                    page count: {{ $blogPost->page_view }}<br/>
                                    User ID: {{ $blogPost->bloguser->user->id}}</li>

                                    <form method="POST" action="{{route('blog_post.destroy', $blogPost->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <a href="blog_posts_edit/{{$blogPost->id}}" class="btn btn-warning" style="margin:10px 5px"> Edit</a>
                                    <button class="btn btn-danger" style="margin:10px 5px" type="submit">Delete</button>
                                    </form>
                                </li>
                            @endif
                        @endforeach

                    </ol>

                    {{-- {{$blogposts->links()}} --}}

                    <a class="btn btn-success" style="margin:10px 5px" href="{{ route('blog_post.create') }}">Create a blog post!</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
