@extends('layouts.master')

@section('contents')
    <h1 class="mb-0">Profile</h1>
    <hr />

    <form method="POST" enctype="multipart/form-data" id="profile_setup_frm" action="" >
    @csrf
        <div class="form-group">
            <label for="avatar">Profile Picture</label>
            <input type="file" class="form-control" id="avatar" name="avatar">
        </div>

        <!-- Display current avatar -->
        @if (auth()->user()->avatar)
            <div class="mb-3">
                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" class="img-thumbnail" width="150">
            </div>
        @endif
        <div class="row">
            <div class="col-md-12 border-right">
                <div class="p-3 py-5">
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="labels">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="first name" value="{{ auth()->user()->name }}">
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Email</label>
                            <input type="text" name="email" disabled class="form-control" value="{{ auth()->user()->email }}" placeholder="Email">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="labels">Phone</label>
                            <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="{{ auth()->user()->phone }}">
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Address</label>
                            <input type="text" name="address" class="form-control" value="{{ auth()->user()->address }}" placeholder="Address">
                        </div>
                    </div>
                    <div class="mt-5 text-center"><button id="btn" class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
                </div>
            </div>
        </div>   
    </form>
@endsection