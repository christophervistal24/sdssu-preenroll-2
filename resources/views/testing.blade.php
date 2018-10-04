@extends('templates.master')
@section('content')
	<form action="{{ url('/') }}" method="POST">
		@csrf
		<input type="text" name="email">
		<br>
		<input type="password" name="password">
		<br>
		<input type="submit" value="Login">
	</form>
@endsection
