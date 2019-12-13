@extends('layouts.app')

@section('title', 'Edit a Post')

@section('content')

    <form method="POST" action=" {{route('blog_post.update', $blogpost->id)}}">
        @csrf
        @method('PUT')

        <label style="margion-top:10px" for="title">Title: </label>
        <textarea class="form-control" rows='3' type="text" class="" name="title" value="">{{$blogpost->blog_title}}</textarea>

        <label style="margion-top:10px" for="content">Blog content: </label>
        <textarea class="form-control" rows='3' type="textarea" class="" name="content" value="">{{$blogpost->blog_content}}</textarea>

        <button class="btn btn-success" style="margin:30px 0px" type="submit" value="Submit">Save Changes</button>
        {{--<a href="{{ route('blog_post.index') }}">Cancel</a>--}}


    </form>

@endsection

{{--

    --}}
