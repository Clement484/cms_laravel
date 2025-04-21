@extends('layouts.homepage.index')

@section('content')

    <!-- Page Title -->
    <div class="page-title dark-background" style="background-image: url({{ asset('storage/img/page-title-bg.jpg')}});">
      <div class="container position-relative">
        <h1>Blog Details</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{route('homepage.index')}}" class="text-decoration-none text-warning">Home</a></li>
            <li class="current">Blog Details</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <div class="container">
      <div class="row">

        <div class="col-lg-8">

          <!-- Blog Details Section -->
          <section id="blog-details" class="blog-details section">
            <div class="container">

              <article class="article">

                <div class="post-img">
                  <img src="{{ asset('storage/'. $post->image) }}" alt="" class="img-fluid">
                </div>

                <h2 class="title">{{$post->title}}</h2>

                <div class="meta-top">
                  <ul>
                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="" class="text-decoration-none">{{$post->user->name}}</a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="" class="text-decoration-none"><time datetime="2020-01-01">{{$post->created_at->diffForHumans()}}</time></a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="" class="text-decoration-none">{{$comments->count()}} Comments</a></li>
                  </ul>
                </div><!-- End meta top -->

                <div class="content">
                  <p>
                    {{$post->content}}
                  </p>

                  <blockquote>
                    <p>
                        @if(isset($random_quote))
                            <em>{{ $random_quote }}</em>
                        @endif
                    </p>
                  </blockquote>

                </div><!-- End post content -->

                <div class="meta-bottom">
                  <i class="bi bi-folder"></i>
                  <ul class="cats">
                    <li><a href="{{route('homepage.category_blogs', $post->category->name)}}" class="text-decoration-none">{{$post->category->name}}</a></li>
                  </ul>

                  {{-- <i class="bi bi-tags"></i>
                  <ul class="tags">
                    <li><a href="#">Creative</a></li>
                    <li><a href="#">Tips</a></li>
                    <li><a href="#">Marketing</a></li>
                  </ul> --}}
                </div>
                <!-- End meta bottom -->

              </article>

            </div>
          </section><!-- /Blog Details Section -->

          <!-- Blog Author Section -->
          <section id="blog-author" class="blog-author section">

            <div class="container">
              <div class="author-container d-flex align-items-center">
                <img src="{{ asset('storage/' . $post->user->profile_photo)}}" class="rounded-circle flex-shrink-0" alt="">
                <div>
                  <h4>{{$post->user->name}}</h4>
                  <div class="social-links">
                    <a href="https://x.com/#"><i class="bi bi-twitter-x"></i></a>
                    <a href="https://facebook.com/#"><i class="bi bi-facebook"></i></a>
                    <a href="https://instagram.com/#"><i class="biu bi-instagram"></i></a>
                  </div>
                  <p>
                    @if($post->user->bio)
                    {{$post->user->bio}}
                    @else
                    A passionate professional with a diverse skill set. Enjoys learning new things and connecting with others. Always striving for personal and professional growth.
                    @endif
                  </p>
                </div>
              </div>
            </div>

          </section><!-- /Blog Author Section -->

          <!-- Blog Comments Section -->
          <section id="blog-comments" class="blog-comments section">

            <div class="container">

              <h4 class="comments-count">{{$comments->count()}} Comments</h4>
                @if($comments->isEmpty())
                <h5 class="text-center">No comments available</h5>
                @else
              @foreach ($comments as $comment)
              <div id="comment-1" class="comment">
                <div class="d-flex">
                  <div class="comment-img"><img src="{{ asset('storage/'. $comment->user->profile_photo)}}" alt=""></div>
                  <div>
                    <h5><a href="" class="text-decoration-none">{{$comment->user->name}}</a> <a href="#" class="reply text-decoration-none"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                    <time datetime="2020-01-01">{{$comment->created_at->diffForHumans()}}</time>
                    <p>
                        {{$comment->content}}
                    </p>
                  </div>
                </div>
              </div><!-- End comment #1 -->
                @endforeach
                @endif

            </div>

          </section><!-- /Blog Comments Section -->

          <!-- Comment Form Section -->
          <section id="comment-form" class="comment-form section">
            <div class="container">

              @auth
              <form action="{{route('comments.store')}}" method="POST" class="php-email-form">
                {{-- <form action="{{route('comments.store')}}" method="POST" class="php-email-form"> --}}
                @csrf

                <h4>Post Comment</h4>
                <input type="hidden" name="post_id" value="{{$post->id}}">
                <div class="row">
                  <div class="col form-group">
                    <textarea name="content" class="form-control" placeholder="Your Comment*" required></textarea>
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Post Comment</button>
                </div>

              </form>
                  
              @else
              <div class="row">
                <div class="col form-group">
                      <h3 class="form-control" >You must be <a href="{{ route('login') }}">logged in</a> to post a comment.</h3>
                    </div>
                  </div>
              @endauth

              @if(session('success'))
              <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
                  <div class="toast align-items-center text-white bg-success border-0 show" id="successToast" role="alert" aria-live="assertive" aria-atomic="true">
                      <div class="d-flex">
                          <div class="toast-body">
                              {{ session('success') }}
                          </div>
                          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                      </div>
                  </div>
              </div>
              @endif

            </div>
          </section><!-- /Comment Form Section -->

        </div>
        

        <div class="col-lg-4">

          <div class="widgets-container">

            <!-- Search Widget -->
            <div class="search-widget widget-item">

              <h3 class="widget-title">Search</h3>
              <form action="">
                <input type="text">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
              </form>

            </div><!--/Search Widget -->

            <!-- Categories Widget -->
            <div class="categories-widget widget-item">

              <h3 class="widget-title">Categories</h3>
              <ul class="mt-3">
                @if($categories->isEmpty())
                <li><a href="#" class="text-decoration-none">No categories available</a></li>
                @else
                @foreach ($categories as $category)
                <li><a href="{{route('homepage.category_blogs', $category->name)}}" class="text-decoration-none">{{$category->name}} <span>({{$category->posts->count()}})</span></a></li>
                @endforeach
                @endif
              </ul>

            </div><!--/Categories Widget -->

            <!-- Recent Posts Widget -->
            <div class="recent-posts-widget widget-item">

              <h3 class="widget-title">Recent Posts</h3>

              @foreach ($related_posts as $related_post)
              <div class="post-item">
                <img src="{{ asset('storage/'. $related_post->image)}}" alt="" class="flex-shrink-0">
                <div>
                  <h4><a href="{{route('homepage.blog_details', $related_post->id)}}" class="text-decoration-none">{{$related_post->title}}</a></h4>
                  <time datetime="2020-01-01">{{$related_post->created_at->diffForHumans()}}</time>
                </div>
              </div><!-- End recent post item-->
                @endforeach

            

            </div><!--/Recent Posts Widget -->

            <!-- Tags Widget -->
            {{-- <div class="tags-widget widget-item">

              <h3 class="widget-title">Tags</h3>
              <ul>
                <li><a href="#">App</a></li>
                <li><a href="#">IT</a></li>
                <li><a href="#">Business</a></li>
                <li><a href="#">Mac</a></li>
                <li><a href="#">Design</a></li>
                <li><a href="#">Office</a></li>
                <li><a href="#">Creative</a></li>
                <li><a href="#">Studio</a></li>
                <li><a href="#">Smart</a></li>
                <li><a href="#">Tips</a></li>
                <li><a href="#">Marketing</a></li>
              </ul>

            </div><!--/Tags Widget --> --}}

          </div>

        </div>

      </div>
    </div>

@endsection