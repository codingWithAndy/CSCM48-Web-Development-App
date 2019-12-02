@extends('layouts.app')

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
                    <ul>
                        @foreach ($blogposts as $blogPost)
                            @if ($blogPost->blog_user_id == Auth::id())
                                <li>Title: <a href="http://blogsite.test/blog_posts/{{$blogPost->id}}">{{ $blogPost->blog_title}}</a>-> Page views: {{ $blogPost->page_view}}</li>
                            @endif
                        @endforeach

                    </ul>

                    {{-- {{$blogposts->links()}} --}}

                    <a href="{{ route('blog_post.create') }}">Create a blog post!</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
