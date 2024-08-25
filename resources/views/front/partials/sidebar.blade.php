<div class="col-lg-4">
    <div class="bg-light rounded p-5 mb-4 wow slideInUp" data-wow-delay="0.1s">
        <div class="align-items-center mb-5">
            <div class="d-flex mb-5 align-items-center">
                    @if(!empty($client->photo))
                    <img class="flex-shrink-0 img-fluid border rounded w-25" src="{{ getImage(getFilePath('photo'). '/' .$client->photo) }}" alt="Client Photo" >
                    @endif
                <div class="text-start ps-4">
                    <h4 class="mb-2">{{ $client->full_name }}</h4>
                </div>
            </div>
            <div>
                <div class="text-center border rounded">
                    <small class="profile-headline status-font"><b class="text-dark">Status: </b>{{ $client->status }}</small>
                </div>
            </div>
            <div class="mt-2 text-start">
                <small class="profile-headline"><i class="fas fa-briefcase text-primary me-2"></i><b class="text-dark">Job:</b> {{ $client->job->job_name }}</small><br>
                <small class="profile-headline"><i class="fas fa-calendar-alt text-primary me-2"></i><b class="text-dark">Date of Birth:</b>  {{ Carbon\Carbon::parse($client->dob)->format('d-m-Y') }}</small><br>
                <small class="profile-headline"><i class="fas fa-venus-mars text-primary me-2"></i><b class="text-dark">Gender:</b> {{ $client->gender }}</small><br>
                <small class="profile-headline"><i class="fas fa-phone text-primary me-2"></i><b class="text-dark">Phone:</b>  {{ $client->phone_number }}</small><br>
                <small class="profile-headline"><i class="fas fa-envelope text-primary me-2"></i><b class="text-dark">Email:</b> {{ $client->email }}</small><br>
                <small class="profile-headline"><i class="fas fa-graduation-cap text-primary me-2"></i><b class="text-dark">School Level:</b> {{ $client->school_level }}</small><br>
                <small class="profile-headline"><i class="fas fa-user-tie text-primary me-2"></i><b class="text-dark">Agent:</b> {{ $client->agent->name }}</small><br>
                <small class="profile-headline"><i class="fas fa-file-alt text-primary me-2"></i><b class="text-dark">Application Date:</b> {{ Carbon\Carbon::parse($client->application_date)->format('d-m-Y') }}</small>
            </div>
        </div>
        <a href="{{ route('front.dashboard') }}" class="btn btn-primary w-100"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="{{ route('front.appointment') }}" class="btn btn-primary text-danger w-100 mt-1"><i class="fas fa-calendar-alt"></i> My Appointments</a>
        <a href="{{ route('front.restInfo') }}" class="btn btn-primary w-100 mt-1"><i class="fas fa-info-circle"></i> My Information</a>
    </div>
</div>