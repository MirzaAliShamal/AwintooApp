@extends('front.layouts.app')
@section('panel')
<div class="col-lg-8">
	<div class="message"></div>
	<div class="wow fadeInUp" data-wow-delay="0.5s">
		<form class="saveForm" data-storeURL="{{ route('front.password.update') }}">
			<div class="row g-3">
				<div class="col-md-12">
					<div class="form-floating">
						<input type="password" class="form-control" name="old_password" id="old_password" placeholder="Your Old Password">
						<p></p>
						<label for="password">Old Password</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-floating">
						<input type="password" class="form-control" name="new_password" id="new_password" placeholder="Your New Password">
						<p></p>
						<label for="password">Your Password</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-floating">
						<input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
						<p></p>
						<label for="confirm_password">Confirm Password</label>
					</div>
				</div>
				<div class="col-12">
					<button class="btn btn-primary w-100 py-3" type="submit">Update</button>
				</div>
			</div>
		</form>
	</div>


</div>
@endsection