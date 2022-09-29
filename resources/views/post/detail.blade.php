@extends('master')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">

                <div class="post mb-4">
                    <div class="row">
                        <h4 class="fw-bold mb-4">{{ $post->title }}</h4>
                        <img src="{{ asset('storage/cover/'.$post->cover) }}" class="cover-img rounded-3 mb-4 w-100" alt="">

                        <p class="text-black-50 mb-4 post-description">
                            {{ $post->description }}
                        </p>

                        @if($post->galleries->count())
                            <div class="gallery border rounded">
                                <h4 class="text-center fw-bold mt-3">Photos Gallery</h4>
                                <div class="row g-4 py-4 px-2 justify-content-center">
                                    @foreach($post->galleries as $gallery)
                                    <div class="col-6 col-lg-4 col-xxl-3">
                                        <a class="venobox" data-gall="gallery" href="{{ asset('storage/gallery/'.$gallery->photo) }}">
                                            <img src="{{ asset('storage/gallery/'.$gallery->photo) }}" class="gallery-photo" alt="">
                                        </a>

                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <div class="">
                            <h4 class="text-center fw-bold mt-4">Users Comment</h4>
                        </div>
                        @forelse($post->comments as $comment)
                        <div class="card m-4">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        <img src="{{ asset($comment->user->photo) }}" class="user-img me-2" alt="">
                                        <p class="mb-0">
                                            <span class="fw-bold">{{ $comment->user->name }}</span>
                                            <br>
                                            <span><i class="fa-regular fa-calendar"></i> {{ $comment->created_at->diffForHumans() }}</span>
                                        </p>
                                    </div>
                                    @can('delete',$comment)
                                    <form action="{{ route('comment.destroy',$comment->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-outline-danger rounded-circle"><i class="fa-regular fa-trash-alt"></i></button>
                                    </form>
                                    @endcan
                                </div>
                                <p>
                                    {{ $comment->message }}
                                </p>
                            </div>
                        </div>
                        @empty
                            <p class="text-center">
                                There's no comment yet!
                                @auth
                                    Start comment now.
                                @endauth
                                @guest
                                    <a href="{{ route('login') }}">Login</a> to comment
                                @endguest
                            </p>
                        @endforelse

                        @auth
                        <div class="mt-3">
                            <h4 class="text-center fw-bold mb-3">Leave a Reply</h4>
                            <div class="row justify-content-center mb-3">
                                <div class="col-lg-8">
                                    <form action="{{ route('comment.store') }}" method="post" id="comment-create">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control @error('message') is-invalid @enderror" name="message" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 150px"></textarea>
                                            <label for="floatingTextarea2">Comments</label>
                                            @error('message')
                                            <small class="invalid-feedback ps-2">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="text-center">
                                            <button class="btn btn-primary"><i class="fa-solid fa-comment"></i> Comment</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endauth

                        <div class="d-flex justify-content-between align-items-center border rounded p-4">
                            <div class="d-flex">
                                <img src="{{ asset($post->user->photo) }}" class="user-img rounded-circle" alt="">
                                <p class="mb-0 ms-2 small">
                                    {{ $post->user->name }}
                                    <br>
                                    <i class="fa-regular fa-calendar"></i>
                                    {{ $post->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <div class="">
                                @auth
                                    @can('delete',$post)
                                        <form action="{{ route('post.destroy',$post->id) }}" class="d-inline-block" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-outline-danger">
                                                <i class="fa-regular fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    @endcan
                                    @can('update',$post)
                                        <a href="{{ route('post.edit',$post->id) }}" class="btn btn-outline-warning">
                                            <i class="fa-solid fa-pencil-alt"></i>
                                        </a>
                                    @endcan
                                @endauth
                                <a href="{{ route('index') }}" class="btn btn-outline-primary">All Posts</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



@endsection

