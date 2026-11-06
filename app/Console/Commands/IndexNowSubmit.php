<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class IndexNowSubmit extends Command
{
    protected $signature = 'indexnow:submit';
    protected $description = 'Notifie les moteurs de recherche (IndexNow) des pages du site';

    public function handle(): int
    {
        $key = env('INDEXNOW_KEY');

        if (!$key) {
            $this->error('INDEXNOW_KEY manquante dans le fichier .env');
            return self::FAILURE;
        }

        $host = parse_url(config('app.url'), PHP_URL_HOST);

        $urls = [
            route('home'),
            route('services'),
            route('realisations'),
            route('contact'),
        ];

        $response = Http::post('https://api.indexnow.org/indexnow', [
            'host'        => $host,
            'key'         => $key,
            'keyLocation' => rtrim(config('app.url'), '/') . '/' . $key . '.txt',
            'urlList'     => $urls,
        ]);

        // 200 = reçu, 202 = reçu (clé en cours de validation)
        if (in_array($response->status(), [200, 202])) {
            $this->info('OK (' . $response->status() . ') : ' . count($urls) . ' URL envoyées.');
            return self::SUCCESS;
        }

        $this->error('Échec (' . $response->status() . ') : ' . $response->body());
        return self::FAILURE;
    }
}