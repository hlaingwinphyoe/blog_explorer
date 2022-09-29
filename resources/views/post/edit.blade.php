@extends('master')
@section('title') Edit Post : {{ env("APP_NAME") }} @endsection
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4>Edit Post</h4>
                    <p>
                        <i class="fa-regular fa-calendar"></i>
                        {{ date("j M Y") }}
                    </p>
                </div>

                <form action="{{ route('post.update',$post->id) }}" id="gallery-create" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-floating mb-3">
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="floatingInput" value="{{ old('title',$post->title) }}" placeholder="no need">
                        <label for="floatingInput">Post Title</label>
                        @error('title')
                        <small class="invalid-feedback ps-2">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <img src="{{ asset('storage/cover/'.$post->cover) }}" id="coverPreview" class="cover-img w-100 rounded @error('cover') border border-danger is-invalid @enderror" alt="">
                        <input type="file" name="cover" class="d-none" id="cover" accept="image/jpeg,image/png">
                        @error('cover')
                        <small class="invalid-feedback ps-2">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Leave a comment here" id="floatingTextarea" style="height: 350px">{{ old('description',$post->description) }}</textarea>
                        <label for="floatingTextarea">Share Your Experience</label>
                        @error('description')
                        <small class="invalid-feedback ps-2">{{ $message }}</small>
                        @enderror
                    </div>

                </form>

                <div class="border rounded p-4 mb-4" id="gallery">
                    <div class="d-flex align-items-stretch overflow-scroll" >
                        <div class="border px-5 me-1 rounded-1 me-1 d-flex justify-content-center align-items-center" id="upload-ui" style="height: 150px">
                            <i class="fa-regular fa-images fa-2xl"></i>
                        </div>
                        <div class="d-flex " style="height: 150px">
                            @forelse($post->galleries as $gallery)
                                <div class="d-flex align-items-end position-relative me-1">
                                    <img src="{{ asset('storage/gallery/'.$gallery->photo) }}" class="h-100 rounded-1" alt="">
                                    <form action="{{ route('gallery.destroy',$gallery->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm gallery-del rounded-circle">
                                            <i class="fa-regular fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>

                    <form action="{{ route('gallery.store') }}" method="post" id="gallery-upload" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="post_id"  value="{{ $post->id }}">
                        <input type="file" name="galleries[]" id="gallery-input" class="d-none @error('galleries') is-invalid @enderror @error('galleries.*') is-invalid @enderror" multiple>
                        @error('galleries')
                        <small class="invalid-feedback ps-2">{{ $message }}</small>
                        @enderror
                        @error('galleries.*')
                        <small class="invalid-feedback ps-2">{{ $message }}</small>
                        @enderror

                    </form>
                </div>
                <div class="text-center mb-5">
                    <button class="btn btn-primary btn-lg" form="gallery-create">
                        <i class="fa-solid fa-edit"></i>
                        Update Post
                    </button>
                </div>
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

        let uploadUi = document.querySelector("#upload-ui");
        let galleryInput = document.querySelector("#gallery-input");
        let galleryUpload = document.querySelector("#gallery-upload");

        uploadUi.addEventListener('click',_=> galleryInput.click());

        galleryInput.addEventListener('change',function (){
            galleryUpload.submit();
        })


    </script>
@endpush
