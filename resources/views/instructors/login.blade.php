@extends('templates.master')
@section('content')
<!--==========================
Contact Section
============================-->
{{-- wow fadeInUp --}}
<section id="contact" class="">
	<div class="container">
		<div class="section-header">
			<h2>Instructor Sign In</h2>
		</div>
</div>
<div class="container">
	<div class="form">
		@include('errors.error')
		<form  method="POST"  class="contactForm p-5" autocomplete="off" style="background:url({{url("storage/carousel/1.jpg")}}); background-size: cover;">
			<div class="form">	
				@csrf
				<div class="form-group col-md-auto col-lg-6 offset-lg-3">
					<label class="font-weight-bold" style="color:white;">ID Number</label>
					<input type="text" name="id_number" class="form-control" value="{{ old('id_number') }}"  placeholder="ID Number"  required />
					<div class="validation"></div>
				</div>
				<div class="form-group col-md-auto col-lg-6 offset-lg-3">
					<label class="font-weight-bold" style="color:white;">Password</label>
					<input type="password" class="form-control" name="password"  placeholder="Your password" data-rule="email" required />
				</div>
				<div class="form-group col-md-auto col-lg-6 offset-lg-3">
					<div class="text-right"><button type="submit">Sign In</button></div>
				</div>
			</div>
		</form>
	</div>
</div>
</section><!-- #contact -->
@endsection
