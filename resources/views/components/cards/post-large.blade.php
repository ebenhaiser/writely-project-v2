<style>
    .card-post-big .profile img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 50%;
    }
</style>

<div class="card-post-big">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <img src="https://placehold.co/600x400"
                    class="card-img-top" alt="Thumbnail" style="object-fit: cover; height:220px; border-radius: 10px">
                </div>
                <div class="col-md-6">
                    <div class="row mb-2 mt-2">
                        <div class="col-sm-8">
                            <h2 class="card-title">Title</h2>
                        </div>
                        <div class="col-sm-4" align="right">
                            <p class="badge text-bg-info" style="color: white">
                                Category
                            </p>
                        </div>
                    </div>
                    <p class="card-text">
                        {{-- {{ Str::limit($post->content, 250, '...') }} --}}
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repellat, sint debitis iure praesentium explicabo illo saepe minima id vero rerum dolor minus quia provident est voluptatem ipsum doloribus ratione. Voluptas?
                    </p>
                    {{-- <a href="#" class="card-link">Card link</a> --}}
                    <div class="d-flex gap-2">
                        <span>
                            {{-- <i align="right">{{ $post->created_at->diffForHumans() }}</i> --}}
                            <i align="right">25 minutes ago</i>
                        </span>
                        <span>
                            &#8226;
                        </span>
                        <span>
                            <i class='bx bx-like'></i> <span class="like-count">2K</span>
                        </span>
                        <span>
                            <i class='bx bx-comment'></i> <span class="like-count">200</span>
                        </span>
                    </div>
                    <button class="btn btn-outline-primary mt-2 like-btn" 
                    {{-- data-post-id="{{ $post->id }}" --}}
                    >
                    <span class="like-text mt-0">
                        {{-- {{ $post->isLikedByUser() ? 'Unlike' : 'Like' }} --}}
                        Liked
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="card-footer row">
        <div class="col-sm-10">
            <a href="#" class="d-flex">
                <span>
                    <div class="profile me-2 position-relative d-flex justify-content-end align-items-end mt-n10">
                        <img src="{{ asset('src/assets/images/user/avatar-1.jpg') }}"
                        alt="" class="rounded-circle border-4 border-white-color-40">
                    </div>
                </span>
                <span class="my-auto ms-1">
                    <h5 class="mt-0 mb-0">Full Name</h5>
                    <p class="mb-0 mt-0 text-body" style="text-decoration: none">
                        @Username</p>
                    </span>
                </a>
            </div>
            <div class="col-sm-2 my-auto" align="right">
                <a href="#" class="btn btn-secondary">Read more
                    &rarr;</a>
                </div>
            </div>
        </div>
    </div>
    