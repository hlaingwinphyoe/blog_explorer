@extends('master')
@section('title') Create Post : {{ env("APP_NAME") }} @endsection
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4>Create New Post</h4>
                    <p>
                        <i class="fa-regular fa-calendar"></i>
                        {{ date("j M Y") }}
                    </p>
                </div>

                <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-floating mb-3">
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="floatingInput" value="{{ old('title') }}" placeholder="no need">
                        <label for="floatingInput">Post Title</label>
                        @error('title')
                        <small class="invalid-feedback ps-2">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <img src="{{ asset('images/image-default.png') }}" id="coverPreview" class="cover-img w-100 rounded @error('cover') border border-danger is-invalid @enderror" alt="">
                        <input type="file" name="cover" class="d-none" id="cover" accept="image/jpeg,image/png">
                        @error('cover')
                        <small class="invalid-feedback ps-2">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Leave a comment here" id="floatingTextarea" style="height: 350px">{{ old('description') }}</textarea>
                        <label for="floatingTextarea">Share Your Experience</label>
                        @error('description')
                        <small class="invalid-feedback ps-2">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="text-center mb-5">
                        <button class="btn btn-primary btn-lg">
                            <i class="fa-solid fa-comment-sms"></i>
                            Create Post
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@stop

@push('script')
    <script>

        let coverPreview = document.querySelector("#coverPreview");
        let cover = document.querySelector("#cover");

        coverPreview.addEventListener('click',_=>cover.click());

        cover.addEventListener('change',_=>{
            let reader = new FileReader();
            reader.readAsDataURL(cover.files[0]);
            reader.onload = function (){
                coverPreview.src = reader.result;
            }
         })


    </script>
@endpush
