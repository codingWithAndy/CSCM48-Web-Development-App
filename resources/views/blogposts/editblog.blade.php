@extends('layouts.app')

@section('title', 'Edit a Post')

@section('content')

    <form method="PUT" action=" route('blog_post.update', $blogpost->id)">
        @csrf
        {{--@method('PUT')--}}

        <p>Title: <input type="text" name="title" value="{{ $blogpost->blog_title }}"/></p>
        <p>Content: <input type="text" name="content" value="{{ $blogpost->blog_content}}"/></p>
        @php
            $i = 1   
        @endphp
        @foreach ($blogpost->blogTags as $tag)

            <p>Tag {{$i}}: <input type="text" name="tag[{{$i}}]]" value="{{$tag->tag_name ?? 'None'}}"/></p>
            @php
                $i = $i + 1   
            @endphp
        @endforeach
        
        <input type="submit" value="Submit"/>
        {{--<a href="{{ route('blog_post.index') }}">Cancel</a>--}}


    </form>

@endsection

{{--

    --}}