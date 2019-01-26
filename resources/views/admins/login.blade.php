@extends('templates.master')
@section('content')
<!--==========================
Contact Section
============================-->

<section id="contact" class="">
	<div class="container">
		<div class="section-header">
			<h2>Administrator Sign In</h2>
		</div>
</div>
<div class="container">
	<div class="form">
		@include('errors.error')
		<form method="POST"  class="contactForm p-5" autocomplete="off" style="background:url({{url("storage/carousel/1.jpg")}}); background-size: cover;">
			@csrf
			<div class="form">
				<div class="form-group col-md-6 offset-3">
					<label class="font-weight-bold" style="color:white;">ID Number</label>
					<input type="text" name="id_number" class="form-control" value="{{ old('id_number') }}" placeholder="Your ID Number" required />
				</div>
				<div class="form-group col-md-6 offset-3">
					<label class="font-weight-bold" style="color:white;">Password</label>
					<input type="password" class="form-control" name="password"  placeholder="Your password" required />
				</div>
				<div class="form-group col-md-6 offset-3">
					<div class="text-right"><button type="submit">Sign In</button></div>
				</div>
			</div>
		</form>
	</div>
</div>
</section><!-- #contact -->
@endsection
