@extends('layouts.app')

@section('title', 'Create a Post')

@section('content')
    <form method="POST" action="{{ route('blog_post.store') }}">
        @csrf

        <p>Title: <input type="text" name="title"/></p>
        <p>Content: <input type="text" name="content"/></p>
        <p>Tag 1: <input type="text" name="tag1"/></p>
        <p>Tag 2: <input type="text" name="tag2"/></p>
        <p>Tag 3: <input type="text" name="tag3"/></p>
        <input type="submit" value="Submit"/>
        <a href="{{ route('blog_post.index') }}">Cancel</a>


    </form>

@endsection
