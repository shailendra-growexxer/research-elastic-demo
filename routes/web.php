<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;

Route::get('/', function () {
    return redirect()->route('search.index');
});

// Search Routes
Route::prefix('search')->group(function () {
    Route::get('/', [SearchController::class, 'index'])->name('search.index');
    
    // Basic Search
    Route::get('/basic', [SearchController::class, 'basicSearch'])->name('search.basic');
    
    // Field-specific Searches
    Route::get('/title', [SearchController::class, 'searchByTitle'])->name('search.title');
    Route::get('/abstract', [SearchController::class, 'searchByAbstract'])->name('search.abstract');
    Route::get('/author', [SearchController::class, 'searchByAuthor'])->name('search.author');
    Route::get('/institution', [SearchController::class, 'searchByInstitution'])->name('search.institution');
    Route::get('/country', [SearchController::class, 'searchByCountry'])->name('search.country');
    Route::get('/keyword', [SearchController::class, 'searchByKeyword'])->name('search.keyword');
    
    // Date-based Searches
    Route::get('/date-range', [SearchController::class, 'searchByDateRange'])->name('search.date-range');
    Route::get('/recent', [SearchController::class, 'recentPapers'])->name('search.recent');
    Route::get('/old', [SearchController::class, 'oldPapers'])->name('search.old');
    Route::get('/by-year', [SearchController::class, 'papersByYear'])->name('search.by-year');
    Route::get('/by-month', [SearchController::class, 'papersByMonth'])->name('search.by-month');
    
    // Relationship-based Searches
    Route::get('/multi-author', [SearchController::class, 'multiAuthorPapers'])->name('search.multi-author');
    Route::get('/single-author', [SearchController::class, 'singleAuthorPapers'])->name('search.single-author');
    Route::get('/many-keywords', [SearchController::class, 'papersWithManyKeywords'])->name('search.many-keywords');
    Route::get('/few-keywords', [SearchController::class, 'papersWithFewKeywords'])->name('search.few-keywords');
    
    // Institution and Country Searches
    Route::get('/institution-type', [SearchController::class, 'papersByInstitutionType'])->name('search.institution-type');
    Route::get('/by-country', [SearchController::class, 'papersByCountry'])->name('search.by-country');
    
    // Count-based Searches
    Route::get('/author-count', [SearchController::class, 'papersByAuthorCount'])->name('search.author-count');
    Route::get('/keyword-count', [SearchController::class, 'papersByKeywordCount'])->name('search.keyword-count');
    
    // Complex and Advanced Searches
    Route::get('/complex', [SearchController::class, 'complexSearch'])->name('search.complex');
    Route::get('/advanced', [SearchController::class, 'advancedSearch'])->name('search.advanced');
    
    // Statistics and Analytics
    Route::get('/statistics', [SearchController::class, 'statistics'])->name('search.statistics');
    Route::get('/top-authors', [SearchController::class, 'topAuthors'])->name('search.top-authors');
    Route::get('/top-institutions', [SearchController::class, 'topInstitutions'])->name('search.top-institutions');
    Route::get('/top-keywords', [SearchController::class, 'topKeywords'])->name('search.top-keywords');
    
    // Entity-based Searches
    Route::get('/by-institution', [SearchController::class, 'papersByInstitution'])->name('search.by-institution');
    Route::get('/by-author', [SearchController::class, 'papersByAuthor'])->name('search.by-author');
    Route::get('/by-keyword', [SearchController::class, 'papersByKeyword'])->name('search.by-keyword');
    
    // Advanced Search Types
    Route::get('/full-text', [SearchController::class, 'fullTextSearch'])->name('search.full-text');
    Route::get('/fuzzy', [SearchController::class, 'fuzzySearch'])->name('search.fuzzy');
    Route::get('/wildcard', [SearchController::class, 'wildcardSearch'])->name('search.wildcard');
    Route::get('/phrase', [SearchController::class, 'phraseSearch'])->name('search.phrase');
    Route::get('/boolean', [SearchController::class, 'booleanSearch'])->name('search.boolean');
    Route::get('/proximity', [SearchController::class, 'proximitySearch'])->name('search.proximity');
    
    // Field and Range Searches
    Route::get('/field', [SearchController::class, 'fieldSearch'])->name('search.field');
    Route::get('/range', [SearchController::class, 'rangeSearch'])->name('search.range');
    
    // Specialized Searches
    Route::get('/aggregation', [SearchController::class, 'aggregationSearch'])->name('search.aggregation');
    Route::get('/highlight', [SearchController::class, 'highlightSearch'])->name('search.highlight');
    Route::get('/suggest', [SearchController::class, 'suggestSearch'])->name('search.suggest');
    Route::get('/faceted', [SearchController::class, 'facetedSearch'])->name('search.faceted');
    Route::get('/sort', [SearchController::class, 'sortSearch'])->name('search.sort');
    Route::get('/filter', [SearchController::class, 'filterSearch'])->name('search.filter');
    
    // API Routes
    Route::get('/autocomplete', [SearchController::class, 'autocompleteSearch'])->name('search.autocomplete');
});
