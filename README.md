# iFact — AI-Based Fake News Detection Platform

An AI-powered web platform that detects fake news, analyzes sentiment,
and provides credibility scores using Laravel + Python Flask + Transformer models.

## Features

- User authentication (register / login)
- Submit news via text or URL (auto-scraping)
- AI fake news detection (Real / Fake / Uncertain)
- Sentiment analysis (Positive / Negative / Neutral)
- Credibility score with visual bar (0–100%)
- Dashboard with Chart.js analytics
- Submission history tracking
- Admin panel (users + submissions management)

## Tech Stack

| Layer      | Technology                          |
|------------|-------------------------------------|
| Backend    | Laravel 12 (PHP 8.2)                |
| Frontend   | Blade + Tailwind CSS                |
| AI Service | Python Flask + HuggingFace Transformers |
| Database   | MySQL                               |
| Charts     | Chart.js                            |

## AI Models Used

- **Fake News Detection** — `hamzab/roberta-fake-news-classification`
- **Sentiment Analysis** — `cardiffnlp/twitter-roberta-base-sentiment-latest`

## Project Structure
ifact/               → Laravel application
ifact-ai/            → Python Flask AI microservice

## Installation

### Laravel App

```bash
cd ifact
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install && npm run build
php artisan serve
```

### Python AI Service

```bash
cd ifact-ai
python -m venv venv
venv\Scripts\activate
pip install -r requirements.txt
python app.py
```

## Environment Variables

Copy `.env.example` to `.env` and update:

```env
DB_DATABASE=ifact_db
DB_USERNAME=root
DB_PASSWORD=your_password
AI_SERVICE_URL=http://127.0.0.1:5000
```

## Usage

1. Register an account at `/register`
2. Submit news text or a URL at `/news/submit`
3. View AI analysis results instantly
4. Track history at `/news/history`
5. View analytics at `/dashboard`

## Admin Panel

```bash
php artisan tinker
App\Models\User::where('email', 'your@email.com')->update(['is_admin' => true]);
```

Then visit `/admin/dashboard`.

## License

MIT License — free to use and modify.
