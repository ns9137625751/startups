<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;

Route::get('/',             [PageController::class, 'home']);
Route::get('/about',        [PageController::class, 'about']);
Route::get('/ecosystem',    [PageController::class, 'ecosystem']);
Route::get('/how-it-works', [PageController::class, 'howItWorks']);
Route::get('/join',         [PageController::class, 'join']);
Route::get('/resources',    [PageController::class, 'resources']);
Route::get('/faq',          [PageController::class, 'faq']);
Route::get('/contact',      [PageController::class, 'contact']);
Route::post('/contact',     [ContactController::class, 'store']);

Route::get('/sitemap.xml', function () {
    $urls = [
        ['loc' => url('/'),             'priority' => '1.0',  'changefreq' => 'weekly'],
        ['loc' => url('/about'),        'priority' => '0.8',  'changefreq' => 'monthly'],
        ['loc' => url('/ecosystem'),    'priority' => '0.9',  'changefreq' => 'weekly'],
        ['loc' => url('/how-it-works'), 'priority' => '0.8',  'changefreq' => 'monthly'],
        ['loc' => url('/join'),         'priority' => '0.9',  'changefreq' => 'monthly'],
        ['loc' => url('/resources'),    'priority' => '0.8',  'changefreq' => 'weekly'],
        ['loc' => url('/faq'),          'priority' => '0.7',  'changefreq' => 'monthly'],
        ['loc' => url('/contact'),      'priority' => '0.6',  'changefreq' => 'yearly'],
    ];
    return response()->view('sitemap', ['urls' => $urls])
        ->header('Content-Type', 'application/xml');
});

Route::get('/robots.txt', function () {
    $content = "User-agent: *\nAllow: /\nSitemap: " . url('/sitemap.xml');
    return response($content)->header('Content-Type', 'text/plain');
});
