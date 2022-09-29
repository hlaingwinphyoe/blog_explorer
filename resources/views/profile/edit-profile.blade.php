@extends('master')
@section('title') Edit Profile : {{ env("APP_NAME") }} @endsection
@section('content')

    <div class="container">
        <div class="row justify-content-center min-vh-100">
            <div class="col-lg-6 col-xl-5">
                <div class="text-center border rounded mb-3">
                    <h4 class="fw-bold mt-3">Edit Your Profile</h4>
                    <img src="{{ asset(auth()->user()->photo) }}" class="@error('photo') border border-danger is-invalid @enderror border border-5 border-primary profile-img rounded-circle mt-3" alt="">
                    <br>
                    <button class="btn btn-sm btn-secondary rounded-circle" id="edit-photo" style="margin: -60px 0 10px 100px;">
                        <i class="fa-solid fa-camera-alt"></i>
                    </button>
                    @error('photo')
                    <small class="invalid-feedback ps-2">{{ $message }}</small>
                    @enderror
                    <p class="mb-0">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="small text-black-50">{{ auth()->user()->email }}</p>
                </div>
                <form action="{{ route('update-profile') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="photo" class="d-none @error('photo') is-invalid @enderror" accept="image/jpeg,image/png">

                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',auth()->user()->name) }}" id="floatingInput" placeholder="name">
                        <label for="floatingInput">Name</label>
                        @error('name')
                        <small class="invalid-feedback ps-2">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button class="btn btn-lg btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop

@push('script')
    <script>
        let profileImage = document.querySelector('.profile-img');
        let photo = document.querySelector("[name='photo']");
        let editPhoto = document.querySelector("#edit-photo");

        editPhoto.addEventListener('click',_=> photo.click());
        photo.addEventListener('change',function (){
            let reader = new FileReader();
            reader.readAsDataURL(photo.files[0]);
            reader.onload = function(){
                profileImage.src = reader.result;
            }
        })


    </script>
@endpush

