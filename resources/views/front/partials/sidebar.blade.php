<div class="col-lg-4">
    <div class="bg-light rounded p-5 mb-4 wow slideInUp" data-wow-delay="0.1s">
        <div class="d-flex align-items-center mb-5">
                <img class="flex-shrink-0 img-fluid border rounded w-25" src="{{ getImage(getFilePath('restInfoPhoto'). '/' .$client->restInfo->photo) }}" alt="Client Photo" >
            <div class="text-start ps-4">
                <div>
                    <h4 class="mb-3">{{ $client->full_name }}</h4>
                    <small class="profile-headline">{{ $client->job->job_name }}</small>
                </div>
            </div>
        </div>
        <a href="{{ route('front.dashboard') }}" class="btn btn-primary w-100">Dashboard</a>
        <a href="{{ route('front.restInfo') }}" class="btn btn-primary w-100 mt-1">Rest Information</a>
        <a href="{{ route('front.password') }}" class="btn btn-primary w-100 mt-1">Update Password</a>
    </div>
</div>