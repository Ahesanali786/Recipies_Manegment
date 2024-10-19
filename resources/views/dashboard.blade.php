<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="surfside media" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('font/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('icon/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/favicon.ico') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
    <!-- Add FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .chat{
        }
    </style>
</head>

<body class="body">
    <div id="wrapper">
        <div id="page" class="">
            <div class="layout-wrap">

                <!-- <div id="preload" class="preload-container">
    <div class="preloading">
        <span></span>
    </div>
</div> -->

                <div class="section-menu-left">
                    <div class="box-logo">
                        <a href="index.html" id="site-logo-inner">
                            <img class="" id="logo_header" alt="" src="images/logo/logo.png"
                                data-light="images/logo/logo.png" data-dark="images/logo/logo.png">
                        </a>
                        <div class="button-show-hide">
                            <i class="icon-menu-left"></i>
                        </div>
                    </div>
                    <div class="center">
                        <div class="center-item">
                            <div class="center-heading">Main Home</div>
                            <ul class="menu-list">
                                <li class="menu-item">
                                    <a href="home" class="">
                                        <div class="icon"><i class="fas fa-tachometer-alt"></i></div>
                                        <div class="text">Dashboard</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="center-item">
                            <ul class="menu-list">
                                <li class="menu-item has-children">
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div class="icon"><i class="fas fa-utensils"></i></div>
                                        <div class="text">Recipes</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item">
                                            <a href="recipe-add" class="">
                                                <div class="icon"><i class="fas fa-plus-circle"></i></div>
                                                <div class="text">Add Recipes</div>
                                            </a>
                                        </li>
                                        <li class="sub-menu-item">
                                            <a href="recipe-list" class="">
                                                <div class="icon"><i class="fas fa-list"></i></div>
                                                <div class="text">Recipes List</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item has-children">
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div class="icon"><i class="fas fa-tags"></i></div>
                                        <div class="text">Category</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item">
                                            <a href="category-add" class="">
                                                <div class="icon"><i class="fas fa-plus"></i></div>
                                                <div class="text">New Category</div>
                                            </a>
                                        </li>
                                        <li class="sub-menu-item">
                                            <a href="category-list" class="">
                                                <div class="icon"><i class="fas fa-th-list"></i></div>
                                                <div class="text">Categories List</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="menu-item">
                                    <a href="review" class="">
                                        <div class="icon"><i class="fas fa-star"></i></div>
                                        <div class="text">Reviews</div>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="logout" class="">
                                        <div class="icon"><i class="fas fa-sign-out-alt"></i></div>
                                        <div class="text">Logout</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="section-content-right">

                    <div class="header-dashboard">
                        <div class="wrap">
                            <div class="header-left">
                                <a href="index-2.html">
                                    <img class="" id="logo_header_mobile" alt=""
                                        src="images/logo/logo.png" data-light="images/logo/logo.png"
                                        data-dark="images/logo/logo.png" data-width="154px" data-height="52px"
                                        data-retina="images/logo/logo.png">
                                </a>
                                <div class="button-show-hide">
                                    <i class="icon-menu-left"></i>
                                </div>


                                <form class="form-search flex-grow">
                                    <fieldset class="name">
                                        <input type="text" placeholder="Search here..." class="show-search"
                                            name="name" tabindex="2" value="" aria-required="true"
                                            required="">
                                    </fieldset>
                                    <div class="button-submit">
                                        <button class="" type="submit"><i class="icon-search"></i></button>
                                    </div>
                                </form>

                            </div>
                            <div class="header-grid">




                                <div class="popup-wrap user type-header">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="header-user wg-user">
                                                <span class="image">
                                                    <img src="images/avatar/user-1.png" alt="">
                                                </span>
                                                <span class="flex flex-column">
                                                    <span class="body-title mb-2">{{ Auth::user()->name }}</span>
                                                    <span class="text-tiny">Admin</span>
                                                </span>
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end has-content"
                                            aria-labelledby="dropdownMenuButton3">
                                            <li>
                                                <a href="#" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-user"></i>
                                                    </div>
                                                    <div class="body-title-2">Account</div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-mail"></i>
                                                    </div>
                                                    <div class="body-title-2">Inbox</div>
                                                    <div class="number">27</div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-file-text"></i>
                                                    </div>
                                                    <div class="body-title-2">Taskboard</div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-headphones"></i>
                                                    </div>
                                                    <div class="body-title-2">Support</div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="logout" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-log-out"></i>
                                                    </div>
                                                    <div class="body-title-2">Log out</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="main-content">
                        <div class="main-content-inner">
                            <div class="main-content-wrap">
                                <div class="tf-section-2 mb-30">
                                    <div class="flex flex-wrap-mobile">
                                        <div class="w-full"> <!-- Full width for vertical stacking -->
                                            <div class="flex flex-col gap20">
                                                <!-- Total Users Card -->
                                                <div
                                                    class="wg-chart-default mb-20 p-4 border border-gray-300 rounded-lg shadow-md flex justify-between items-center">
                                                    <div class="flex items-center gap14">
                                                        <div class="image ic-bg">
                                                            <i class="fas fa-users text-gray-700"></i>
                                                            <!-- Users icon -->
                                                        </div>
                                                        <div>
                                                            <div class="body-text mb-2">Total Users</div>
                                                            <h4>{{ $users }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Total Category Card -->
                                                <div
                                                    class="wg-chart-default mb-20 p-4 border border-gray-300 rounded-lg shadow-md flex justify-between items-center">
                                                    <div class="flex items-center gap14">
                                                        <div class="image ic-bg">
                                                            <i class="fas fa-list text-gray-700"></i>
                                                            <!-- Category icon -->
                                                        </div>
                                                        <div>
                                                            <div class="body-text mb-2">Total Categories</div>
                                                            <h4>{{ $category }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Total Recipes Card -->
                                                <div
                                                    class="wg-chart-default mb-20 p-4 border border-gray-300 rounded-lg shadow-md flex justify-between items-center">
                                                    <div class="flex items-center gap14">
                                                        <div class="image ic-bg">
                                                            <i class="fas fa-utensils text-gray-700"></i>
                                                            <!-- Recipe icon -->
                                                        </div>
                                                        <div>
                                                            <div class="body-text mb-2">Total Recipes</div>
                                                            <h4>{{ $recipes }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Total Reviews Card -->
                                                <div
                                                    class="wg-chart-default mb-20 p-4 border border-gray-300 rounded-lg shadow-md flex justify-between items-center">
                                                    <div class="flex items-center gap14">
                                                        <div class="image ic-bg">
                                                            <i class="fas fa-star text-gray-700"></i>
                                                            <!-- Review icon -->
                                                        </div>
                                                        <div>
                                                            <div class="body-text mb-2">Total Reviews</div>
                                                            <h4>{{ $reviews }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Chart Section -->
                    <div class="chat">
                        <div class="wg-box border border-gray-300 rounded-lg shadow-md p-6 bg-white">
                            <h5 class="text-lg font-semibold mb-4 text-center text-gray-800">Statistics Overview</h5>
                            <div class="relative" style="height: 300px;">
                                <canvas id="myChart" style="max-width: 100%; height: 100%; margin-left: 40%"></canvas>
                            </div>
                            <div class="mt-4 text-center">
                                <span class="text-sm text-gray-600">Data updated as of
                                    <strong>{{ date('Y-m-d') }}</strong></span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="bottom-page">
                    <div class="body-text" style=" margin-left: 40%">Copyright © 2024 K.AHESANALI All rights reserved </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Users', 'Categories', 'Recipes', 'Reviews'],
                    datasets: [{
                        label: 'Counts',
                        data: [{{ $users }}, {{ $category }}, {{ $recipes }},
                            {{ $reviews }}
                        ],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 99, 132, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

    </div>
    </div>
    </div>
    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
