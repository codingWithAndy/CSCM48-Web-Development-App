@extends('layouts.app')


@section('title', 'Blog Post')

@section('content')
    <ul>
        <li>Title: {{$blogpost->blog_title}}</li>
        by: {{$blogpost->blogUser->first_name}} {{$blogpost->blogUser->surname}}
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
            <li>Posted by: {{$comment->commentuser->first_name}}</li>
        @endforeach
    </ul>

    <form method="POST" action="{{ route('blog_post.storeComment') }}">
        @csrf
        <p>Content: <input type="text" name="content" value="{{ old('content') }}"/></p>
        <input type="submit" value="Submit"/>
        
    </form>

    {{--
    <script>
        let visitCount = document.getElementById('postVisitedCount').value;

        let $formVar = $('form');

        $.ajax({
            url: $formVar.prop('{{ route('posts.update'), ['id'=>$id]) }}'),
            method: 'PUT',
            data: $formVar.serialize()
        });

    </script>
--}}
@endsection
