<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $blogpost->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f8f9fa;
        }

        .navbar-brand {
            font-weight: bold;
            color: #0d6efd !important;
        }

        .banner {
            position: relative;
            height: 300px;
            width: 100%;
            overflow: hidden;
        }

        .banner img {
            width: 100%;
            height: 100%;
            /* object-fit: cover; */
            filter: brightness(0.5);
        }

        .banner h1 {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 3rem;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6);
        }

        .blogpage-img {
            width: 750px;
            height: 350px;
        }

        .blogpage-img img {
            width: 100%;
            height: 100%;
        }

        .like-btn {
            background-color: #f3f4f6;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s ease;
        }

        .like-btn.liked {
            background-color: #d1fae5;
            color: #065f46;
        }

        .sidebar-blog img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
        }


        .related-slider .card {
            min-width: 250px;
            max-width: 400px;
            margin-right: 1rem;
            /* transition: transform 0.3s ease; */
        }

        .related-slider .card:hover {
            transform: scale(1.05);
        }

        .related-slider img {
            height: 300px;
            padding: 10px;
            /* object-fit: cover; */
        }

        .footer {
            background-color: #212529;
            color: #ccc;
            padding: 30px 0;
            text-align: center;
        }

        .footer a {
            color: #ccc;
            text-decoration: none;
        }

        .footer a:hover {
            color: white;
        }

        .main-content {
            max-width: 1200px;
            margin: 0 auto;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('frontend.index') }}">My Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('frontend.index') }}">Home</a></li>

                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Banner -->
    <div class="banner">
        @if ($blogpost->image)
            <img src="{{ asset('storage/' . $blogpost->image) }}" alt="{{ $blogpost->title }}">
        @endif
        <h1>{{ $blogpost->title }}</h1>
    </div>

    <!-- Content -->
    <div class="container py-5 main-content">
        <div class="row">
            <!-- Blog -->
            <div class="col-lg-8" data-aos="fade-right">

                <h2>{{ $blogpost->title }}</h2>
                <span class="badge bg-info mb-3">{{ $blogpost->category->name ?? 'Uncategorized' }}</span>
                <br>
                <div class="blogpage-img">
                    @if ($blogpost->image)
                        <img src="{{ asset('storage/' . $blogpost->image) }}" alt="{{ $blogpost->title }}">
                    @endif
                </div><br>
                <p class="text-muted">{{ $blogpost->short_description }}</p>
                <div>{!! $blogpost->content !!}</div>

                <div id="like-section" class="my-4">
                    <button id="like-button" data-post-id="{{ $blogpost->id }}"
                        class="like-btn {{ session('liked_posts') && in_array($blogpost->id, session('liked_posts')) ? 'liked' : '' }}">
                        👍 <span id="like-label">Like</span>
                    </button>
                    <span id="like-count">{{ $blogpost->likes->count() }} Likes</span>
                </div>

                <!-- Comments -->
                <h4 class="mt-5">Comments</h4>
                @forelse($approvedComments as $comment)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="text-primary">{{ $comment->guest_name }}</h5>
                            <small class="text-muted">{{ $comment->created_at->format('d M Y') }}</small>
                            <p>{{ $comment->comment }}</p>
                        </div>
                    </div>
                @empty
                    <p>No approved comments yet. Be the first!</p>
                @endforelse

                <!-- Comment Form -->
                <h5 class="mt-4">Leave a Comment</h5>
                <form action="{{ route('comment.store') }}" method="POST" class="p-4 border rounded bg-light">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $blogpost->id }}">
                    <div class="mb-3">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" name="guest_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="guest_email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Comment <span class="text-danger">*</span></label>
                        <textarea name="comment" rows="4" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Comment</button>
                </form>
            </div>

            <!-- Sidebar: Latest Blogs -->
            <div class="col-lg-4" data-aos="fade-left">
                <div class="p-4 bg-white shadow rounded">
                    <h5 class="mb-4">📌 Latest Blogs</h5>
                    @foreach ($latestBlogs as $latest)
                        <div class="d-flex align-items-center mb-3 sidebar-blog">
                            <img src="{{ asset('storage/' . $latest->image) }}" alt="{{ $latest->title }}">
                            <div class="ms-3">
                                <a href="{{ route('frontend.show', $latest->slug) }}"
                                    class="text-decoration-none text-dark">
                                    <strong>{{ Str::limit($latest->title, 50) }}</strong>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Related Blogs -->
        @if (count($relatedBlogs))
            <h4 class="mt-5 mb-3" data-aos="fade-up">🧩 Related Blogs</h4>
            <div class="d-flex overflow-auto related-slider pb-3" data-aos="fade-up">
                @foreach ($relatedBlogs as $related)
                    <div class="card me-3 shadow-sm">
                        <img src="{{ asset('storage/' . $related->image) }}" class="card-img-top"
                            alt="{{ $related->title }}">
                        <div class="card-body">
                            <h6 class="card-title">{{ Str::limit($related->title, 50) }}</h6>
                            <a href="{{ route('frontend.show', $related->slug) }}"
                                class="btn btn-sm btn-outline-primary">Read More</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <a href="{{ route('frontend.index') }}" class="btn btn-secondary mt-4">← Back to Blog List</a>
    </div>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container">
            <p>Designed & Developed by <strong>Mohammad Usman</strong></p>
            <p>&copy; {{ date('Y') }} My Blog. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    @if (session('comment_success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('comment_success') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <script>
        AOS.init();

        document.addEventListener('DOMContentLoaded', function() {
            const likeButton = document.getElementById('like-button');
            const likeCount = document.getElementById('like-count');
            const likeLabel = document.getElementById('like-label');
            const postId = likeButton.dataset.postId;

            likeButton.addEventListener('click', () => {
                const isLiked = likeButton.classList.contains('liked');
                const url = isLiked ? '{{ route('like.destroy') }}' : '{{ route('like.store') }}';

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            post_id: postId
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success' || data.status === 'disliked') {
                            let count = parseInt(likeCount.textContent);
                            likeCount.textContent = (isLiked ? count - 1 : count + 1) + ' Likes';
                            likeButton.classList.toggle('liked');
                            likeLabel.textContent = isLiked ? 'Like' : 'Dislike';
                        }
                    });
            });
        });
    </script>
</body>

</html>
