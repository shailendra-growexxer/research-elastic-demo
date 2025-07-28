<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Authors - Research Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .author-card {
            transition: transform 0.2s;
            border-left: 4px solid #28a745;
        }
        .author-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .rank-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: bold;
        }
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
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
                    <i class="fas fa-trophy"></i> Top Authors by Publication Count
                </h1>
                <p class="text-center text-muted mb-5">
                    Most published authors in the research database
                </p>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card stats-card text-center">
                    <div class="card-body">
                        <i class="fas fa-users fa-2x mb-2"></i>
                        <h5>{{ $authors->count() }} Authors</h5>
                        <p class="mb-0">Top Researchers</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stats-card text-center">
                    <div class="card-body">
                        <i class="fas fa-file-alt fa-2x mb-2"></i>
                        <h5>{{ $authors->sum('research_papers_count') }} Papers</h5>
                        <p class="mb-0">Total Publications</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stats-card text-center">
                    <div class="card-body">
                        <i class="fas fa-chart-line fa-2x mb-2"></i>
                        <h5>{{ number_format($authors->avg('research_papers_count'), 1) }} Avg</h5>
                        <p class="mb-0">Papers per Author</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Authors List -->
        @if($authors->count() > 0)
            <div class="row">
                @foreach($authors as $index => $author)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card author-card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <span class="badge rank-badge fs-6">#{{ $index + 1 }}</span>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-success fs-6">{{ $author->research_papers_count }} Papers</span>
                                    </div>
                                </div>
                                
                                <h5 class="card-title">
                                    <i class="fas fa-user"></i> {{ $author->name }}
                                </h5>
                                
                                <div class="mb-3">
                                    <small class="text-muted">
                                        <i class="fas fa-envelope"></i> {{ $author->email }}
                                    </small>
                                </div>

                                @if($author->institution)
                                    <div class="mb-3">
                                        <strong><i class="fas fa-university"></i> Institution:</strong>
                                        <div class="text-muted">
                                            {{ $author->institution->name }}, {{ $author->institution->country }}
                                        </div>
                                    </div>
                                @endif

                                <div class="mt-auto">
                                    <a href="{{ route('search.by-author', ['author_id' => $author->id]) }}" 
                                       class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-search"></i> View Papers
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle fa-2x mb-3"></i>
                        <h4>No authors found</h4>
                        <p>No author data available in the database.</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Quick Links -->
        <div class="row mt-5">
            <div class="col-12">
                <h4><i class="fas fa-lightning-bolt"></i> Quick Links</h4>
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('search.top-institutions') }}" class="btn btn-outline-info btn-sm w-100">
                            <i class="fas fa-university"></i> Top Institutions
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('search.top-keywords') }}" class="btn btn-outline-warning btn-sm w-100">
                            <i class="fas fa-tags"></i> Top Keywords
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('search.statistics') }}" class="btn btn-outline-secondary btn-sm w-100">
                            <i class="fas fa-chart-bar"></i> Statistics
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('search.index') }}" class="btn btn-outline-primary btn-sm w-100">
                            <i class="fas fa-home"></i> Search Home
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