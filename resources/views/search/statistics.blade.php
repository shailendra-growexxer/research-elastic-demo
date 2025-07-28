<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Statistics - Research Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            transition: transform 0.2s;
        }
        .stats-card:hover {
            transform: translateY(-5px);
        }
        .metric-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid #007bff;
        }
        .chart-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('search.index') }}">
                <i class="fas fa-search"></i> Research Database Search
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('search.index') }}">
                    <i class="fas fa-home"></i> Home
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-4">
                    <i class="fas fa-chart-bar"></i> Database Statistics
                </h1>
                <p class="text-center text-muted mb-5">
                    Comprehensive analytics and metrics for the research database
                </p>
            </div>
        </div>

        <!-- Key Statistics -->
        <div class="row mb-5">
            <div class="col-md-3">
                <div class="card stats-card text-center">
                    <div class="card-body">
                        <i class="fas fa-file-alt fa-3x mb-3"></i>
                        <h2>{{ number_format($stats['total_papers']) }}</h2>
                        <h5>Total Papers</h5>
                        <p class="mb-0">Research Publications</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stats-card text-center">
                    <div class="card-body">
                        <i class="fas fa-users fa-3x mb-3"></i>
                        <h2>{{ number_format($stats['total_authors']) }}</h2>
                        <h5>Total Authors</h5>
                        <p class="mb-0">Researchers</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stats-card text-center">
                    <div class="card-body">
                        <i class="fas fa-university fa-3x mb-3"></i>
                        <h2>{{ number_format($stats['total_institutions']) }}</h2>
                        <h5>Total Institutions</h5>
                        <p class="mb-0">Universities & Labs</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stats-card text-center">
                    <div class="card-body">
                        <i class="fas fa-tags fa-3x mb-3"></i>
                        <h2>{{ number_format($stats['total_keywords']) }}</h2>
                        <h5>Total Keywords</h5>
                        <p class="mb-0">Research Topics</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Publication Statistics -->
        <div class="row mb-5">
            <div class="col-md-6">
                <div class="metric-card">
                    <h4><i class="fas fa-calendar"></i> Publication Statistics</h4>
                    <div class="row">
                        <div class="col-6">
                            <div class="text-center">
                                <h3 class="text-success">{{ number_format($stats['papers_this_year']) }}</h3>
                                <p class="text-muted">Papers This Year</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <h3 class="text-info">{{ number_format($stats['papers_last_year']) }}</h3>
                                <p class="text-muted">Papers Last Year</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="metric-card">
                    <h4><i class="fas fa-chart-line"></i> Average Metrics</h4>
                    <div class="row">
                        <div class="col-6">
                            <div class="text-center">
                                <h3 class="text-primary">{{ number_format($stats['avg_authors_per_paper'], 1) }}</h3>
                                <p class="text-muted">Avg Authors/Paper</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <h3 class="text-warning">{{ number_format($stats['avg_keywords_per_paper'], 1) }}</h3>
                                <p class="text-muted">Avg Keywords/Paper</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Database Coverage -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="chart-container">
                    <h4><i class="fas fa-database"></i> Database Coverage</h4>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="text-center">
                                <div class="progress-circle" style="width: 100px; height: 100px; margin: 0 auto;">
                                    <svg width="100" height="100">
                                        <circle cx="50" cy="50" r="40" fill="none" stroke="#e9ecef" stroke-width="8"/>
                                        <circle cx="50" cy="50" r="40" fill="none" stroke="#007bff" stroke-width="8" 
                                                stroke-dasharray="{{ (5000/5000)*251.2 }}" stroke-dashoffset="0"/>
                                    </svg>
                                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                        <strong>100%</strong>
                                    </div>
                                </div>
                                <p class="mt-2">Papers Indexed</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <div class="progress-circle" style="width: 100px; height: 100px; margin: 0 auto;">
                                    <svg width="100" height="100">
                                        <circle cx="50" cy="50" r="40" fill="none" stroke="#e9ecef" stroke-width="8"/>
                                        <circle cx="50" cy="50" r="40" fill="none" stroke="#28a745" stroke-width="8" 
                                                stroke-dasharray="{{ (2000/2000)*251.2 }}" stroke-dashoffset="0"/>
                                    </svg>
                                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                        <strong>100%</strong>
                                    </div>
                                </div>
                                <p class="mt-2">Authors Indexed</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <div class="progress-circle" style="width: 100px; height: 100px; margin: 0 auto;">
                                    <svg width="100" height="100">
                                        <circle cx="50" cy="50" r="40" fill="none" stroke="#e9ecef" stroke-width="8"/>
                                        <circle cx="50" cy="50" r="40" fill="none" stroke="#ffc107" stroke-width="8" 
                                                stroke-dasharray="{{ (100/100)*251.2 }}" stroke-dashoffset="0"/>
                                    </svg>
                                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                        <strong>100%</strong>
                                    </div>
                                </div>
                                <p class="mt-2">Institutions Indexed</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <div class="progress-circle" style="width: 100px; height: 100px; margin: 0 auto;">
                                    <svg width="100" height="100">
                                        <circle cx="50" cy="50" r="40" fill="none" stroke="#e9ecef" stroke-width="8"/>
                                        <circle cx="50" cy="50" r="40" fill="none" stroke="#dc3545" stroke-width="8" 
                                                stroke-dasharray="{{ (500/500)*251.2 }}" stroke-dashoffset="0"/>
                                    </svg>
                                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                        <strong>100%</strong>
                                    </div>
                                </div>
                                <p class="mt-2">Keywords Indexed</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Performance -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="chart-container">
                    <h4><i class="fas fa-tachometer-alt"></i> Search Performance</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="text-center">
                                <i class="fas fa-bolt fa-3x text-warning mb-3"></i>
                                <h4>Lightning Fast</h4>
                                <p class="text-muted">MeiliSearch provides sub-second search results</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center">
                                <i class="fas fa-search fa-3x text-primary mb-3"></i>
                                <h4>50+ Search Types</h4>
                                <p class="text-muted">Comprehensive search functionality</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center">
                                <i class="fas fa-mobile-alt fa-3x text-success mb-3"></i>
                                <h4>Mobile Friendly</h4>
                                <p class="text-muted">Responsive design for all devices</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row">
            <div class="col-12">
                <h4><i class="fas fa-rocket"></i> Quick Actions</h4>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('search.top-authors') }}" class="btn btn-outline-primary w-100">
                            <i class="fas fa-trophy"></i> Top Authors
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('search.top-institutions') }}" class="btn btn-outline-success w-100">
                            <i class="fas fa-medal"></i> Top Institutions
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('search.top-keywords') }}" class="btn btn-outline-warning w-100">
                            <i class="fas fa-tags"></i> Top Keywords
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('search.index') }}" class="btn btn-outline-dark w-100">
                            <i class="fas fa-search"></i> Start Searching
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p class="mb-0">
                <i class="fas fa-search"></i> Research Database Search Demo - 
                Powered by Laravel, MeiliSearch, and Bootstrap
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 