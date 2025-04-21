@extends('layouts.homepage.index')

@section('content')
    

    <!-- Page Title -->
    <div class="page-title dark-background" style="background-image: url({{ Vite::asset('resources/homepage/assets/img/page-title-bg.jpg') }});">
      <div class="container position-relative">
        <h1>Blog</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{route('homepage.index')}}" class="text-decoration-none text-warning">Home</a></li>
            <li class="current">Blog</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Blog Posts Section -->
    <section id="blog-posts" class="blog-posts section">

      <div class="container">
        <div class="row gy-4">

            @if(empty($posts))
            <div class="col-12">
                <h3 class="text-center">No posts available</h3>
            </div>
          @else
          
          @foreach ($posts as $post)

          <div class="col-lg-4">
            <article class="position-relative h-100">

              <div class="post-img position-relative overflow-hidden">
                <img src="{{ asset('storage/'. $post->image) }}" class="img-fluid" alt="">
                <span class="post-date">{{$post->created_at->diffForHumans()}}</span>
              </div>

              <div class="post-content d-flex flex-column">

                <h3 class="post-title">{{$post->title}}</h3>

                <div class="meta d-flex align-items-center">
                  <div class="d-flex align-items-center">
                    <i class="bi bi-person"></i> <span class="ps-2">{{$post->user->name}}</span>
                  </div>
                  <span class="px-3 text-black-50">/</span>
                  <div class="d-flex align-items-center">
                    <i class="bi bi-folder2"></i> <span class="ps-2">{{$post->category->name}}</span>
                  </div>
                </div>

                <p>
                  {{Str::limit($post->content, 100, '...')}}
                </p>

                <hr>

                <a href="{{route('homepage.blog_details', $post->id)}}" class="readmore stretched-link text-decoration-none"><span>Read More</span><i class="bi bi-arrow-right"></i></a>

              </div>

            </article>
          </div><!-- End post list item -->
            @endforeach
            @endif

        </div>
      </div>

    </section><!-- /Blog Posts Section -->

    <!-- Blog Pagination Section -->
    <section id="blog-pagination" class="blog-pagination section">

      <div class="container">
        {{ $posts->links() }}
      </div>

    </section><!-- /Blog Pagination Section -->


@endsection