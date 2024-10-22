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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-Cwh90AC1yPQHYenCN9YmPvDgA8J6vQQwz6htB6v6G9cpBiy7KZqicMA72xWVz6+q1YNit0F4PjFFaHSz6iw78A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>

<style>
    #rcp {
        font-size: 48px;
        font-weight: bold;
        text-align: center;
        perspective: 1000px;
        /* Enable perspective */
        animation: float 3s ease-in-out infinite;
        /* Floating effect */
        transform: rotateY(15deg);
        /* Slight 3D rotation */
        text-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
    }

    @keyframes float {
        0% {
            transform: translateY(0) rotateY(15deg);
        }

        50% {
            transform: translateY(-20px) rotateY(15deg);
            /* Float up */
        }

        100% {
            transform: translateY(0) rotateY(15deg);
        }
    }

    /* Glow effect */
    #rcp:hover {
        animation: none;
        /* Stop floating effect on hover */
        color: #ffcc00;
        /* Change color */
        text-shadow: 0 0 20px rgba(255, 204, 0, 0.6), 0 0 30px rgba(255, 204, 0, 0.8);
        transform: rotateY(15deg) scale(1.1);
        /* Scale on hover */
    }

    .explore-more {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        background-color: #007bff;
        /* Primary color */
        color: white;
        text-decoration: none;
        border-radius: 25px;
        /* Rounded corners */
        font-weight: bold;
        transition: background-color 0.3s ease, transform 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.4);
        /* Soft shadow */
    }

    .explore-more i {
        margin-right: 8px;
        /* Space between icon and text */
        font-size: 1.2rem;
        /* Icon size */
    }

    .explore-more:hover {
        background-color: #0056b3;
        /* Darker shade on hover */
        transform: translateY(-3px);
        /* Lift effect */
        box-shadow: 0 6px 20px rgba(0, 123, 255, 0.6);
        /* Enhanced shadow on hover */
    }

    .explore-more:active {
        transform: translateY(0);
        /* Reset lift effect on click */
        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.4);
        /* Reset shadow on click */
    }
</style>
</style>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <i class="circle-preloader"></i>
        <img src="img/core-img/salad.png" alt="">
    </div>
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
                        <div class="top-social-info text-right d-flex align-items-center justify-content-end">
                            <!-- Dark Mode Toggle Button -->
                            <button id="theme-toggle" class="btn btn-light" title="Toggle Dark/Light Mode">
                                <i class="bi bi-moon" id="theme-icon"></i>
                            </button>

                            <!-- Profile Icon with Dropdown -->
                            <div class="dropdown ml-2">
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
                        <a class="nav-brand" href="index.html">
                            <img src="img/core-img/logo.icon.png" alt="">
                        </a>

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">
                            <!-- close btn -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap">
                                    <span class="top"></span>
                                    <span class="bottom"></span>
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
            <div class="cssanimation typing">
                <div class="section-heading">
                    <h3 id="rcp">OUR BEST RECIPES</h3>
                    <a href="explore" class="explore-more">
                        <i class="bi bi-search"></i> Explore More
                    </a>
                </div>
            </div>

            <div class="row" id="recipe-container">
                @foreach ($recipes as $index => $recipe)
                    @php
                        $averageRating = $recipe->reviews->avg('rating');
                        $filledStars = floor($averageRating);
                        $halfStar = $averageRating - $filledStars >= 0.5 ? 1 : 0;
                    @endphp

                    <!-- Show first 6 recipes, hide the rest initially -->
                    <div class="col-12 col-sm-6 col-lg-4 recipe-item"
                        style="display: {{ $index < 6 ? 'block' : 'none' }};">
                        <div class="single-best-receipe-area shadow rounded">
                            <!-- User Info at the top -->
                            <div class="user-info p-3">
                                <a href="{{ route('profile.show', $recipe->user->id) }}">
                                    <!-- Correct the route here -->
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
                                    Average Rating: {{ number_format($averageRating, 1) }} / 5
                                </p>

                                <button class="btn favorite-btn" data-recipe-id="{{ $recipe->id }}">
                                    @if ($recipe->favorites->contains(Auth::id()))
                                        <i class="fa fa-heart"></i>
                                    @else
                                        <i class="fa fa-heart-o"></i>
                                    @endif
                                </button>

                                <p class="favorites-count">{{ $recipe->favorites->count() }} user(s) favorited this
                                    recipe</p>

                                <!-- Share Icon -->
                                <div class="share-icon mt-3">
                                    <button class="btn btn-share btn-light"
                                        onclick="toggleShareOptions({{ $recipe->id }})">
                                        <i class="fa fa-share-alt"></i> Share
                                    </button>
                                    <div class="social-share-options" id="share-options-{{ $recipe->id }}"
                                        style="display: none;">
                                        <div class="share-buttons mt-2">
                                            <a href="https://telegram.me/share/url?url={{ urlencode(url('user/user-show/' . $recipe->id)) }}&text={{ urlencode($recipe->title) }}"
                                                target="_blank" class="btn btn-outline-primary btn-telegram">
                                                <i class="fa fa-telegram"></i> Telegram
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- View All / View Less button -->
            <div class="text-center mt-4">
                <button class="btn btn-primary" id="view-toggle-btn" onclick="toggleView()">View All</button>
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
        let showingAll = false; // Track whether all recipes are shown or not

        function toggleView() {
            const recipeItems = document.querySelectorAll('.recipe-item');
            const viewToggleBtn = document.getElementById('view-toggle-btn');

            if (showingAll) {
                // If showing all, hide extra recipes
                recipeItems.forEach((item, index) => {
                    if (index >= 6) {
                        item.style.display = 'none';
                    }
                });
                viewToggleBtn.textContent = 'View All'; // Change button text
            } else {
                // If not showing all, show all recipes
                recipeItems.forEach(item => {
                    item.style.display = 'block';
                });
                viewToggleBtn.textContent = 'View Less'; // Change button text
            }

            showingAll = !showingAll; // Toggle the state
        }
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
        const themeToggleBtn = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');

        // Check saved theme preference
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-mode');
            themeIcon.classList.remove('bi-moon');
            themeIcon.classList.add('bi-sun');
        }

        // Toggle Dark/Light mode
        themeToggleBtn.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');

            if (document.body.classList.contains('dark-mode')) {
                localStorage.setItem('theme', 'dark');
                themeIcon.classList.remove('bi-moon');
                themeIcon.classList.add('bi-sun');
            } else {
                localStorage.setItem('theme', 'light');
                themeIcon.classList.remove('bi-sun');
                themeIcon.classList.add('bi-moon');
            }
        });
    </script>

</body>

</html>
