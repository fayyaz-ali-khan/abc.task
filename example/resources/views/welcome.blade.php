@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Analytics Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <input type="date" class="form-control me-2">
            <input type="date" class="form-control">
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">

                <div class="card-body">
                    <canvas id="gaChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-4">
            <div class="chart-container">
                <canvas id="cityChart"></canvas>
            </div>
        </div>
        <div class="col-md-4">
            <div class="chart-container">
                <canvas id="countryChart"></canvas>
            </div>
        </div>
        <div class="col-md-4">
            <div class="chart-container">
                <canvas id="deviceChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Unified Dummy Data
            const dummyData = {
                dates: ['Dec', 'Jan', 'Feb', 'Mar', 'Apr'],
                clarity: [800, 750, 820, 900, 850],
                facebook: [450, 500, 470, 600, 550],
                instagram: [1200, 1300, 1250, 1400, 1350],
                snapchat: [300, 350, 320, 400, 380]
            };
            let seedData = @json($seedData);

            let seed_input = seedData.map((item) => {
                return item.total_seed_input;
            });
            let seed_response = seedData.map((item) => {
                return item.total_seed_response;
            });
            let months = seedData.map((item) => {
                return item.month;
            });



            new Chart(document.getElementById('gaChart'), {
                type: 'line',
                data: {
                    labels: months,
                    datasets: [{
                            label: 'Seed Total',
                            data: seed_input,
                            borderColor: '#2c7be5',
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'Seed Response',
                            data: seed_response,
                            borderColor: 'cyan',
                            tension: 0.3,
                            fill: true
                        }
                    ]
                },
                options: {
                    plugins: {
                        legend: {
                            display: true
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            new Chart(document.getElementById('cityChart'), {
                type: 'pie',
                data: {
                    labels: ['Facebook', 'Instagram', 'Snapchat'],
                    datasets: [{
                        label: 'Social Media Usage',
                        // Assuming you want to show totals - sum all values for each platform
                        data: [
                            dummyData.facebook.reduce((a, b) => a + b, 0),
                            dummyData.instagram.reduce((a, b) => a + b, 0),
                            dummyData.snapchat.reduce((a, b) => a + b, 0)
                        ],
                        backgroundColor: ['#1877f2', '#e4405f', '#fffc00']
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'City'
                        },
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                padding: 20
                            }
                        }
                    }
                }
            });
            new Chart(document.getElementById('countryChart'), {
                type: 'pie',
                data: {
                    labels: ['Facebook', 'Instagram', 'Snapchat'],
                    datasets: [{
                        label: 'Social Media Usage',
                        data: [
                            dummyData.facebook.reduce((a, b) => a + b, 0),
                            dummyData.instagram.reduce((a, b) => a + b, 0),
                            dummyData.snapchat.reduce((a, b) => a + b, 0)
                        ],
                        backgroundColor: ['#1877f2', '#e4405f', '#fffc00']
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Country'
                        },
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                padding: 20
                            }
                        }
                    }
                }
            });

            new Chart(document.getElementById('deviceChart'), {
                type: 'pie',
                data: {
                    labels: ['Android', 'Iphone', 'PC'],
                    datasets: [{
                        label: 'Social Media Usage',
                        data: [
                            dummyData.facebook.reduce((a, b) => a + b, 0),
                            dummyData.instagram.reduce((a, b) => a + b, 0),
                            dummyData.snapchat.reduce((a, b) => a + b, 0)
                        ],
                        backgroundColor: ['#1877f2', '#e4405f', '#fffc00']
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Devices'
                        },
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                padding: 20
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
