@extends('layouts.app')

@section('title', 'Create a Post')

@section('content')
    <form method="POST" action="{{ route('blog_post.store') }}">
        @csrf

    <p>Title: <input type="text" name="title" value="{{ old('title') }}"/></p>
        <p>Content: <input type="text" name="content" value="{{ old('content') }}"/></p>
        <p>Tag 1: <input type="text" name="tag1" value="{{ old('tag1') }}"/></p>
        <p>Tag 2: <input type="text" name="tag2" value="{{ old('tag2') }}"/></p>
        <p>Tag 3: <input type="text" name="tag3" value="{{ old('tag3') }}"/></p>
        <input type="submit" value="Submit"/>
        <a href="{{ route('blog_post.index') }}">Cancel</a>


    </form>

@endsection
