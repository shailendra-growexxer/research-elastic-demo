<?php

namespace App\Http\Controllers;

use App\Models\ResearchPaper;
use App\Models\Author;
use App\Models\Institution;
use App\Models\Keyword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index()
    {
        return view('search.index');
    }

    // Basic Search
    public function basicSearch(Request $request)
    {
        $query = $request->get('q', '');
        $results = ResearchPaper::search($query)->paginate(20);
        return view('search.results', compact('results', 'query'));
    }

    // Search by Title
    public function searchByTitle(Request $request)
    {
        $title = $request->get('title', '');
        $results = ResearchPaper::search($title)->paginate(20);
        return view('search.results', compact('results', 'title'));
    }

    // Search by Abstract
    public function searchByAbstract(Request $request)
    {
        $abstract = $request->get('abstract', '');
        $results = ResearchPaper::search($abstract)->paginate(20);
        return view('search.results', compact('results', 'abstract'));
    }

    // Search by Author
    public function searchByAuthor(Request $request)
    {
        $author = $request->get('author', '');
        $results = ResearchPaper::search($author)->paginate(20);
        return view('search.results', compact('results', 'author'));
    }

    // Search by Institution
    public function searchByInstitution(Request $request)
    {
        $institution = $request->get('institution', '');
        $results = ResearchPaper::search($institution)->paginate(20);
        return view('search.results', compact('results', 'institution'));
    }

    // Search by Country
    public function searchByCountry(Request $request)
    {
        $country = $request->get('country', '');
        $results = ResearchPaper::search($country)->paginate(20);
        return view('search.results', compact('results', 'country'));
    }

    // Search by Keyword
    public function searchByKeyword(Request $request)
    {
        $keyword = $request->get('keyword', '');
        $results = ResearchPaper::search($keyword)->paginate(20);
        return view('search.results', compact('results', 'keyword'));
    }

    // Search by Date Range
    public function searchByDateRange(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        
        $query = ResearchPaper::query();
        
        if ($startDate) {
            $query->where('publication_date', '>=', $startDate);
        }
        if ($endDate) {
            $query->where('publication_date', '<=', $endDate);
        }
        
        $results = $query->paginate(20);
        return view('search.results', compact('results', 'startDate', 'endDate'));
    }

    // Recent Papers
    public function recentPapers()
    {
        $results = ResearchPaper::orderBy('publication_date', 'desc')->paginate(20);
        return view('search.results', compact('results'));
    }

    // Old Papers
    public function oldPapers()
    {
        $results = ResearchPaper::orderBy('publication_date', 'asc')->paginate(20);
        return view('search.results', compact('results'));
    }

    // Papers by Year
    public function papersByYear(Request $request)
    {
        $year = $request->get('year', date('Y'));
        $results = ResearchPaper::whereYear('publication_date', $year)->paginate(20);
        return view('search.results', compact('results', 'year'));
    }

    // Papers by Month
    public function papersByMonth(Request $request)
    {
        $month = $request->get('month', date('m'));
        $year = $request->get('year', date('Y'));
        $results = ResearchPaper::whereYear('publication_date', $year)
            ->whereMonth('publication_date', $month)
            ->paginate(20);
        return view('search.results', compact('results', 'month', 'year'));
    }

    // Multi-Author Papers
    public function multiAuthorPapers()
    {
        $results = ResearchPaper::select('research_papers.*')
            ->selectRaw('COUNT(author_research_paper.author_id) as authors_count')
            ->join('author_research_paper', 'research_papers.id', '=', 'author_research_paper.research_paper_id')
            ->groupBy('research_papers.id')
            ->having('authors_count', '>', 1)
            ->orderBy('authors_count', 'desc')
            ->paginate(20);
        return view('search.results', compact('results'));
    }

    // Single Author Papers
    public function singleAuthorPapers()
    {
        $results = ResearchPaper::select('research_papers.*')
            ->selectRaw('COUNT(author_research_paper.author_id) as authors_count')
            ->join('author_research_paper', 'research_papers.id', '=', 'author_research_paper.research_paper_id')
            ->groupBy('research_papers.id')
            ->having('authors_count', '=', 1)
            ->paginate(20);
        return view('search.results', compact('results'));
    }

    // Papers with Many Keywords
    public function papersWithManyKeywords()
    {
        $results = ResearchPaper::select('research_papers.*')
            ->selectRaw('COUNT(keyword_research_paper.keyword_id) as keywords_count')
            ->join('keyword_research_paper', 'research_papers.id', '=', 'keyword_research_paper.research_paper_id')
            ->groupBy('research_papers.id')
            ->having('keywords_count', '>', 5)
            ->orderBy('keywords_count', 'desc')
            ->paginate(20);
        return view('search.results', compact('results'));
    }

    // Papers with Few Keywords
    public function papersWithFewKeywords()
    {
        $results = ResearchPaper::select('research_papers.*')
            ->selectRaw('COUNT(keyword_research_paper.keyword_id) as keywords_count')
            ->join('keyword_research_paper', 'research_papers.id', '=', 'keyword_research_paper.research_paper_id')
            ->groupBy('research_papers.id')
            ->having('keywords_count', '<=', 3)
            ->orderBy('keywords_count', 'asc')
            ->paginate(20);
        return view('search.results', compact('results'));
    }

    // Papers by Institution Type
    public function papersByInstitutionType(Request $request)
    {
        $type = $request->get('type', 'University');
        $results = ResearchPaper::whereHas('institution', function($q) use ($type) {
            $q->where('name', 'like', "%{$type}%");
        })->paginate(20);
        return view('search.results', compact('results', 'type'));
    }

    // Papers by Country
    public function papersByCountry(Request $request)
    {
        $country = $request->get('country', '');
        $results = ResearchPaper::whereHas('institution', function($q) use ($country) {
            $q->where('country', 'like', "%{$country}%");
        })->paginate(20);
        return view('search.results', compact('results', 'country'));
    }

    // Papers by Author Count
    public function papersByAuthorCount(Request $request)
    {
        $count = $request->get('count', 2);
        $results = ResearchPaper::select('research_papers.*')
            ->selectRaw('COUNT(author_research_paper.author_id) as authors_count')
            ->join('author_research_paper', 'research_papers.id', '=', 'author_research_paper.research_paper_id')
            ->groupBy('research_papers.id')
            ->having('authors_count', '>=', $count)
            ->orderBy('authors_count', 'desc')
            ->paginate(20);
        return view('search.results', compact('results', 'count'));
    }

    // Papers by Keyword Count
    public function papersByKeywordCount(Request $request)
    {
        $count = $request->get('count', 5);
        $results = ResearchPaper::select('research_papers.*')
            ->selectRaw('COUNT(keyword_research_paper.keyword_id) as keywords_count')
            ->join('keyword_research_paper', 'research_papers.id', '=', 'keyword_research_paper.research_paper_id')
            ->groupBy('research_papers.id')
            ->having('keywords_count', '>=', $count)
            ->orderBy('keywords_count', 'desc')
            ->paginate(20);
        return view('search.results', compact('results', 'count'));
    }

    // Complex Search
    public function complexSearch(Request $request)
    {
        $title = $request->get('title');
        $author = $request->get('author');
        $institution = $request->get('institution');
        $keyword = $request->get('keyword');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        $query = ResearchPaper::query();

        if ($title) {
            $query->where('title', 'like', "%{$title}%");
        }
        if ($author) {
            $query->whereHas('authors', function($q) use ($author) {
                $q->where('name', 'like', "%{$author}%");
            });
        }
        if ($institution) {
            $query->whereHas('institution', function($q) use ($institution) {
                $q->where('name', 'like', "%{$institution}%");
            });
        }
        if ($keyword) {
            $query->whereHas('keywords', function($q) use ($keyword) {
                $q->where('word', 'like', "%{$keyword}%");
            });
        }
        if ($startDate) {
            $query->where('publication_date', '>=', $startDate);
        }
        if ($endDate) {
            $query->where('publication_date', '<=', $endDate);
        }

        $results = $query->paginate(20);
        return view('search.results', compact('results', 'title', 'author', 'institution', 'keyword', 'startDate', 'endDate'));
    }

    // Statistics
    public function statistics()
    {
        $stats = [
            'total_papers' => ResearchPaper::count(),
            'total_authors' => Author::count(),
            'total_institutions' => Institution::count(),
            'total_keywords' => Keyword::count(),
            'avg_authors_per_paper' => round(DB::table('author_research_paper')->count() / max(ResearchPaper::count(), 1), 2),
            'avg_keywords_per_paper' => round(DB::table('keyword_research_paper')->count() / max(ResearchPaper::count(), 1), 2),
            'recent_papers' => ResearchPaper::where('publication_date', '>=', now()->subYear())->count(),
            'oldest_paper' => ResearchPaper::min('publication_date'),
            'newest_paper' => ResearchPaper::max('publication_date'),
            'papers_this_year' => ResearchPaper::whereYear('publication_date', date('Y'))->count(),
            'papers_last_year' => ResearchPaper::whereYear('publication_date', date('Y') - 1)->count(),
        ];

        return view('search.statistics', compact('stats'));
    }

    // Top Authors
    public function topAuthors()
    {
        $authors = Author::select('authors.*')
            ->selectRaw('COUNT(author_research_paper.research_paper_id) as research_papers_count')
            ->join('author_research_paper', 'authors.id', '=', 'author_research_paper.author_id')
            ->groupBy('authors.id')
            ->orderBy('research_papers_count', 'desc')
            ->limit(20)
            ->get();

        return view('search.top-authors', compact('authors'));
    }

    // Top Institutions
    public function topInstitutions()
    {
        $institutions = Institution::select('institutions.*')
            ->selectRaw('COUNT(research_papers.id) as research_papers_count')
            ->join('research_papers', 'institutions.id', '=', 'research_papers.institution_id')
            ->groupBy('institutions.id')
            ->orderBy('research_papers_count', 'desc')
            ->limit(20)
            ->get();

        return view('search.top-institutions', compact('institutions'));
    }

    // Top Keywords
    public function topKeywords()
    {
        $keywords = Keyword::select('keywords.*')
            ->selectRaw('COUNT(keyword_research_paper.research_paper_id) as research_papers_count')
            ->join('keyword_research_paper', 'keywords.id', '=', 'keyword_research_paper.keyword_id')
            ->groupBy('keywords.id')
            ->orderBy('research_papers_count', 'desc')
            ->limit(20)
            ->get();

        return view('search.top-keywords', compact('keywords'));
    }

    // Papers by Institution
    public function papersByInstitution(Request $request)
    {
        $institutionId = $request->get('institution_id');
        $institution = Institution::find($institutionId);
        $results = ResearchPaper::where('institution_id', $institutionId)->paginate(20);
        return view('search.results', compact('results', 'institution'));
    }

    // Papers by Author
    public function papersByAuthor(Request $request)
    {
        $authorId = $request->get('author_id');
        $author = Author::find($authorId);
        $results = ResearchPaper::whereHas('authors', function($q) use ($authorId) {
            $q->where('authors.id', $authorId);
        })->paginate(20);
        return view('search.results', compact('results', 'author'));
    }

    // Papers by Keyword
    public function papersByKeyword(Request $request)
    {
        $keywordId = $request->get('keyword_id');
        $keyword = Keyword::find($keywordId);
        $results = ResearchPaper::whereHas('keywords', function($q) use ($keywordId) {
            $q->where('keywords.id', $keywordId);
        })->paginate(20);
        return view('search.results', compact('results', 'keyword'));
    }

    // Full Text Search
    public function fullTextSearch(Request $request)
    {
        $query = $request->get('q', '');
        $results = ResearchPaper::search($query)->paginate(20);
        return view('search.results', compact('results', 'query'));
    }

    // Fuzzy Search
    public function fuzzySearch(Request $request)
    {
        $query = $request->get('q', '');
        $results = ResearchPaper::search($query)->paginate(20);
        return view('search.results', compact('results', 'query'));
    }

    // Wildcard Search
    public function wildcardSearch(Request $request)
    {
        $query = $request->get('q', '');
        $results = ResearchPaper::search($query)->paginate(20);
        return view('search.results', compact('results', 'query'));
    }

    // Phrase Search
    public function phraseSearch(Request $request)
    {
        $phrase = $request->get('phrase', '');
        $results = ResearchPaper::search('"' . $phrase . '"')->paginate(20);
        return view('search.results', compact('results', 'phrase'));
    }

    // Boolean Search
    public function booleanSearch(Request $request)
    {
        $query = $request->get('q', '');
        $results = ResearchPaper::search($query)->paginate(20);
        return view('search.results', compact('results', 'query'));
    }

    // Proximity Search
    public function proximitySearch(Request $request)
    {
        $query = $request->get('q', '');
        $results = ResearchPaper::search($query)->paginate(20);
        return view('search.results', compact('results', 'query'));
    }

    // Field Search
    public function fieldSearch(Request $request)
    {
        $field = $request->get('field', 'title');
        $value = $request->get('value', '');
        $results = ResearchPaper::search($value)->paginate(20);
        return view('search.results', compact('results', 'field', 'value'));
    }

    // Range Search
    public function rangeSearch(Request $request)
    {
        $field = $request->get('field', 'publication_date');
        $min = $request->get('min');
        $max = $request->get('max');
        
        $query = ResearchPaper::query();
        
        if ($field === 'publication_date') {
            if ($min) {
                $query->where('publication_date', '>=', $min);
            }
            if ($max) {
                $query->where('publication_date', '<=', $max);
            }
        }
        
        $results = $query->paginate(20);
        return view('search.results', compact('results', 'field', 'min', 'max'));
    }

    // Aggregation Search
    public function aggregationSearch(Request $request)
    {
        $results = ResearchPaper::search('')->paginate(20);
        return view('search.results', compact('results'));
    }

    // Highlight Search
    public function highlightSearch(Request $request)
    {
        $query = $request->get('q', '');
        $results = ResearchPaper::search($query)->paginate(20);
        return view('search.results', compact('results', 'query'));
    }

    // Suggest Search
    public function suggestSearch(Request $request)
    {
        $query = $request->get('q', '');
        $results = ResearchPaper::search($query)->paginate(20);
        return view('search.results', compact('results', 'query'));
    }

    // Autocomplete Search
    public function autocompleteSearch(Request $request)
    {
        $query = $request->get('q', '');
        $results = ResearchPaper::search($query)->limit(10)->get();
        return response()->json($results);
    }

    // Faceted Search
    public function facetedSearch(Request $request)
    {
        $query = $request->get('q', '');
        $facets = $request->get('facets', []);
        $results = ResearchPaper::search($query)->paginate(20);
        return view('search.results', compact('results', 'query', 'facets'));
    }

    // Sort Search
    public function sortSearch(Request $request)
    {
        $query = $request->get('q', '');
        $sort = $request->get('sort', 'relevance');
        
        $searchQuery = ResearchPaper::search($query);
        
        if ($sort === 'date_asc') {
            $searchQuery = ResearchPaper::orderBy('publication_date', 'asc');
        } elseif ($sort === 'date_desc') {
            $searchQuery = ResearchPaper::orderBy('publication_date', 'desc');
        } elseif ($sort === 'title_asc') {
            $searchQuery = ResearchPaper::orderBy('title', 'asc');
        } elseif ($sort === 'title_desc') {
            $searchQuery = ResearchPaper::orderBy('title', 'desc');
        }
        
        $results = $searchQuery->paginate(20);
        return view('search.results', compact('results', 'query', 'sort'));
    }

    // Filter Search
    public function filterSearch(Request $request)
    {
        $query = $request->get('q', '');
        $filters = $request->get('filters', []);
        
        $searchQuery = ResearchPaper::search($query);
        
        if (isset($filters['date_from'])) {
            $searchQuery = ResearchPaper::where('publication_date', '>=', $filters['date_from']);
        }
        if (isset($filters['date_to'])) {
            $searchQuery = ResearchPaper::where('publication_date', '<=', $filters['date_to']);
        }
        
        $results = $searchQuery->paginate(20);
        return view('search.results', compact('results', 'query', 'filters'));
    }

    // Advanced Search
    public function advancedSearch(Request $request)
    {
        $query = $request->get('q', '');
        $title = $request->get('title');
        $abstract = $request->get('abstract');
        $author = $request->get('author');
        $institution = $request->get('institution');
        $keyword = $request->get('keyword');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $sort = $request->get('sort', 'relevance');

        $searchQuery = ResearchPaper::query();

        if ($query) {
            $searchQuery = ResearchPaper::search($query);
        }

        if ($title) {
            $searchQuery = $searchQuery->where('title', 'like', "%{$title}%");
        }
        if ($abstract) {
            $searchQuery = $searchQuery->where('abstract', 'like', "%{$abstract}%");
        }
        if ($author) {
            $searchQuery = $searchQuery->whereHas('authors', function($q) use ($author) {
                $q->where('name', 'like', "%{$author}%");
            });
        }
        if ($institution) {
            $searchQuery = $searchQuery->whereHas('institution', function($q) use ($institution) {
                $q->where('name', 'like', "%{$institution}%");
            });
        }
        if ($keyword) {
            $searchQuery = $searchQuery->whereHas('keywords', function($q) use ($keyword) {
                $q->where('word', 'like', "%{$keyword}%");
            });
        }
        if ($startDate) {
            $searchQuery = $searchQuery->where('publication_date', '>=', $startDate);
        }
        if ($endDate) {
            $searchQuery = $searchQuery->where('publication_date', '<=', $endDate);
        }

        if ($sort === 'date_asc') {
            $searchQuery = $searchQuery->orderBy('publication_date', 'asc');
        } elseif ($sort === 'date_desc') {
            $searchQuery = $searchQuery->orderBy('publication_date', 'desc');
        } elseif ($sort === 'title_asc') {
            $searchQuery = $searchQuery->orderBy('title', 'asc');
        } elseif ($sort === 'title_desc') {
            $searchQuery = $searchQuery->orderBy('title', 'desc');
        }

        $results = $searchQuery->paginate(20);
        return view('search.results', compact('results', 'query', 'title', 'abstract', 'author', 'institution', 'keyword', 'startDate', 'endDate', 'sort'));
    }
}
