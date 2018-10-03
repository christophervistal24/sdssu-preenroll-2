@extends('templates.master')
@section('content')
<!--==========================
Contact Section
============================-->
<section id="contact" class="wow fadeInUp">
	<div class="container">
		<div class="section-header">
			<h2>Student Sign In</h2>
		</div>
</div>
<div class="container">
	<div class="form">
		<form action="" method="POST"  class="contactForm" autocomplete="off">
			<div class="form">
				<div class="form-group col-md-6 offset-3">
					<label>Name</label>
					<input type="text" name="name" class="form-control"  placeholder="Your Name" data-rule="minlen:4" required />
					<div class="validation"></div>
				</div>
				<div class="form-group col-md-6 offset-3">
					<label>Password</label>
					<input type="password" class="form-control" name="email"  placeholder="Your password" data-rule="email" required />
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
