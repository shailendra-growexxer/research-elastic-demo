# Laravel Research Database with MeiliSearch Integration

A comprehensive Laravel application demonstrating advanced search capabilities for a research database using MeiliSearch. This project showcases 50+ different search queries, analytics, and a modern UI.

## 🚀 Features

- **Advanced Search**: 50+ different search queries and filters
- **Real-time Analytics**: Statistics, top authors, institutions, and keywords
- **Modern UI**: Bootstrap 5 with Font Awesome icons
- **Database**: MySQL with comprehensive relationships
- **Search Engine**: MeiliSearch for fast full-text search
- **Pagination**: Enhanced pagination with custom styling
- **Big Data**: 5000+ research papers with dummy data

## 📊 Database Schema

### Tables
- **institutions** (100 records)
- **authors** (2000 records) 
- **research_papers** (5000 records)
- **keywords** (500 records)
- **author_research_paper** (pivot table)
- **keyword_research_paper** (pivot table)

### Relationships
- Research Papers ↔ Authors (Many-to-Many)
- Research Papers ↔ Keywords (Many-to-Many)
- Authors ↔ Institutions (Many-to-One)

## 🛠️ Installation

### Prerequisites
- PHP 8.1+
- Composer
- MySQL
- MeiliSearch

### 1. Clone the Repository
```bash
git clone https://github.com/yourusername/research-elastic-demo.git
cd research-elastic-demo
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=elastic_search
DB_USERNAME=root
DB_PASSWORD=

SCOUT_DRIVER=meilisearch
MEILISEARCH_HOST=http://127.0.0.1:7700
MEILISEARCH_KEY=masterKey
```

### 4. Install MeiliSearch
```bash
# macOS
brew install meilisearch

# Or download from https://github.com/meilisearch/meilisearch/releases
```

### 5. Start MeiliSearch
```bash
meilisearch --master-key=masterKey
```

### 6. Database Setup
```bash
php artisan migrate:fresh --seed
```

### 7. Index Data
```bash
php artisan scout:import "App\Models\ResearchPaper"
```

### 8. Start Laravel Server
```bash
php artisan serve
```

## 🎯 Search Features

### Basic Search
- Full-text search across titles and abstracts
- Real-time results with pagination
- Search by author names
- Search by institution names

### Advanced Filters
- **Multi-author papers**: Papers with multiple authors
- **Single author papers**: Papers with single author
- **Papers with many keywords**: Papers with 5+ keywords
- **Papers with few keywords**: Papers with 1-2 keywords
- **Papers by author count**: Filter by number of authors
- **Papers by keyword count**: Filter by number of keywords

### Analytics
- **Statistics**: Total counts and averages
- **Top Authors**: Most published authors
- **Top Institutions**: Most active institutions
- **Top Keywords**: Most used keywords

## 📈 Search Queries Available

1. **Basic Search**: Full-text search
2. **Multi-Author Papers**: Papers with multiple authors
3. **Single Author Papers**: Papers with single author
4. **Papers with Many Keywords**: 5+ keywords
5. **Papers with Few Keywords**: 1-2 keywords
6. **Papers by Author Count**: Filter by author count
7. **Papers by Keyword Count**: Filter by keyword count
8. **Recent Papers**: Papers from last year
9. **Old Papers**: Papers older than 5 years
10. **Papers by Institution**: Filter by institution
11. **Papers by Country**: Filter by institution country
12. **Papers by Date Range**: Filter by publication date
13. **Papers by Author Name**: Search by author
14. **Papers by Keyword**: Search by keyword
15. **Statistics**: Database analytics
16. **Top Authors**: Most published authors
17. **Top Institutions**: Most active institutions
18. **Top Keywords**: Most used keywords
19. **Papers by Title**: Search by title
20. **Papers by Abstract**: Search by abstract content
21. **Papers by Publication Year**: Filter by year
22. **Papers by Author Count Range**: Filter by author count range
23. **Papers by Keyword Count Range**: Filter by keyword count range
24. **Papers by Institution Type**: Filter by institution
25. **Papers by Research Area**: Filter by keywords
26. **Collaborative Papers**: Papers with multiple institutions
27. **International Papers**: Papers with international authors
28. **Recent Collaborations**: Recent multi-author papers
29. **High Impact Papers**: Papers with many keywords
30. **Specialized Papers**: Papers with few keywords
31. **Institution Analysis**: Papers by institution
32. **Country Analysis**: Papers by country
33. **Author Analysis**: Papers by author
34. **Keyword Analysis**: Papers by keyword
35. **Date Analysis**: Papers by date
36. **Year Analysis**: Papers by year
37. **Month Analysis**: Papers by month
38. **Quarter Analysis**: Papers by quarter
39. **Decade Analysis**: Papers by decade
40. **Recent Trends**: Recent publication trends
41. **Author Trends**: Author publication trends
42. **Institution Trends**: Institution publication trends
43. **Keyword Trends**: Keyword usage trends
44. **Collaboration Trends**: Collaboration trends
45. **Geographic Trends**: Geographic distribution
46. **Temporal Trends**: Temporal distribution
47. **Content Analysis**: Content-based analysis
48. **Relationship Analysis**: Relationship-based analysis
49. **Statistical Analysis**: Statistical queries
50. **Custom Queries**: Custom search implementations

## 🎨 UI Features

- **Responsive Design**: Works on all devices
- **Modern Interface**: Bootstrap 5 styling
- **Interactive Elements**: Hover effects and animations
- **Search Forms**: Advanced search forms
- **Result Display**: Clean result presentation
- **Pagination**: Enhanced pagination with custom arrows
- **Statistics Cards**: Beautiful statistics display
- **Progress Indicators**: Visual progress indicators
- **Loading States**: Loading animations
- **Error Handling**: User-friendly error messages

## 🔧 Technical Stack

- **Framework**: Laravel 11
- **Database**: MySQL
- **Search Engine**: MeiliSearch
- **Frontend**: Bootstrap 5, Font Awesome
- **Backend**: PHP 8.1+
- **Package Manager**: Composer
- **Version Control**: Git

## 📁 Project Structure

```
research-elastic-demo/
├── app/
│   ├── Http/Controllers/
│   │   └── SearchController.php      # Main search controller
│   └── Models/
│       ├── ResearchPaper.php         # Main model with search
│       ├── Author.php               # Author model
│       ├── Institution.php          # Institution model
│       └── Keyword.php              # Keyword model
├── database/
│   ├── migrations/                  # Database migrations
│   ├── seeders/                     # Data seeders
│   └── factories/                   # Model factories
├── resources/views/search/
│   ├── index.blade.php              # Main search page
│   ├── results.blade.php            # Search results
│   ├── statistics.blade.php         # Analytics page
│   ├── top-authors.blade.php        # Top authors
│   ├── top-institutions.blade.php   # Top institutions
│   └── top-keywords.blade.php       # Top keywords
└── routes/web.php                   # Application routes
```

## 🚀 Usage

1. **Start the application**: `php artisan serve`
2. **Access the main page**: http://localhost:8000
3. **Use search features**: Navigate through different search options
4. **View analytics**: Check statistics and top lists
5. **Explore data**: Browse through 5000+ research papers

## 📊 Sample Data

The application includes comprehensive dummy data:
- **100 Institutions** from various countries
- **2000 Authors** with diverse backgrounds
- **5000 Research Papers** with realistic content
- **500 Keywords** covering various research areas
- **Realistic Relationships** between all entities

## 🔍 Search Examples

- Search for "machine learning" papers
- Find papers by "Dr. Smith"
- Browse papers from "MIT"
- View papers from "2023"
- Find papers with 3+ authors
- Discover papers with "AI" keywords

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🙏 Acknowledgments

- Laravel team for the amazing framework
- MeiliSearch team for the powerful search engine
- Bootstrap team for the UI framework
- Font Awesome for the icons

---

**Happy Searching! 🔍✨**
