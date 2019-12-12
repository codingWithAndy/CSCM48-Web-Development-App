@extends('layouts.app')

@section('title', 'Blog Posts')

@section('content')
    <p>The Blog Posts:</p>
        <ul>
            @foreach ($blogpost as $blogPost)
                <li><a href="http://blogsite.test/blog_posts/{{$blogPost->id}}">{{ $blogPost->blog_title}}</li></a>
            @endforeach

        </ul>

    {{$blogpost->links()}}

    <a href="{{ route('blog_post.create') }}">Create a blog post!</a>

    {{--<a href="{{route('blog_posts.create')}}">Create a blog post!</a>--}}

@endsection
