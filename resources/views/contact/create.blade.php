@extends('layouts.app')
@section('title', 'Contact Us')
@section('content')
	<h1>Contact Us</h1>
		<form action="{{ route('contact.store') }}" method="POST">
			@csrf
			<div class="form-group">
				<label for="name">Name: </label>
				<input class="form-control" type="text" name="name" value="{{ old('name') }}">
				<div>{{ $errors->first('name') }}</div>
			</div>
			<div class="form-group">
				<label for="email">Email:</label>
				<input class="form-control" type="text" name="email" value="{{ old('email') }}">
				<div>{{ $errors->first('email') }}</div>
			</div>
			<div class="form-group">
				<label for="message">Message:</label>
				<textarea name="message" id="message" cols="30" rows="10" class="form-control">{{ old('message') }}</textarea>
				<div>{{ $errors->first('message') }}</div>
			</div>

			<button type="submit" class="btn btn-primary">Send Message</button>
		</form>
@endsection