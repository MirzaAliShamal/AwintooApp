@extends('admin.layouts.app')
@section('panel')
<section class="content-header">                    
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $pageTitle }}</h1>
            </div>
            <div class="col-sm-6 text-end">
                <a href="{{ route('admin.user.password') }}" class="btn btn-outline-dark">Change Password</a>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="message"></div>
        <div class="row">
            <div class="col-md-3">
                <div class="card card-dark card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{ getImage(getFilePath('adminProfilePic') . '/' . $admin->image) }}" alt="profile picture">
                        </div>
                        <h3 class="profile-username text-center">{{ $admin->name }}</h3>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Email</b> <a class="float-right">{{ $admin->email }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Phone Number</b> <a class="float-right">{{ $admin->phone_number }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <form class="saveForm" data-storeURL="{{ route('admin.user.profile.update', $admin->id) }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" value="{{ $admin->name }}" class="form-control" placeholder="Name">   
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" value="{{ $admin->email }}" class="form-control" placeholder="Email">   
                                        <p></p>
                                    </div>
                                </div>  
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone">Phone Number</label>
                                        <input type="number" name="phone_number" id="phone_number" value="{{ $admin->phone_number }}" class="form-control" placeholder="Phone Number">   
                                        <p></p>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="col-md-5 mt-2">
                                        <img src="{{ getImage(getFilePath('adminProfilePic') . '/' . $admin->image) }}" class="img-fluid img-thumbnail" width="250">
                                        <label for="image" class="bg-dark p-2 mt-2 btn btn-block">Upload Image</label>
                                    </div>
                                        <small class="ml-2 text-muted">Supported files: jpeg, jpg, png. Image will be resized into 400x400px</small>
                                    <input type="file" name="image" id="image" class="form-control input-opacity-none" accept=".png, .jpg, .jpeg">  
                                    <p></p> 
                                </div>                                   
                                <div class="pb-5 pt-3">
                                    <button type="submit" class="btn btn-dark">Update</button>
                                </div>
                            </div>
                            @method('PUT')
                        </form>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection