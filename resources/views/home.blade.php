<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Delicious - Food Blog Template | Home</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/core-img/logo.icon.png') }}">

    <!-- Core Stylesheet -->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css1/style.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css1/style.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css1/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css1/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css1/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css1/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css1/classy-nav.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css1/custom-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('css1/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css1/nice-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="{{ asset('style.css.map') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Other head elements -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> --}}

</head>
{{-- <style>

</style> --}}
<style>
    .single-best-receipe-area {
        background: white;
        border-radius: 8px;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .single-best-receipe-area:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }

    .recipe-image {
        height: 200px;
        /* Set a fixed height for uniformity */
        overflow: hidden;
        /* Hide overflow to maintain clean edges */
    }

    .recipe-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Cover the area without distortion */
    }

    .no-image {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        background-color: #f0f0f0;
        font-weight: bold;
        color: #999;
        text-align: center;
    }

    .recipe-title {
        font-size: 1.2rem;
        font-weight: bold;
        margin: 10px 0;
    }

    .recipe-user {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 10px;
    }

    .ratings {
        margin: 5px 0;
    }

    .average-rating {
        font-size: 0.9rem;
        color: #007bff;
        /* Bootstrap primary color */
    }

    .row {
        margin: 0;
        /* Remove default margin */
    }

    .single-small-receipe-area {
        background-color: #fff;
        /* White background for cards */
        border-radius: 8px;
        /* Rounded corners */
        overflow: hidden;
        /* Prevent content overflow */
        transition: transform 0.3s;
        /* Smooth transform effect */
    }

    .single-small-receipe-area:hover {
        transform: scale(1.02);
        /* Scale effect on hover */
    }

    .receipe-thumb img {
        width: 100%;
        /* Responsive image */
        height: auto;
        /* Maintain aspect ratio */
    }

    .no-image {
        display: flex;
        /* Flexbox for centering */
        align-items: center;
        justify-content: center;
        height: 150px;
        /* Fixed height */
        background-color: #f2f2f2;
        /* Light gray background */
        color: #999;
        /* Gray text */
        font-size: 16px;
        /* Font size */
    }

    .receipe-content {
        display: flex;
        flex-direction: column;
        /* Column layout for content */
    }

    .recipe-title {
        font-size: 1.25rem;
        /* Larger font for title */
        color: #007bff;
        /* Blue color for title */
        text-decoration: none;
        /* No underline */
        transition: color 0.3s;
        /* Smooth color transition */
    }

    .recipe-title:hover {
        color: #0056b3;
        /* Darker blue on hover */
    }

    .ratings {
        margin-top: 10px;
        /* Spacing above ratings */
    }

    .average-rating {
        font-size: 0.9rem;
        /* Smaller font size */
        color: #666;
        /* Dark gray text */
    }

    .category-name {
        margin-top: 10px;
        /* Spacing above category */
        font-size: 0.9rem;
        /* Smaller font size */
        color: #777;
        /* Gray text */
    }

    .favorite-icon:hover {
        transform: scale(1.1);
        /* Slightly increase size on hover */
        transition: transform 0.2s ease;
        /* Smooth transition effect */
    }

    .favorite-count {
        margin-left: 8px;
        /* Space between icon and count */
    }

    .top-social-info {
        position: relative;
        /* Relative positioning for dropdown */
    }

    .dropdown-toggle {
        display: flex;
        align-items: center;
        /* Center align the text and image */
        color: #343a40;
        /* Dark color for text */
        font-weight: 600;
        /* Bold text */
    }

    .dropdown-toggle img {
        transition: transform 0.2s;
        /* Image zoom effect */
    }

    .dropdown-toggle:hover img {
        transform: scale(1.1);
        /* Slightly enlarge the image on hover */
    }

    .dropdown-menu {
        border-radius: 0.5rem;
        /* Rounded corners */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        /* Subtle shadow for dropdown */
        padding: 0.5rem 0;
        /* Padding for dropdown items */
    }

    .dropdown-item {
        transition: background-color 0.3s, color 0.3s;
        /* Smooth transition */
        color: #495057;
        /* Dark text color */
    }

    .dropdown-item i {
        margin-right: 8px;
        /* Space between icon and text */
        color: #6c757d;
        /* Default icon color */
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
        /* Light background on hover */
        color: #343a40;
        /* Darker text on hover */
    }

    .dropdown-divider {
        border-top: 1px solid #e9ecef;
        /* Divider color */
    }

    .dropdown-item.text-danger:hover {
        background-color: #f8d7da;
        /* Light red background for Logout */
        color: #721c24;
        /* Darker text color for Logout */
    }

    /* Base Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f3f4f6;
        color: #333;
        line-height: 1.6;
    }

    .container {
        max-width: 1000px;
        margin: 50px auto;
    }

    .section-heading h3 {
        font-size: 2rem;
        font-weight: 600;
        text-align: center;
        margin-bottom: 30px;
    }

    /* Instagram-like Recipe Card */
    .single-best-receipe-area {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        transition: transform 0.3s ease;
    }

    .single-best-receipe-area:hover {
        transform: scale(1.02);
    }

    .recipe-image img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    .recipe-card-content {
        padding: 20px;
    }

    .recipe-title a {
        font-size: 1.2rem;
        font-weight: 600;
        color: #333;
        text-decoration: none;
    }

    .recipe-title a:hover {
        color: #ff6f61;
    }

    /* User Info Section */
    .user-info {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
        border: 2px solid #ff6f61;
        object-fit: cover;
    }

    .user-info a {
        font-weight: 500;
        color: #333;
        text-decoration: none;
    }

    .user-info a:hover {
        color: #ff6f61;
    }

    /* Ratings Section */
    .ratings i {
        color: #ffcc00;
    }

    .favorite-btn {
        color: #ff6f61;
    }

    .favorite-btn i {
        margin-right: 5px;
    }

    .favorites-count {
        font-size: 0.9rem;
        color: #777;
    }

    /* Button */
    .btn-view-all {
        margin-top: 20px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .recipe-image img {
            height: 200px;
        }
    }

    @media (max-width: 576px) {
        .recipe-image img {
            height: 180px;
        }

        .recipe-title a {
            font-size: 1rem;
        }
    }

    .btn-share {
        background-color: #007bff;
        color: white;
    }

    .share-buttons {
        margin-top: 10px;
    }

    .btn-whatsapp {
        background-color: #25D366;
        color: white;
        padding: 10px;
        border-radius: 5px;
        text-decoration: none;
        display: inline-block;
    }

    .btn-whatsapp i {
        margin-right: 5px;
    }
</style>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <i class="circle-preloader"></i>
        <img src="img/core-img/salad.png" alt="">
    </div>

    <!-- Search Wrapper -->
    {{-- <div class="search-wrapper">
        <!-- Close Btn -->
        <div class="close-btn"><i class="fa fa-times" aria-hidden="true"></i></div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="#" method="post">
                        <input type="search" name="search" placeholder="Type any keywords...">
                        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">

        <!-- Top Header Area -->
        <div class="top-header-area">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-between">
                    <!-- Breaking News -->
                    <div class="col-12 col-sm-6">
                        <div class="breaking-news">
                            <div id="breakingNewsTicker" class="ticker">
                                <ul>
                                    <li><a href="#">Hello World!</a></li>
                                    <li><a href="#">Welcome to Colorlib Family.</a></li>
                                    <li><a href="#">Hello Delicious!</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Top Social Info -->
                    <div class="col-12 col-sm-6">
                        <div class="top-social-info text-right">
                            <!-- Profile Icon with Dropdown -->
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"
                                    style="text-decoration: none;">
                                    <span class="text-lg font-semibold text-gray-800">{{ Auth::user()->name }}</span>
                                    <img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}?d=mp&s=40"
                                        alt="Profile Icon" class="rounded-circle ml-2"
                                        style="width: 40px; height: 40px; object-fit: cover;">
                                </a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ url('profile') }}">
                                        <i class="fa fa-user"></i> My Profile
                                    </a>
                                    <a class="dropdown-item" href="{{ url('recipe-add') }}">
                                        <i class="fa fa-plus"></i> Add Recipes
                                    </a>
                                    @if (Auth::user()->role == 'admin')
                                        <a class="dropdown-item" href="dashboard">
                                            <i class="fa fa-tachometer"></i> Dashboard
                                        </a>
                                    @endif
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="logout">
                                        <i class="fa fa-sign-out"></i> Logout
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Navbar Area -->
        <div class="delicious-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="deliciousNav">

                        <!-- Logo -->
                        <a class="nav-brand" href="index.html"><img src="img/core-img/logo.icon.png" alt=""></a>

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- close btn -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span>
                                </div>
                            </div>

                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Hero Area Start ##### -->
    <section class="hero-area">
        <div class="hero-slides owl-carousel">
            <!-- Single Hero Slide -->
            <div class="single-hero-slide bg-img" style="background-image: url(img/bg-img/bg1.jpg);">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="hero-slides-content" data-animation="fadeInUp" data-delay="100ms">
                                <h2 data-animation="fadeInUp" data-delay="300ms">Delicios Homemade Burger</h2>
                                <p data-animation="fadeInUp" data-delay="700ms">Lorem ipsum dolor sit amet,
                                    consectetur adipiscing elit. Cras tristique nisl vitae luctus sollicitudin. Fusce
                                    consectetur sem eget dui tristique, ac posuere arcu varius.</p>
                                <a href="#" class="btn delicious-btn" data-animation="fadeInUp"
                                    data-delay="1000ms">See Receipe</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Hero Slide -->
            <div class="single-hero-slide bg-img" style="background-image: url(img/bg-img/bg6.jpg);">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="hero-slides-content" data-animation="fadeInUp" data-delay="100ms">
                                <h2 data-animation="fadeInUp" data-delay="300ms">Delicios Homemade Burger</h2>
                                <p data-animation="fadeInUp" data-delay="700ms">Lorem ipsum dolor sit amet,
                                    consectetur adipiscing elit. Cras tristique nisl vitae luctus sollicitudin. Fusce
                                    consectetur sem eget dui tristique, ac posuere arcu varius.</p>
                                <a href="#" class="btn delicious-btn" data-animation="fadeInUp"
                                    data-delay="1000ms">See Receipe</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Hero Slide -->
            <div class="single-hero-slide bg-img" style="background-image: url(img/bg-img/bg7.jpg);">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="hero-slides-content" data-animation="fadeInUp" data-delay="100ms">
                                <h2 data-animation="fadeInUp" data-delay="300ms">Delicios Homemade Burger</h2>
                                <p data-animation="fadeInUp" data-delay="700ms">Lorem ipsum dolor sit amet,
                                    consectetur adipiscing elit. Cras tristique nisl vitae luctus sollicitudin. Fusce
                                    consectetur sem eget dui tristique, ac posuere arcu varius.</p>
                                <a href="#" class="btn delicious-btn" data-animation="fadeInUp"
                                    data-delay="1000ms">See Receipe</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Hero Area End ##### -->

    <!-- ##### Top Catagory Area Start ##### -->
    <section class="top-catagory-area section-padding-80-0">
        <div class="container">
            <div class="row">
                <!-- Top Catagory Area -->
                <div class="col-12 col-lg-6">
                    <div class="single-top-catagory">
                        <img src="img/bg-img/bg2.jpg" alt="">
                        <!-- Content -->
                        <div class="top-cta-content">
                            <h3>Strawberry Cake</h3>
                            <h6>Simple &amp; Delicios</h6>
                            <a href="receipe-post.html" class="btn delicious-btn">See Full Receipe</a>
                        </div>
                    </div>
                </div>
                <!-- Top Catagory Area -->
                <div class="col-12 col-lg-6">
                    <div class="single-top-catagory">
                        <img src="img/bg-img/bg3.jpg" alt="">
                        <!-- Content -->
                        <div class="top-cta-content">
                            <h3>Chinesse Noodles</h3>
                            <h6>Simple &amp; Delicios</h6>
                            <a href="receipe-post.html" class="btn delicious-btn">See Full Receipe</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Top Catagory Area End ##### -->

    <!-- ##### Best Receipe Area Start ##### -->

    <section class="best-receipe-area">
        <div class="container">
            <div class="section-heading">
                <h3>The Best Recipes</h3>
            </div>

            <div class="row" id="recipe-container">
                @foreach ($recipes->take(6) as $recipe)
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-best-receipe-area shadow rounded">
                            <!-- User Info at the top -->
                            <div class="user-info p-3">
                                <a href="{{ url('profile/' . $recipe->user->id) }}">
                                    <img src="https://png.pngtree.com/png-vector/20231019/ourmid/pngtree-user-profile-avatar-png-image_10211467.png"
                                        alt="User Avatar" class="user-avatar">
                                    {{ $recipe->user->name }}
                                </a>
                            </div>

                            <!-- Recipe Image -->
                            <div class="recipe-image">
                                @if ($recipe->image)
                                    <img src="{{ asset('webimg/' . $recipe->image) }}" alt="{{ $recipe->title }}"
                                        class="img-fluid">
                                @else
                                    <div class="no-image">
                                        <p>No image available.</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Recipe Content -->
                            <div class="recipe-card-content">
                                <h5 class="recipe-title">
                                    <a href="{{ url('user/user-show/' . $recipe->id) }}">{{ $recipe->title }}</a>
                                </h5>

                                <div class="ratings">
                                    @php
                                        $averageRating = $recipe->reviews()->avg('rating');
                                        $filledStars = floor($averageRating);
                                        $halfStar = $averageRating - $filledStars >= 0.5 ? 1 : 0;
                                    @endphp

                                    @for ($i = 1; $i <= $filledStars; $i++)
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    @endfor

                                    @if ($halfStar)
                                        <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                    @endif

                                    @for ($i = 1; $i <= 5 - $filledStars - $halfStar; $i++)
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    @endfor
                                </div>

                                <p class="average-rating">
                                    @if ($averageRating)
                                        Average Rating: {{ number_format($averageRating, 1) }} / 5
                                    @else
                                        No ratings yet
                                    @endif
                                </p>

                                <button class="btn" data-recipe-id="{{ $recipe->id }}">
                                    @if ($recipe->favorites->contains(Auth::id()))
                                        <i class="fa fa-heart"></i>
                                    @else
                                        <i class="fa fa-heart-o"></i>
                                    @endif
                                </button>
                                <p class="favorites-count">{{ $recipe->favorites->count() }} user(s) favorited this
                                    recipe</p>

                                <!-- Share Icon -->
                                <div class="share-icon mt-2">
                                    <button class="btn btn-share" onclick="toggleShareOptions({{ $recipe->id }})">
                                        <i class="fa fa-share-alt"></i> Share
                                    </button>
                                    <div class="social-share-options" id="share-options-{{ $recipe->id }}"
                                        style="display: none;">
                                        <div class="share-buttons">
                                            <a href="https://telegram.me/share/url?url={{ urlencode(url('user/user-show/' . $recipe->id)) }}&text={{ urlencode($recipe->title) }}"
                                                target="_blank" class="btn btn-telegram">
                                                <i class="fa fa-telegram"></i> Share on Telegram
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- View All / View Less Button -->
            <div class="text-center mt-4">
                <button id="view-toggle-button" class="btn btn-primary btn-view-all">View All Recipes</button>
            </div>
            <br><br><br>

            <!-- Hidden Container for Additional Recipes -->
            <div class="row" id="more-recipes" style="display: none;">
                @foreach ($recipes->slice(6) as $recipe)
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-best-receipe-area shadow rounded">
                            <div class="user-info p-3">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSFJfQpO3v4NSrlVvMpFYWw7YjijzAKTbuXHg&s"
                                    alt="User Avatar" class="user-avatar">
                                <a href="{{ url('profile/' . $recipe->user->id) }}">{{ $recipe->user->name }}</a>
                            </div>
                            <div class="recipe-image">
                                @if ($recipe->image)
                                    <img src="{{ asset('webimg/' . $recipe->image) }}" alt="{{ $recipe->title }}"
                                        class="img-fluid">
                                @else
                                    <div class="no-image">
                                        <p>No image available.</p>
                                    </div>
                                @endif
                            </div>
                            <div class="recipe-card-content">
                                <h5 class="recipe-title">
                                    <a href="{{ url('user/user-show/' . $recipe->id) }}">{{ $recipe->title }}</a>
                                </h5>
                                <p class="recipe-user">Uploaded by: {{ $recipe->user->name }}</p>

                                <div class="ratings">
                                    @php
                                        $averageRating = $recipe->reviews()->avg('rating');
                                        $filledStars = floor($averageRating);
                                        $halfStar = $averageRating - $filledStars >= 0.5 ? 1 : 0;
                                    @endphp

                                    @for ($i = 1; $i <= $filledStars; $i++)
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    @endfor

                                    @if ($halfStar)
                                        <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                    @endif

                                    @for ($i = 1; $i <= 5 - $filledStars - $halfStar; $i++)
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    @endfor
                                </div>

                                <p class="average-rating">
                                    @if ($averageRating)
                                        Average Rating: {{ number_format($averageRating, 1) }} / 5
                                    @else
                                        No ratings yet
                                    @endif
                                </p>

                                <button class="btn" data-recipe-id="{{ $recipe->id }}">
                                    @if ($recipe->favorites->contains(Auth::id()))
                                        <i class="fa fa-heart"></i>
                                    @else
                                        <i class="fa fa-heart-o"></i>
                                    @endif
                                </button>
                                <p class="favorites-count">{{ $recipe->favorites->count() }} user(s) favorited this
                                    recipe</p>
                                <!-- Share Icon -->
                                <div class="share-icon mt-2">
                                    <button class="btn btn-share" onclick="toggleShareOptions({{ $recipe->id }})">
                                        <i class="fa fa-share-alt"></i> Share
                                    </button>
                                    <div class="social-share-options" id="share-options-{{ $recipe->id }}"
                                        style="display: none;">
                                        <div class="share-buttons">
                                            <a href="https://telegram.me/share/url?url={{ urlencode(url('user/user-show/' . $recipe->id)) }}&text={{ urlencode($recipe->title) }}"
                                                target="_blank" class="btn btn-telegram">
                                                <i class="fa fa-telegram"></i> Share on Telegram
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- ##### Best Receipe Area End ##### -->

    <!-- ##### CTA Area Start ##### -->
    <section class="cta-area bg-img bg-overlay" style="background-image: url(img/bg-img/bg4.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <!-- Cta Content -->
                    <div class="cta-content text-center">
                        <h2>Gluten Free Receipies</h2>
                        <p>Fusce nec ante vitae lacus aliquet vulputate. Donec scelerisque accumsan molestie. Vestibulum
                            ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Cras sed
                            accumsan neque. Ut vulputate, lectus vel aliquam congue, risus leo elementum nibh</p>
                        <a href="" class="btn delicious-btn">Discover all the receipies</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### CTA Area End ##### -->

    <!-- ##### Small Receipe Area Start ##### -->
    <section class="small-receipe-area section-padding-80-0">
        <div class="container">
            <div class="row">

                <!-- Small Receipe Area -->
                @foreach ($recipes as $recipe)
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-small-receipe-area d-flex">
                            <div class="receipe-thumb">
                                @if ($recipe->image)
                                    <img src="{{ asset('webimg/' . $recipe->image) }}" alt="{{ $recipe->title }}">
                                @else
                                    <p>No image available.</p>
                                @endif
                            </div>
                            <!-- Receipe Content -->
                            <div class="receipe-content">
                                {{-- <span>January 04, 2018</span> --}}
                                <a href="{{ url('user/user-show/' . $recipe->id) }}">
                                    <h5>{{ $recipe->title }}</h5>
                                </a>
                                <div class="ratings">
                                    @php
                                        $averageRating = $recipe->reviews()->avg('rating');
                                        $filledStars = floor($averageRating);
                                        $halfStar = $averageRating - $filledStars >= 0.5 ? 1 : 0;
                                    @endphp

                                    @for ($i = 1; $i <= $filledStars; $i++)
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    @endfor

                                    @if ($halfStar)
                                        <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                    @endif

                                    @for ($i = 1; $i <= 5 - $filledStars - $halfStar; $i++)
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    @endfor
                                </div>
                                <p class="average-rating">
                                    @if ($averageRating)
                                        Average Rating: {{ number_format($averageRating, 1) }} / 5
                                    @else
                                        No ratings yet
                                    @endif
                                </p>

                                <!-- Display the comment count as a digit -->
                                <p>{{ $recipe->category ? $recipe->category->name : 'No Category' }}</p>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ##### Small Receipe Area End ##### -->

    <!-- ##### Quote Subscribe Area Start ##### -->
    <section class="quote-subscribe-adds">
        <div class="container">
            <div class="row align-items-end">
                <!-- Quote -->
                <div class="col-12 col-lg-4">
                    <div class="quote-area text-center">
                        <span>"</span>
                        <h4>Nothing is better than going home to family and eating good food and relaxing</h4>
                        <p>John Smith</p>
                        <div class="date-comments d-flex justify-content-between">
                            <div class="date">January 04, 2018</div>
                            <div class="comments">2 Comments</div>
                        </div>
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="col-12 col-lg-4">
                    <div class="newsletter-area">
                        <h4>Subscribe to our newsletter</h4>
                        <!-- Form -->
                        <div class="newsletter-form bg-img bg-overlay"
                            style="background-image: url(img/bg-img/bg1.jpg);">
                            <form action="#" method="post">
                                <input type="email" name="email" placeholder="Subscribe to newsletter">
                                <button type="submit" class="btn delicious-btn w-100">Subscribe</button>
                            </form>
                            <p>Fusce nec ante vitae lacus aliquet vulputate. Donec sceleri sque accumsan molestie.
                                Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</p>
                        </div>
                    </div>
                </div>

                <!-- Adds -->
                <div class="col-12 col-lg-4">
                    <div class="delicious-add">
                        <img src="img/bg-img/add.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Quote Subscribe Area End ##### -->

    <!-- ##### Follow Us Instagram Area Start ##### -->
    <div class="follow-us-instagram">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5>Follow Us Instragram</h5>
                </div>
            </div>
        </div>
        <!-- Instagram Feeds -->
        <div class="insta-feeds d-flex flex-wrap">
            @foreach ($recipes as $recipe)
                <!-- Single Insta Feeds -->
                <div class="single-insta-feeds">
                    <img src="{{ asset('webimg/' . $recipe->image) }}" alt="{{ $recipe->title }}" alt="">
                    <!-- Icon -->
                    <div class="insta-icon">
                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- ##### Follow Us Instagram Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-12 h-100 d-flex flex-wrap align-items-center justify-content-between">
                    <!-- Footer Social Info -->
                    <div class="footer-social-info text-right">
                        <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                    </div>
                    <!-- Footer Logo -->
                    <div class="footer-logo">
                        <a href="index.html"><img src="img/core-img/logo.png" alt=""></a>
                    </div>
                    <!-- Copywrite -->
                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i
                            class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com"
                            target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area Start ##### -->

    <!-- ##### All Javascript Files ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="{{ asset('js1/jquery/jquery-2.2.4.min.js') }}"></script>
    <!-- Popper js -->
    <script src="{{ asset('js1/bootstrap/popper.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('js1/bootstrap/bootstrap.min.js') }}"></script>
    <!-- All Plugins js -->
    <script src="{{ asset('js1/plugins/plugins.js') }}"></script>
    <!-- Active js -->
    <script src="{{ asset('js1/active.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Initially, hide the extra recipes
            $("#more-recipes").hide();

            // Toggle button click event
            $("#view-toggle-button").click(function() {
                const button = $(this);
                const isHidden = $("#more-recipes").is(":hidden");

                if (isHidden) {
                    // If the recipes are hidden, show them
                    $("#more-recipes").slideDown(); // Show with slide effect
                    button.text('View Less Recipes');
                } else {
                    // If the recipes are visible, hide them
                    $("#more-recipes").slideUp(); // Hide with slide effect
                    button.text('View All Recipes');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.btn').click(function(e) {
                e.preventDefault(); // Prevent default button action
                const button = $(this);
                const recipeId = button.data('recipe-id');

                $.ajax({
                    url: `/recipes/${recipeId}/favorite`, // Adjust the URL to your route
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // Include CSRF token
                    },
                    success: function(response) {
                        // Check the response for 'isFavorited'
                        if (response.isFavorited) {
                            button.html(
                                '<i class="fa fa-heart"></i>'
                            ); // Show filled heart if favorited
                        } else {
                            button.html(
                                '<i class="fa fa-heart-o"></i>'
                            ); // Show outlined heart if unfavorited
                        }

                        // Update the favorites count
                        button.siblings('.favorites-count').text(response.favoritesCount +
                            ' user(s) favorited this recipe');
                    },
                    // error: function() {
                    //     alert('Something went wrong. Please try again.');
                    // }
                });
            });
        });
    </script>
    <script>
        function toggleShareOptions(recipeId) {
            const shareOptions = document.getElementById('share-options-' + recipeId);
            shareOptions.style.display = shareOptions.style.display === 'none' ? 'block' : 'none';
        }
    </script>


</body>

</html>
