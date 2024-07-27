<div class="col-lg-4">
    <div class="bg-light rounded p-5 mb-4 wow slideInUp" data-wow-delay="0.1s">
        <div class="align-items-center mb-5">
            <div class="d-flex mb-5 align-items-center">
                    @if(!empty($client->photo))
                    <img class="flex-shrink-0 img-fluid border rounded w-25" src="{{ getImage(getFilePath('clientPhoto'). '/' .$client->photo) }}" alt="Client Photo" >
                    @endif
                <div class="text-start ps-4">
                    <h4 class="mb-3">{{ $client->full_name }}</h4>
                </div>
            </div>
            <div class="mt-2 text-start">
                <small class="profile-headline"><i class="fas fa-briefcase text-primary me-2"></i><b>Job:</b> {{ $client->job->job_name }}</small><br>
                <small class="profile-headline"><i class="fas fa-calendar-alt text-primary me-2"></i><b>Date of Birth:</b>  {{ $client->dob }}</small><br>
                <small class="profile-headline"><i class="fas fa-venus-mars text-primary me-2"></i><b> Gender:</b> {{ $client->gender }}</small><br>
                <small class="profile-headline"><i class="fas fa-phone text-primary me-2"></i><b>Phone:</b>  {{ $client->phone_number }}</small><br>
                <small class="profile-headline"><i class="fas fa-envelope text-primary me-2"></i><b>Email:</b> {{ $client->email }}</small><br>
                <small class="profile-headline"><i class="fas fa-graduation-cap text-primary me-2"></i><b>School Level:</b> {{ $client->school_level }}</small><br>
                <small class="profile-headline"><i class="fas fa-user-tie text-primary me-2"></i><b>Agent:</b> {{ $client->agent->name }}</small><br>
                <small class="profile-headline"><i class="fas fa-file-alt text-primary me-2"></i><b>Application Date:</b> {{ $client->application_date }}</small>

            </div>
        </div>
        <a href="{{ route('front.dashboard') }}" class="btn btn-primary w-100">Dashboard</a>
        <a href="{{ route('front.restInfo') }}" class="btn btn-primary w-100 mt-1">Rest Information</a>
        {{-- <a href="#" class="btn btn-primary w-100 mt-1">Update Password</a> --}}
    </div>
</div>