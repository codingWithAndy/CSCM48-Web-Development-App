@extends('layouts.app')

@section('title', 'Edit a Post')

@section('content')

    <form method="POST" action=" {{route('blog_post.update', $blogpost->id)}}">
        @csrf
        @method('PUT')

        <label for="title">Title: </label>
        <input type="text" class="" name="title" value="{{$blogpost->blog_title}}"/>

        <label for="content">Title: </label>
        <input type="textarea" class="" name="content" value="{{$blogpost->blog_content}}"/>

        <button type="submit" value="Submit">Save Changes</button>
        {{--<a href="{{ route('blog_post.index') }}">Cancel</a>--}}


    </form>

@endsection

{{--

    --}}