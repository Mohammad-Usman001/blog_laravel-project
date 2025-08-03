<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Blog Project')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <style>
    body {
      background: #f9f9f9;
      font-family: 'Segoe UI', sans-serif;
    }

    .navbar-brand {
      font-weight: bold;
      color: #0d6efd !important;
    }

    .hero {
      background: linear-gradient(to right, #007bff, #00c6ff);
      color: white;
      padding: 100px 20px;
      text-align: center;
    }

    .hero h1 {
      font-size: 3rem;
      font-weight: 700;
    }

    .hero p {
      font-size: 1.25rem;
    }

    .card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }
    .card-img, .card-img-bottom, .card-img-top {
    width: 100%;
    height: 300px;
    padding: 10px;
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
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
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

  <!-- Hero Section -->
  <section class="hero" data-aos="fade-up">
    <div class="container">
      <h1>Welcome to Our Blog</h1>
      <p>Explore our latest insights, ideas, and stories curated just for you.</p>
    </div>
  </section>

  <!-- Blog Grid -->
  <div class="container py-5">
    <h2 class="text-center mb-5" data-aos="fade-right">Latest Blogs</h2>
    <div class="row g-4">
      @foreach ($blogposts as $blog)
      <div class="col-md-4" data-aos="zoom-in">
        <div class="card h-100">
          @if($blog->image)
            <img src="{{asset('storage/' . $blog->image)}}" class="card-img-top" alt="Blog Image">
          @else
            <div class="bg-light text-center py-5">No Image Uploaded</div>
          @endif
          <div class="card-body">
            <span class="badge bg-info text-dark mb-2">{{ $blog->category->name ?? 'Uncategorized' }}</span>
            <h5 class="card-title text-primary">{{ $blog->title }}</h5>
            <p class="card-text">{{ $blog->short_description }}</p>
          </div>
          <div class="card-footer bg-white">
            <small class="text-muted">{{ $blog->created_at->format('d M Y') }}</small><br>
            <a href="{{ route('frontend.show', $blog->slug) }}" class="btn btn-outline-primary mt-2">Read More →</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <p>Designed & Developed by <strong>Mohammad Usman</strong></p>
      <p>&copy; {{ date('Y') }} My Blog. All rights reserved.</p>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 1000,
      once: true
    });
  </script>
</body>
</html>
