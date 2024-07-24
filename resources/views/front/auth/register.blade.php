@extends('front.layouts.master')
@section('content')
          <div class="container p-5">
            <div class="message"></div>
                <h1 class="text-center mb-5 mt-3 wow fadeInUp" data-wow-delay="0.1s">Register</h1>
                <div class="row g-4">
                    <div class="col-md-12">
                        <div class="wow fadeInUp" data-wow-delay="0.5s">
                            <form class="saveForm" data-storeURL="{{ route('register.store') }}">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Your Name">
                                            <p></p>
                                            <label for="name">Your Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email">
                                            <p></p>
                                            <label for="email">Your Email</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Your Password">
                                            <p></p>
                                            <label for="password">Your Password</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Your Password">
                                            <label for="password_confirmation">Confirm Password</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select id="user_id" name="user_id" class="form-control">
                                                <option value="">Select Agent</option>
                                                @forelse($agents as $agent)
                                                <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                                @empty
                                                <option>Agent Not Found</option>
                                                @endforelse
                                            </select>
                                            <p></p>
                                            <label for="user_id">Select Agent</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select id="job_id" name="job_id" class="form-control">
                                                <option value="">Select Job</option>
                                                @forelse($jobs as $job)
                                                <option value="{{ $job->id }}">{{ $job->job_name }}</option>
                                                @empty
                                                <option>No Record Found</option>
                                                @endforelse
                                            </select>
                                            <p></p>
                                            <label for="job_id">Select Job</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 py-3" type="submit">Register</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      @endsection