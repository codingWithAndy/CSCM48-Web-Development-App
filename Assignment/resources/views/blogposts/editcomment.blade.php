@extends('layouts.app')

@section('title', 'Edit a Comment')

@section('content')

    <form method="POST" action=" {{route('blog_comment.update', $comment->id)}}">
        @csrf
        @method('PUT')

        <label for="title">Conetent: </label><br>
        <textarea class="form-control" rows='3' type="textarea" name="comment" value="">{{$comment->comment_for_blog}}</textarea>

        <button class="btn btn-success" style="margin:30px 0px" type="submit" value="Submit">Save Changes</button>
        {{--<a href="{{ route('blog_post.index') }}">Cancel</a>--}}


    </form>

@endsection

{{--

    --}}
