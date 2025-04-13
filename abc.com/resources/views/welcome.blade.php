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
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Google Analytics
                </div>
                <div class="card-body">
                    <canvas id="gaChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    Microsoft Clarity
                </div>
                <div class="card-body">
                    <canvas id="clarityChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    Facebook
                </div>
                <div class="card-body">
                    <canvas id="fbChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-warning text-dark">
                    Instagram
                </div>
                <div class="card-body">
                    <canvas id="igChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-danger text-white">
                    Snapchat
                </div>
                <div class="card-body">
                    <canvas id="scChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- CRUD Section -->
    <div class="row mt-4" id="crud">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Manage Data</h5>
                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
                        Add New Data
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Platform</th>
                                <th>Visits</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Sample Data -->
                            <tr>
                                <td>Facebook</td>
                                <td>1500</td>
                                <td>2023-08-01</td>
                                <td>
                                    <button class="btn btn-sm btn-primary">Edit</button>
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Data Modal -->
    <div class="modal fade" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Platform</label>
                            <select class="form-select">
                                <option>Google Analytics</option>
                                <option>Microsoft Clarity</option>
                                <option>Facebook</option>
                                <option>Instagram</option>
                                <option>Snapchat</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Visits</label>
                            <input type="number" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Chart initialization
        document.addEventListener('DOMContentLoaded', function() {
            const charts = {
                gaChart: createChart('line', ['Visits', 'Pageviews'], [1200, 1800, 1500, 2000]),
                clarityChart: createChart('bar', ['Sessions', 'Users'], [800, 500, 600]),
                fbChart: createChart('doughnut', ['Profile Visits', 'Post Views'], [700, 300]),
                igChart: createChart('polarArea', ['Impressions', 'Engagements'], [400, 200]),
                scChart: createChart('line', ['Story Views', 'Shares'], [300, 150])
            };

            function createChart(type, labels, data) {
                return new Chart(document.getElementById(type + 'Chart'), {
                    type: type,
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.5)',
                                'rgba(54, 162, 235, 0.5)',
                                'rgba(255, 206, 86, 0.5)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            }
        });
    </script>
@endsection
