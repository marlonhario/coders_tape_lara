@extends('layouts.app')
@section('title', 'Customer List')
@section('content')
	<div class="row">
		<div class="col-12">
			<h1>New Customers</h1>
		</div>	
	</div>

	<div class="row">
		<div class="col-12">
			<form action="{{ route('customers.store') }}" method="POST">
				@csrf
				@include('customers.form')

				<button type="submit" class="btn btn-primary">Add Customer</button>

			</form>
		</div>	
	</div>


@endsection