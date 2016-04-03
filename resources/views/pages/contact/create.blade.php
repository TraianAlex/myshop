@extends('layouts.app')
@section('content')
<div class="container">
	<h1>Contact MyShop</h1>
	@if (count($errors) > 0)
		<div class="alert alert-danger">
		        Please correct the following errors:<br />
		        <ul>
		@foreach ($errors->all() as $error) <li>{{ $error }}</li>
		@endforeach </ul>
		</div>
	@endif
	@if(Session::has('message'))
		<section class="alert alert-info">
			{{ Session::get('message') }}
		</section>
	@endif
	{!! Form::open(array('route' => 'contact_store', 'class' => 'form', 'novalidate' => 'novalidate')) !!}
		<div class="form-group">
			{!! Form::label('Your Name') !!}
			{!! Form::text('name', null, ['required',
			      'class'=>'form-control',
			      'placeholder'=>'Your name']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('Your E-mail Address') !!}
			{!! Form::text('email', null, ['required',
			      'class'=>'form-control',
			      'placeholder'=>'Your e-mail address']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('Your Message') !!}
			{!! Form::textarea('message', null, ['required',
			      'class'=>'form-control',
			      'placeholder'=>'Your message']) !!}
		</div>
		<div class="form-group">
		    {!! Form::submit('Contact Us!', ['class'=>'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
</div>
@endsection