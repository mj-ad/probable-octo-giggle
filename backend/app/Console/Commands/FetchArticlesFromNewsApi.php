<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Article;
use App\Models\Source;
use Carbon\Carbon;

class FetchArticlesFromNewsApi extends Command
{
    protected $signature = 'articles:fetch-newsapi';
    protected $description = 'Fetch articles from NewsAPI and store in the database';

    public function handle()
    {
        $apiKey = env('NEWS_API_KEY'); // Put this in .env
        $url = 'https://newsapi.org/v2/top-headlines?language=en&pageSize=50';

        $response = Http::withHeaders([
            'Authorization' => "Bearer $apiKey"
        ])->get($url);

        $articles = $response->json()['articles'] ?? [];

        foreach ($articles as $item) {
            // Save source if it doesn’t exist
            $source = Source::firstOrCreate([
                'name' => $item['source']['name']
            ]);

            // Prevent duplicates
            if (Article::where('title', $item['title'])->exists()) {
                continue;
            }

            Article::create([
                'title' => $item['title'],
                'description' => $item['description'],
                'url' => $item['url'],
                'image_url' => $item['urlToImage'],
                'source_id' => $source->id,
                'author' => $item['author'] ?? 'Unknown',
                'published_at' => Carbon::parse($item['publishedAt'])
            ]);
        }

        $this->info('NewsAPI articles fetched and stored.');
    }
}
