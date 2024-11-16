@extends('layouts.app')

@section('content')
    <!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel Dashboard') }}</title>

        <!-- Add FontAwesome for icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .info-box {
                display: flex;
                align-items: center;
                background: #fff;
                border-radius: 12px;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                padding: 20px;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .info-box:hover {
                transform: translateY(-5px);
                box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
            }

            .info-box-icon {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 60px;
                height: 60px;
                border-radius: 50%;
                background: linear-gradient(135deg, #4e73df, #6e99ff);
                color: white;
                font-size: 24px;
                margin-right: 15px;
            }

            .info-box-content {
                flex-grow: 1;
            }

            .info-box-text {
                font-size: 16px;
                font-weight: 600;
                color: #555;
                margin-bottom: 5px;
            }

            .info-box-number {
                font-size: 24px;
                font-weight: 700;
                color: #333;
            }

            .row {
                margin-top: 30px;
            }
        </style>
    </head>

    <body>
        <div id="wrapper">
            <div id="page" class="mt-5">
                <div class="layout-wrap">
                    <div class="app-content"> <!--begin::Container-->
                        <div class="container-fluid">
                            <div class="row">
                                <!-- Card 1: All Users -->
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box">
                                        <div class="info-box-icon bg-primary">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <div class="info-box-content">
                                            <span class="info-box-text">All Users</span>
                                            <span class="info-box-number">{{ $users }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 2: Total Categories -->
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box">
                                        <div class="info-box-icon bg-danger">
                                            <i class="fas fa-folder"></i>
                                        </div>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Total Categories</span>
                                            <span class="info-box-number">{{ $category }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 3: Total Recipes -->
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box">
                                        <div class="info-box-icon bg-success">
                                            <i class="fas fa-book"></i>
                                        </div>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Total Recipes</span>
                                            <span class="info-box-number">{{ $recipes }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 4: Total Reviews -->
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box">
                                        <div class="info-box-icon bg-warning">
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Total Reviews</span>
                                            <span class="info-box-number">{{ $reviews }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!--end::Container-->
                    </div> <!--end::App Content-->
                </div>
            </div>
        </div>
              <!-- Chart.js CDN -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">

        <!-- Custom CSS -->
        <style>
            body {
                background-color: #f4f6f9;
                font-family: 'Arial', sans-serif;
            }

            .chart-card {
                margin: 2rem auto;
                padding: 2rem;
                border-radius: 10px;
                background: #fff;
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            }

            .chart-header {
                font-weight: bold;
                font-size: 1.5rem;
                text-align: center;
                margin-bottom: 1rem;
                color: #333;
            }

            canvas {
                max-height: 400px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="chart-card">
                <div class="chart-header">Dashboard Analytics</div>
                <canvas id="dashboardChart"></canvas>
            </div>
        </div>
        <script>
            const chartLabels = ['Users', 'Categories', 'Recipes', 'Reviews'];
            const chartData = [{{ $users }}, {{ $category }}, {{ $recipes }}, {{ $reviews }}];

            const ctx = document.getElementById('dashboardChart').getContext('2d');
            const dashboardChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Counts',
                        data: chartData,
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1,
                        borderRadius: 5,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                font: {
                                    size: 14
                                },
                                color: '#555'
                            }
                        },
                        tooltip: {
                            enabled: true,
                            backgroundColor: 'rgba(0,0,0,0.8)',
                            titleFont: { size: 14 },
                            bodyFont: { size: 12 },
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                font: {
                                    size: 12,
                                },
                                color: '#555'
                            },
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                font: {
                                    size: 12,
                                },
                                color: '#555'
                            },
                            grid: {
                                color: 'rgba(200, 200, 200, 0.2)'
                            }
                        }
                    }
                }
            });
        </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </body>

    </html>
@endsection
