@extends('layouts.app')

@section('content')
    <!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Add FontAwesome for icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>

    <body class="body">
        <div id="wrapper">
            <div id="page" class="">
                <div class="layout-wrap">
                    {{-- <div class="main-content">
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
                                                <div
                                                    class="wg-chart-default mb-20 p-4 border border-gray-300 rounded-lg shadow-md flex justify-between items-center">
                                                    <div class="flex items-center gap14">
                                                        <div class="image ic-bg">
                                                            <i class="fas fa-box text-green-600 text-xl"></i>
                                                            <!-- Recipe icon -->
                                                        </div>
                                                        <div>
                                                            <div class="body-text mb-2">Total Units</div>
                                                            <h4>{{ $units }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="app-content my-4"> <!--begin::Container-->
                        <div class="container-fluid"> <!-- Info boxes -->
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box"> <span class="info-box-icon text-bg-primary shadow-sm"> <i class="bi bi-gear-fill"></i> </span>
                                        <div class="info-box-content"> <span class="info-box-text">All User</span> <span class="info-box-number">
                                            {{ $users }}
                                               </span> </div> <!-- /.info-box-content -->
                                    </div> <!-- /.info-box -->
                                </div> <!-- /.col -->
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box"> <span class="info-box-icon text-bg-danger shadow-sm"> <i class="bi bi-hand-thumbs-up-fill"></i> </span>
                                        <div class="info-box-content"> <span class="info-box-text">Total Categories</span> <span class="info-box-number">{{ $category }}</span> </div> <!-- /.info-box-content -->
                                    </div> <!-- /.info-box -->
                                </div> <!-- /.col --> <!-- fix for small devices only --> <!-- <div class="clearfix hidden-md-up"></div> -->
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box"> <span class="info-box-icon text-bg-success shadow-sm"> <i class="bi bi-cart-fill"></i> </span>
                                        <div class="info-box-content"> <span class="info-box-text">Total Recipes</span> <span class="info-box-number">{{ $recipes }}</span> </div> <!-- /.info-box-content -->
                                    </div> <!-- /.info-box -->
                                </div> <!-- /.col -->
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box"> <span class="info-box-icon text-bg-warning shadow-sm"> <i class="bi bi-people-fill"></i> </span>
                                        <div class="info-box-content"> <span class="info-box-text">Total Reviews</span> <span class="info-box-number">{{ $reviews }}</span> </div> <!-- /.info-box-content -->
                                    </div> <!-- /.info-box -->
                                </div> <!-- /.col -->
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box"> <span class="info-box-icon text-bg-warning shadow-sm"> <i class="bi bi-people-fill"></i> </span>
                                        <div class="info-box-content"> <span class="info-box-text">Total Units</span> <span class="info-box-number">{{ $units }}</span> </div> <!-- /.info-box-content -->
                                    </div> <!-- /.info-box -->
                                </div> <!-- /.col -->
                            </div> <!-- /.row --> <!--begin::Row-->
                        </div> <!--end::Container-->
                    </div> <!--end::App Content-->
                    <script src="{{ asset('js/jquery.min.js') }}"></script>
                    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
                    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
                    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
                    <script src="{{ asset('js/apexcharts/apexcharts.js') }}"></script>
                    <script src="{{ asset('js/main.js') }}"></script>
    </body>

    </html>
@endsection
