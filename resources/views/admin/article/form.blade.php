@extends('backend')

@section('form')

	@include('partials.error')
	<div class="row form-group">
		<div class="col-md-2">
			{!! Form::label('title', 'Judul', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-10">
			{!! Form::text('title', $article->title, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-2">
			{!! Form::label('slug', 'Slug', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-10">
			{!! Form::text('slug', $article->slug, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-2">
			{!! Form::label('permalink', 'Permalink', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-10">
			{!! Form::text('permalink', $article->permalink ? $article->permalink->permalink : '', ['class' => 'form-control', 'placeholder' => url('path/sebagai/permalink')]) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-2">
			{!! Form::label('url', 'Url', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-10">
			<p class="form-static"><a href="{{$article->url}}">{{$article->url}}</a></p>
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-2">
			{!! Form::label('content', 'Isi', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-10">
			{!! Form::textarea('content', $article->content, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-2">
			{!! Form::label('category', 'Category', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-10">
			{!! Form::select('categories[]', $categories, $article->categories->lists('id')->all(), ['class' => 'form-control', 'multiple' => true]) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-2">
			{!! Form::label('tag', 'Tag', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-10">
			{!! Form::select('tags[]', $tags, $article->tags->lists('id')->all(), ['class' => 'form-control', 'multiple' => true]) !!}
		</div>
	</div>

@stop

@section('content')
@include('partials.form', ['width' => '12'])
@stop