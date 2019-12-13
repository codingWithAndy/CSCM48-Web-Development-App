@extends('layouts.app')

@section('title', 'Create a Post')

@section('content')
    <form method="POST" action="{{ route('blog_post.store') }}" enctype="multipart/form-data">
        @csrf

        <label for="title">Title: </label><br>
        <textarea type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Enter title here...."></textarea>

        <br>

        <p>Please selcet up to 3 Tags:</p>
        <select name="tags[]" class="form-control" multiple="multiple">

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

        <label for="content">Content: </label> <br>
        <textarea type="textarea" class="form-control" name="content" value="{{ old('content') }}" placeholder="Enter blog here...."></textarea>

        <br>


        <label for="featured_image">Upload Featured Image: </label><br>
        <input class="btn btn-success" style="margin-top:10px" type="file" name="featured_image" id="featured_image">

        <br>
        <input class="btn btn-primary" style="margin:10px 20px 30px 20px" type="submit" value="Submit"/>
        <a class="btn btn-danger" style="margin:10px 20px 30px 20px"  href="{{ route('blog_post.index') }}">Cancel</a>


    </form>

@endsection

{{--
    <p>Tag 1: <input type="text" name="tag1" value="{{ old('tag1') }}"/></p>
        <p>Tag 2: <input type="text" name="tag2" value="{{ old('tag2') }}"/></p>
        <p>Tag 3: <input type="text" name="tag3" value="{{ old('tag3') }}"/></p>
    --}}
