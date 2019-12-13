@extends('layouts.app')


@section('title', 'Blog Post')

@section('content')

    <div class="row">
        <div class="col-md-8">
            @if ($blogpost->image != null)
                <img src="{{ asset('images/' . $blogpost->image)}}" height="400" width="800"><br>
            @endif
            <h2>{{$blogpost->blog_title}}</h2>
            <label>by: {{$blogpost->blogUser->first_name}} {{$blogpost->blogUser->surname}}</label><br>
            <label>Content: </label><br>
            <p>
                {{$blogpost->blog_content}}
            </p>
        </div>


    </div>
    
    
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul>
                {{-- Looping through tags and displaying the tag_name --}}
                 @foreach ($blogpost->blogTags as $tag)
                      <label>Tag: {{$tag->tag_name ?? 'None'}}</label><br>
                @endforeach
            </ul>
        </div>
    </div>
    
    
    @if ($blogpost->blog_user_id == auth()->user()->id)
        <form action="{{route('blog_post.edit', $blogpost->id)}}">
            @csrf
            <button>Edit blog.</button>
        </form>
        
    @endif
    
    <ul>
        <div class="card-header"><h3>Comments:</h3></div>
        
        @foreach ($blogpost->blogComments as $comment)
            <div class="card-body">
                <label>Comment: {{$comment->comment_for_blog}}</label><br>
                <label>Posted by: {{$comment->commentuser->first_name}}</label><br>
                @if ($comment->commentuser->id == auth()->user()->id)
                     <button>edit comment</button><br>
                @endif

            </div>
            
        @endforeach
    </ul>

    <form method="POST" action="{{ route('blog_comment.store', $blogpost->id) }}"> {{-- changed this line--}}
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
