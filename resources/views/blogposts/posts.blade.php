@extends('layouts.app')


@section('title', 'Blog Post')

@section('content')
    <ul>
        <li>Title: {{$blogpost->blog_title}}</li>
        <li>Content: {{$blogpost->blog_content}}</li>
        <li>Tag(s): {{$blogpost->tags ?? 'None'}}</li>
    </ul>
    <ul>
        <p>Here are the comments baby!!:</p>
       @foreach ($blogpost->blogComments() as $comment) 
            <li>Comment: {{$comment->comment_for_blog}}</li>
        @endforeach
    </ul>

@endsection
