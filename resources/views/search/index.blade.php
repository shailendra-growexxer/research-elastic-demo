<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research Database Search - ElasticSearch Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .search-card {
            transition: transform 0.2s;
        }
        .search-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .search-section {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
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
                <a class="nav-link" href="{{ route('search.statistics') }}">
                    <i class="fas fa-chart-bar"></i> Statistics
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-4">
                    <i class="fas fa-microscope"></i> Research Database Search Demo
                </h1>
                <p class="text-center text-muted mb-5">
                    Explore 5,000+ research papers with 50+ different search queries powered by MeiliSearch
                </p>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card stats-card text-center">
                    <div class="card-body">
                        <i class="fas fa-file-alt fa-2x mb-2"></i>
                        <h5>5,000+ Papers</h5>
                        <p class="mb-0">Research Publications</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stats-card text-center">
                    <div class="card-body">
                        <i class="fas fa-users fa-2x mb-2"></i>
                        <h5>2,000+ Authors</h5>
                        <p class="mb-0">Researchers</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stats-card text-center">
                    <div class="card-body">
                        <i class="fas fa-university fa-2x mb-2"></i>
                        <h5>100+ Institutions</h5>
                        <p class="mb-0">Universities & Labs</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stats-card text-center">
                    <div class="card-body">
                        <i class="fas fa-tags fa-2x mb-2"></i>
                        <h5>500+ Keywords</h5>
                        <p class="mb-0">Research Topics</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Basic Search -->
        <div class="search-section">
            <h3><i class="fas fa-search"></i> Basic Search</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="card search-card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-globe"></i> Full Text Search</h5>
                            <p class="card-text">Search across all fields including title, abstract, authors, and keywords.</p>
                            <a href="{{ route('search.basic') }}" class="btn btn-primary">Try Full Text Search</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card search-card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-file-alt"></i> Title Search</h5>
                            <p class="card-text">Search specifically in paper titles.</p>
                            <a href="{{ route('search.title') }}" class="btn btn-primary">Search by Title</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Field-Specific Searches -->
        <div class="search-section">
            <h3><i class="fas fa-filter"></i> Field-Specific Searches</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="card search-card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-align-left"></i> Abstract Search</h5>
                            <p class="card-text">Search within paper abstracts.</p>
                            <a href="{{ route('search.abstract') }}" class="btn btn-outline-primary">Search Abstracts</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card search-card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-user"></i> Author Search</h5>
                            <p class="card-text">Find papers by specific authors.</p>
                            <a href="{{ route('search.author') }}" class="btn btn-outline-primary">Search by Author</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card search-card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-university"></i> Institution Search</h5>
                            <p class="card-text">Find papers from specific institutions.</p>
                            <a href="{{ route('search.institution') }}" class="btn btn-outline-primary">Search by Institution</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="card search-card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-flag"></i> Country Search</h5>
                            <p class="card-text">Find papers from specific countries.</p>
                            <a href="{{ route('search.country') }}" class="btn btn-outline-primary">Search by Country</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card search-card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-tag"></i> Keyword Search</h5>
                            <p class="card-text">Search by research keywords and topics.</p>
                            <a href="{{ route('search.keyword') }}" class="btn btn-outline-primary">Search by Keyword</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Date-Based Searches -->
        <div class="search-section">
            <h3><i class="fas fa-calendar"></i> Date-Based Searches</h3>
            <div class="row">
                <div class="col-md-3">
                    <div class="card search-card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-clock"></i> Recent Papers</h5>
                            <p class="card-text">Latest publications.</p>
                            <a href="{{ route('search.recent') }}" class="btn btn-outline-success">Recent Papers</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card search-card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-history"></i> Old Papers</h5>
                            <p class="card-text">Historical publications.</p>
                            <a href="{{ route('search.old') }}" class="btn btn-outline-success">Old Papers</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card search-card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-calendar-alt"></i> By Year</h5>
                            <p class="card-text">Papers from specific years.</p>
                            <a href="{{ route('search.by-year') }}" class="btn btn-outline-success">By Year</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card search-card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-calendar-day"></i> By Month</h5>
                            <p class="card-text">Papers from specific months.</p>
                            <a href="{{ route('search.by-month') }}" class="btn btn-outline-success">By Month</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Advanced Searches -->
        <div class="search-section">
            <h3><i class="fas fa-cogs"></i> Advanced Searches</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="card search-card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-users"></i> Multi-Author Papers</h5>
                            <p class="card-text">Papers with multiple authors.</p>
                            <a href="{{ route('search.multi-author') }}" class="btn btn-outline-warning">Multi-Author</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card search-card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-user"></i> Single Author Papers</h5>
                            <p class="card-text">Papers with single authors.</p>
                            <a href="{{ route('search.single-author') }}" class="btn btn-outline-warning">Single Author</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card search-card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-tags"></i> Many Keywords</h5>
                            <p class="card-text">Papers with many keywords.</p>
                            <a href="{{ route('search.many-keywords') }}" class="btn btn-outline-warning">Many Keywords</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Analytics & Statistics -->
        <div class="search-section">
            <h3><i class="fas fa-chart-bar"></i> Analytics & Statistics</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="card search-card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-chart-pie"></i> Statistics</h5>
                            <p class="card-text">Database statistics and metrics.</p>
                            <a href="{{ route('search.statistics') }}" class="btn btn-outline-info">View Statistics</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card search-card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-trophy"></i> Top Authors</h5>
                            <p class="card-text">Most published authors.</p>
                            <a href="{{ route('search.top-authors') }}" class="btn btn-outline-info">Top Authors</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card search-card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-medal"></i> Top Institutions</h5>
                            <p class="card-text">Most active institutions.</p>
                            <a href="{{ route('search.top-institutions') }}" class="btn btn-outline-info">Top Institutions</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Specialized Search Types -->
        <div class="search-section">
            <h3><i class="fas fa-magic"></i> Specialized Search Types</h3>
            <div class="row">
                <div class="col-md-3">
                    <div class="card search-card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-search-plus"></i> Fuzzy Search</h5>
                            <p class="card-text">Tolerant search with typos.</p>
                            <a href="{{ route('search.fuzzy') }}" class="btn btn-outline-secondary">Fuzzy Search</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card search-card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-quote-left"></i> Phrase Search</h5>
                            <p class="card-text">Exact phrase matching.</p>
                            <a href="{{ route('search.phrase') }}" class="btn btn-outline-secondary">Phrase Search</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card search-card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-sort"></i> Sort Search</h5>
                            <p class="card-text">Search with sorting options.</p>
                            <a href="{{ route('search.sort') }}" class="btn btn-outline-secondary">Sort Search</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card search-card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-filter"></i> Filter Search</h5>
                            <p class="card-text">Search with filters.</p>
                            <a href="{{ route('search.filter') }}" class="btn btn-outline-secondary">Filter Search</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Complex Searches -->
        <div class="search-section">
            <h3><i class="fas fa-puzzle-piece"></i> Complex Searches</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="card search-card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-cogs"></i> Complex Search</h5>
                            <p class="card-text">Multi-field search with relationships.</p>
                            <a href="{{ route('search.complex') }}" class="btn btn-outline-dark">Complex Search</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card search-card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-sliders-h"></i> Advanced Search</h5>
                            <p class="card-text">Advanced search with all options.</p>
                            <a href="{{ route('search.advanced') }}" class="btn btn-outline-dark">Advanced Search</a>
                        </div>
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