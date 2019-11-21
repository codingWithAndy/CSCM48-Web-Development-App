@extends('layouts.app')


@section('title', 'Blog Post')

@section('content')
    <ul>
        <li>Title: {{$blogpost->blog_title}}</li>
        <li>Content: {{$blogpost->blog_content}}</li>
        
        {{-- Looping through tags and displaying the tag_name --}}
        @foreach ($blogpost->blogTags as $tag) 
            <li>Tag: {{$tag->tag_name ?? 'None'}}</li>
        @endforeach
    </ul>
    <ul>
        <p>Here are the comments baby!!:</p>
        @foreach ($blogpost->blogComments as $comment) 
            <li>Comment: {{$comment->comment_for_blog}}</li>
        @endforeach
    </ul>

@endsection
