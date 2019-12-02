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
            <li>Posted by: {{$comment->blog_post_id}}</li>
        @endforeach
    </ul>

    <form method="POST" action="{{ route('blog_post.storeComment') }}">
        @csrf
        <p>Content: <input type="text" name="content" value="{{ old('content') }}"/></p>
        <input type="submit" value="Submit"/>
        
    </form>

@endsection
