<!DOCTYPE html>
<html lang="en">
<head>
<title>User Profile</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script
	src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
<script
	src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script
	src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
	<div class="container mt-3">
		<h2>User Details</h2>
		<br>
		<!-- Nav tabs -->
		<ul class="nav nav-tabs">
			<li class="nav-item"><a class="nav-link active" data-toggle="tab"
				href="#home">User Profile</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="tab"
				href="#menu1">Change Password</a></li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content">
			<div id="home" class="container tab-pane active">
				@if(session()->has('message'))
				<div class="alert alert-success alert-with-border mt-3" role="alert">{{
					session()->get('message') }}</div>
				@endif @if ($errors->any())
				<div class="alert alert-danger mt-3">
					<h6>Error Occurred! Please fix the following errors:</h6>
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li> @endforeach
					</ul>
				</div>
				@endif @if(isset($profile['profile_image'])) <img
					src="{{ route('profileImage', $profile['profile_image']) }}"
					class="img-thumbnail mx-auto d-block mt-3" height="150" width="200">
				@else <img src="{{asset('img/user.png')}}"
					class="img-thumbnail mx-auto d-block mt-3" height="150" width="200">
				@endif
				<form action="{{route('updateProfile')}}" method="post"
					enctype="multipart/form-data">
					@csrf @method('PUT')
					<h5>GENERAL INFORMATION</h5>
					<hr
						style="height: 2px; border-width: 0; color: gray; background-color: gray">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Full name:</label> <input type="text"
									class="form-control" id="full_name" placeholder="Full name"
									name="full_name" value="{{Auth::user()->name}}">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="email">Profile image:</label> <input type="file"
									class="form-control" id="profile_image" name="profile_image">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="dob">Date of birth:</label> <input type="date"
									class="form-control" id="date_of_birth" name="date_of_birth"
									value="{{ old('date_of_birth', $profile['date_of_birth'] ?? null) }}">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="contact">Gender:</label><Select class="form-control"
									name="gender">
									<option value="">Select</option>
									<option value="male"
										@if(!empty($profile['gender']) && $profile['gender']==
										'male') selected @endif>Male</option>
									<option value="female"
										@if(!empty($profile['gender']) && $profile['gender']==
										'female') selected @endif>Female</option>
								</Select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="email">Email:</label> <input type="email"
									class="form-control" id="email" placeholder="Email"
									name="email" value="{{Auth::user()->email}}" disabled>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="contact">Contact No.:</label> <input type="number"
									class="form-control" id="contact_no"
									placeholder="Contact number" name="contact_no"
									value="{{ old('contact_no', $profile['contact_no'] ?? null) }}">
							</div>
						</div>
					</div>
					<h5>ADDRESS</h5>
					<hr
						style="height: 2px; border-width: 0; color: gray; background-color: gray">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="address">Address line 1:</label> <input type="text"
									class="form-control" id="address_line_1"
									placeholder="Address line 1" name="address_line_1"
									value="{{ old('address_line_1', $profile['address_line_1'] ?? null) }}">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="address">Address line 2:</label> <input type="text"
									class="form-control" id="address_line_2"
									placeholder="Address line 2" name="address_line_2"
									value="{{ old('address_line_2', $profile['address_line_2'] ?? null) }}">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="address">Pincode:</label> <input type="text"
									class="form-control" id="pincode" placeholder="Pincode"
									name="pincode"
									value="{{ old('pincode', $profile['pincode'] ?? null) }}">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="address">State</label> <input type="text"
									class="form-control" id="state" placeholder="State"
									name="state"
									value="{{ old('state', $profile['state'] ?? null) }}">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="address">Country:</label> <input type="text"
									class="form-control" id="country" placeholder="Country"
									name="country"
									value="{{ old('country', $profile['country'] ?? null) }}">
							</div>
						</div>
					</div>
					<button type="submit"
						class="btn btn-success btn-md  mx-auto d-block my-3">UPDATE</button>
				</form>
			</div>
			<div id="menu1" class="container tab-pane fade mt-3">
				
				<form action="{{route('passwordUpdate',[Auth::user()->id])}}"
					method="post" id="form-submit">
					@csrf @method('PUT')
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="current_password">Current Password</label> <input
									type="password" class="form-control" id="current_password"
									name="current_password" placeholder="Current Password">
							</div>
							<div class="form-group">
								<label for="new_password">New Password</label> <input
									type="password" class="form-control" id="new_password"
									name="new_password" placeholder="New Password">
							</div>
							<div class="form-group">
								<label for="new_password_confirmation">Repeat New Password</label>
								<input type="password" class="form-control"
									id="new_password_confirmation" name="new_password_confirmation"
									placeholder="Repeat New Password">
							</div>
						</div>
						<div class="col-12 text-center mt-3">
							<button type="submit" class="btn btn-success btn-md btn-square">Updade Password</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>