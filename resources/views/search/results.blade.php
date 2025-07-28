<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - Research Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .result-card {
            transition: transform 0.2s;
            border-left: 4px solid #007bff;
        }
        .result-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .author-badge {
            background: #e9ecef;
            color: #495057;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.8em;
            margin: 2px;
            display: inline-block;
        }
        .keyword-badge {
            background: #d1ecf1;
            color: #0c5460;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.8em;
            margin: 2px;
            display: inline-block;
        }
        .institution-badge {
            background: #d4edda;
            color: #155724;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.8em;
            margin: 2px;
            display: inline-block;
        }
        .search-form {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        
        /* Pagination Styling */
        .pagination {
            justify-content: center;
            margin-top: 2rem;
        }
        .pagination .page-link {
            font-size: 1.1rem;
            padding: 0.75rem 1rem;
            margin: 0 2px;
            border-radius: 8px;
            border: 2px solid #dee2e6;
            color: #007bff;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .pagination .page-link:hover {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,123,255,0.3);
        }
        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
            font-weight: 600;
        }
        .pagination .page-item.disabled .page-link {
            color: #6c757d;
            background-color: #f8f9fa;
            border-color: #dee2e6;
        }
        
        /* Arrow Icons */
        .pagination .page-link[rel="prev"]::before {
            content: "‹";
            font-size: 1.5rem;
            font-weight: bold;
            line-height: 1;
        }
        .pagination .page-link[rel="next"]::before {
            content: "›";
            font-size: 1.5rem;
            font-weight: bold;
            line-height: 1;
        }
        
        /* Hide default text for prev/next */
        .pagination .page-link[rel="prev"] span,
        .pagination .page-link[rel="next"] span {
            display: none;
        }
        
        /* Responsive pagination */
        @media (max-width: 768px) {
            .pagination .page-link {
                font-size: 1rem;
                padding: 0.5rem 0.75rem;
                margin: 0 1px;
            }
            .pagination .page-link[rel="prev"]::before,
            .pagination .page-link[rel="next"]::before {
                font-size: 1.3rem;
            }
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
        <!-- Search Form -->
        <div class="search-form">
            <form method="GET" action="{{ route('search.basic') }}" class="row g-3">
                <div class="col-md-8">
                    <input type="text" class="form-control" name="q" placeholder="Search papers, authors, keywords..." 
                           value="{{ request('q', '') }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
            </form>
        </div>

        <!-- Results Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h2>
                    <i class="fas fa-list"></i> Search Results
                    @if(isset($query) && $query)
                        <small class="text-muted">for "{{ $query }}"</small>
                    @endif
                </h2>
                <p class="text-muted">
                    Found {{ $results->total() }} results
                    @if($results->hasPages())
                        (showing {{ $results->firstItem() }}-{{ $results->lastItem() }})
                    @endif
                </p>
            </div>
        </div>

        <!-- Results -->
        @if($results->count() > 0)
            <div class="row">
                @foreach($results as $paper)
                    <div class="col-12 mb-4">
                        <div class="card result-card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5 class="card-title">
                                            <a href="#" class="text-decoration-none">{{ $paper->title }}</a>
                                        </h5>
                                        <p class="card-text text-muted">
                                            {{ Str::limit($paper->abstract, 200) }}
                                        </p>
                                        
                                        <!-- Authors -->
                                        @if($paper->authors->count() > 0)
                                            <div class="mb-2">
                                                <strong><i class="fas fa-users"></i> Authors:</strong>
                                                @foreach($paper->authors as $author)
                                                    <span class="author-badge">{{ $author->name }}</span>
                                                @endforeach
                                            </div>
                                        @endif

                                        <!-- Keywords -->
                                        @if($paper->keywords->count() > 0)
                                            <div class="mb-2">
                                                <strong><i class="fas fa-tags"></i> Keywords:</strong>
                                                @foreach($paper->keywords as $keyword)
                                                    <span class="keyword-badge">{{ $keyword->word }}</span>
                                                @endforeach
                                            </div>
                                        @endif

                                        <!-- Institution -->
                                        @if($paper->institution)
                                            <div class="mb-2">
                                                <strong><i class="fas fa-university"></i> Institution:</strong>
                                                <span class="institution-badge">
                                                    {{ $paper->institution->name }}, {{ $paper->institution->country }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-end">
                                            <div class="mb-2">
                                                <small class="text-muted">
                                                    <i class="fas fa-calendar"></i> Published: {{ $paper->publication_date }}
                                                </small>
                                            </div>
                                            <div class="mb-2">
                                                <small class="text-muted">
                                                    <i class="fas fa-id-badge"></i> ID: {{ $paper->id }}
                                                </small>
                                            </div>
                                            <div class="mb-2">
                                                <span class="badge bg-primary">{{ $paper->authors->count() }} Authors</span>
                                                <span class="badge bg-success">{{ $paper->keywords->count() }} Keywords</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($results->hasPages())
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="Search results pagination">
                            {{ $results->appends(request()->query())->links() }}
                        </nav>
                    </div>
                </div>
            @endif
        @else
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle fa-2x mb-3"></i>
                        <h4>No results found</h4>
                        <p>Try adjusting your search terms or browse different search options.</p>
                        <a href="{{ route('search.index') }}" class="btn btn-primary">
                            <i class="fas fa-home"></i> Back to Search Home
                        </a>
                    </div>
                </div>
            </div>
        @endif

        <!-- Quick Search Links -->
        <div class="row mt-5">
            <div class="col-12">
                <h4><i class="fas fa-lightning-bolt"></i> Quick Search Options</h4>
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('search.recent') }}" class="btn btn-outline-success btn-sm w-100">
                            <i class="fas fa-clock"></i> Recent Papers
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('search.multi-author') }}" class="btn btn-outline-warning btn-sm w-100">
                            <i class="fas fa-users"></i> Multi-Author Papers
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('search.statistics') }}" class="btn btn-outline-info btn-sm w-100">
                            <i class="fas fa-chart-bar"></i> Statistics
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('search.advanced') }}" class="btn btn-outline-dark btn-sm w-100">
                            <i class="fas fa-cogs"></i> Advanced Search
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