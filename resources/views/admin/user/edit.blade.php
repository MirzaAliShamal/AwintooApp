@extends('admin.layouts.app')
@section('panel')
<section class="content-header">                    
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $pageTitle }}</h1>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="message"></div>
    <div class="container-fluid">
        <form class="saveForm" data-storeURL="{{ route('admin.user.update', $user->id) }}">
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">                             
                            <div class="row">
                                 @if($type)
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="agency_name">Agency Name</label>
                                        <input type="text" name="agency_name" id="agency_name" value="{{ $user->agency_name }}" class="form-control" placeholder="Agency Name">
                                    </div>
                                </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" placeholder="Name">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" placeholder="Email">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                        <small>Leave empty if not want to change password</small>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="number" name="phone_number" id="phone_number" value="{{ $user->phone_number }}" class="form-control" placeholder="Phone Number">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="role">Type</label>
                                        <select class="form-control" name="role" id="role">
                                            @if(!$type))
                                            <option value="1" {{ ($user->role == 1) ? 'selected' : '' }}>Admin</option>
                                            @endif
                                            @if($type))
                                            <option value="2" {{ ($user->role == 2) ? 'selected' : '' }}>Agent</option>
                                            @endif
                                        </select>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>                                                                        
                    </div>
                </div>
            </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-dark">Update</button>
            </div>
        </form>
    </div>
</section>
@endsection