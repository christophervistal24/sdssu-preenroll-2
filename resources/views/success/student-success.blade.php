@if (Session::has('status'))
<div class="alert alert-success alert-dismissible fade show text-white" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">&times;</span>
	</button>
	 <strong>{{Session::get('status') }}</strong>
</div>
@endif
