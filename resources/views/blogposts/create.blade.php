@extends('layouts.app')

@section('title', 'Create a Post')

@section('content')
    <form method="POST" action="{{ route('blog_post.store') }}" enctype="multipart/form-data">
        @csrf

        <label for="title">Title: </label><br>
        <input type="text" class="" name="title" value="{{ old('title') }}"/>

        <br>

        <label for="content">Content: </label> <br>
        <input type="textarea" class="" name="content" value="{{ old('content') }}"/>

        <br>

        <select name="tags[]" multiple="multiple">
            @foreach($tags as $tag)
            <option value="{{ $tag->id }}">
                @if ($tag->id == old('tag_id'))
                    selected="selected"
                @endif
                > {{ $tag->tag_name}}
            </option>
            @endforeach
        </select>
        <br>

        <label for="featured_image">Upload Featured Image: </label><br>
        <input type="file" name="featured_image" id="featured_image">

        <br>
        <input type="submit" value="Submit"/>
        <a href="{{ route('blog_post.index') }}">Cancel</a>


    </form>

@endsection

{{--
    <p>Tag 1: <input type="text" name="tag1" value="{{ old('tag1') }}"/></p>
        <p>Tag 2: <input type="text" name="tag2" value="{{ old('tag2') }}"/></p>
        <p>Tag 3: <input type="text" name="tag3" value="{{ old('tag3') }}"/></p>
    --}}