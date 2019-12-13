@extends('layouts.app')

@section('title', 'List of Blog Posts')

@section('content')

    <div class="card text-center">
        <div class="card-header">
            The Blog Posts:
        </div>
    <div class="card-body">
    <h5 class="card-title">Here they are......</h5>
    <p class="card-text">
        <ol style="text-align:left">
            @foreach ($blogposts as $blogPost)
                <li><a href="http://blogsite.test/blog_posts/{{$blogPost->id}}">{{ $blogPost->blog_title}}</a></li>
            @endforeach

        </ol>
    </p>
  </div>
  <div class="card-footer text-muted" >
        <p>{{$blogposts->links()}}</p>
  </div>
</div>

    <a class="btn btn-primary" style ="margin:20px" href="{{ route('blog_post.create') }}">Create a blog post!</a>

    {{--<a href="{{route('blog_posts.create')}}">Create a blog post!</a>--}}

@endsection
