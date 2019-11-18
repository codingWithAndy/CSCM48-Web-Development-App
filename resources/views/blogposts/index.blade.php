@extends('layouts.app')

@section('title', 'Blog Posts')

@section('content')
    <p>The Blog Posts:</p>
        <ul>
            @foreach ($blogposts as $blogPost)
                <li>{{ $blogPost->blog_title}}</li>
            @endforeach
        </ul>
@endsection