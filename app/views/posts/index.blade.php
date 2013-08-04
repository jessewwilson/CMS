@extends('layouts.default')

@section('title')
@parent
Blog
@stop

@section('controls')

<div class="row-fluid">
    <div class="span12">
        <div class="span6">
            <p class="lead">
                Here you may find our blog posts:
            </p>
        </div>
        @if (Sentry::check() && Sentry::getUser()->hasAccess('blog'))
            <div class="span6">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ URL::route('blog.posts.create') }}"><i class="icon-book"></i> New Post</a>
                </div>
            </div>
        @endif
    </div>
<hr>

@stop

@section('content')

@foreach($posts as $post)
<h2>{{ $post->getTitle() }}</h2>
<p>
    <?php $content = $post->getBody(); ?>
    {{ (strlen($content) > 53) ? substr($content,0,50).'...' : $content }}
</p>
<p>
    <a class="btn btn-success" href="{{ URL::route('blog.posts.show', array('posts' => $post->getId())) }}"><i class="icon-file-text"></i> Show Post</a>
    @if (Sentry::check() && Sentry::getUser()->hasAccess('blog'))
         <a class="btn btn-info" href="{{ URL::route('blog.posts.edit', array('posts' => $post->getId())) }}"><i class="icon-edit"></i> Edit Post</a> <a class="btn btn-danger action_confirm" href="{{ URL::route('blog.posts.destroy', array('posts' => $post->getId())) }}" data-token="{{ Session::getToken() }}" data-method="DELETE"><i class="icon-remove"></i> Delete Post</a>
    @endif
</p>
<br>
@endforeach

@stop
