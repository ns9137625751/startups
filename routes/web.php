<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Dashboard\GovernmentController;
use App\Http\Controllers\Dashboard\IncubatorController;
use App\Http\Controllers\Dashboard\IndustryExpertController;
use App\Http\Controllers\Dashboard\InvestorController;
use App\Http\Controllers\Dashboard\MentorController;
use App\Http\Controllers\Dashboard\StartupController;
use App\Http\Controllers\Dashboard\SuperAdminController;
use App\Http\Controllers\Dashboard\StartupProfileController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// ── Public pages ─────────────────────────────────────────────────────────────
Route::get('/', [PageController::class, 'home']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/ecosystem', [PageController::class, 'ecosystem']);
Route::get('/how-it-works', [PageController::class, 'howItWorks']);
Route::get('/join', [PageController::class, 'join']);
Route::get('/resources', [PageController::class, 'resources']);
Route::get('/faq', [PageController::class, 'faq']);
Route::get('/contact', [PageController::class, 'contact']);
Route::post('/contact', [ContactController::class, 'store']);

// ── Auth routes (guests only) ─────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/verify-otp', [AuthController::class, 'showVerifyOtp'])->name('otp.verify.form');
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('otp.verify');
    Route::post('/resend-otp', [AuthController::class, 'resendOtp'])->name('otp.resend');
});

// ── Logout ────────────────────────────────────────────────────────────────────
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ── Dashboard routes ──────────────────────────────────────────────────────────
Route::middleware(['auth', 'verified.otp'])->prefix('dashboard')->name('dashboard.')->group(function () {

    // ── Super Admin ───────────────────────────────────────────────────────────
    Route::middleware('role:super_admin')->prefix('super-admin')->name('super-admin.')->group(function () {
        Route::get('/',              [SuperAdminController::class, 'index'])->name('index');
        Route::get('/users',         [SuperAdminController::class, 'usersSearch'])->name('users');
        Route::get('/users-page',    [SuperAdminController::class, 'usersPage'])->name('users-page');
        Route::get('/roles',         [SuperAdminController::class, 'rolesPage'])->name('roles');
        Route::post('/roles/toggle', [SuperAdminController::class, 'toggleRole'])->name('roles.toggle');
        // Startup profiles management
        Route::get('/startups',                    [SuperAdminController::class, 'startupProfiles'])->name('startups');
        Route::get('/startups-search',             [SuperAdminController::class, 'startupSearch'])->name('startups.search');
        Route::get('/startups/{startup}',          [SuperAdminController::class, 'showStartup'])->name('startups.show');
        Route::get('/startups/{startup}/edit',     [SuperAdminController::class, 'editStartup'])->name('startups.edit');
        Route::put('/startups/{startup}',          [SuperAdminController::class, 'updateStartup'])->name('startups.update');
        Route::delete('/startups/{startup}',       [SuperAdminController::class, 'deleteStartup'])->name('startups.delete');
        Route::post('/startups/{startup}/approve', [SuperAdminController::class, 'approveStartup'])->name('startups.approve');
        // Investor profiles management
        Route::get('/investors',                     [SuperAdminController::class, 'investorProfiles'])->name('investors');
        Route::get('/investors-search',              [SuperAdminController::class, 'investorSearch'])->name('investors.search');
        Route::get('/investors/{investor}',          [SuperAdminController::class, 'showInvestor'])->name('investors.show');
        Route::get('/investors/{investor}/edit',     [SuperAdminController::class, 'editInvestor'])->name('investors.edit');
        Route::put('/investors/{investor}',          [SuperAdminController::class, 'updateInvestor'])->name('investors.update');
        Route::delete('/investors/{investor}',       [SuperAdminController::class, 'deleteInvestor'])->name('investors.delete');
        Route::post('/investors/{investor}/approve', [SuperAdminController::class, 'approveInvestor'])->name('investors.approve');
    });

    // ── Startup ───────────────────────────────────────────────────────────────
    Route::middleware('role:startup')->prefix('startup')->name('startup.')->group(function () {
        Route::get('/',           [StartupController::class, 'index'])->name('index');
        Route::get('/investors',  [StartupController::class, 'browseInvestors'])->name('investors');
        Route::get('/incubators', [StartupController::class, 'browseIncubators'])->name('incubators');
        Route::get('/profile',    [StartupProfileController::class, 'show'])->name('profile');
        Route::post('/profile',   [StartupProfileController::class, 'store'])->name('profile.store');
    });

    // ── Investor ──────────────────────────────────────────────────────────────
    Route::middleware('role:investor')->prefix('investor')->name('investor.')->group(function () {
        Route::get('/',        [InvestorController::class, 'index'])->name('index');
        Route::get('/startups',[InvestorController::class, 'browseStartups'])->name('startups');
        Route::get('/profile', [InvestorController::class, 'showProfile'])->name('profile');
        Route::post('/profile',[InvestorController::class, 'storeProfile'])->name('profile.store');
    });

    // ── Mentor ────────────────────────────────────────────────────────────────
    Route::middleware('role:mentor')->prefix('mentor')->name('mentor.')->group(function () {
        Route::get('/', [MentorController::class, 'index'])->name('index');
    });

    // ── Incubator ─────────────────────────────────────────────────────────────
    Route::middleware('role:incubator')->prefix('incubator')->name('incubator.')->group(function () {
        Route::get('/', [IncubatorController::class, 'index'])->name('index');
    });

    // ── Government Body ───────────────────────────────────────────────────────
    Route::middleware('role:government_body')->prefix('government')->name('government.')->group(function () {
        Route::get('/', [GovernmentController::class, 'index'])->name('index');
    });

    // ── Industry Expert ───────────────────────────────────────────────────────
    Route::middleware('role:industry_expert')->prefix('industry-expert')->name('industry-expert.')->group(function () {
        Route::get('/', [IndustryExpertController::class, 'index'])->name('index');
    });

});

// ── Sitemap & Robots ──────────────────────────────────────────────────────────
Route::get('/sitemap.xml', function () {
    $urls = [
        ['loc' => url('/'),             'priority' => '1.0', 'changefreq' => 'weekly'],
        ['loc' => url('/about'),        'priority' => '0.8', 'changefreq' => 'monthly'],
        ['loc' => url('/ecosystem'),    'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => url('/how-it-works'), 'priority' => '0.8', 'changefreq' => 'monthly'],
        ['loc' => url('/join'),         'priority' => '0.9', 'changefreq' => 'monthly'],
        ['loc' => url('/resources'),    'priority' => '0.8', 'changefreq' => 'weekly'],
        ['loc' => url('/faq'),          'priority' => '0.7', 'changefreq' => 'monthly'],
        ['loc' => url('/contact'),      'priority' => '0.6', 'changefreq' => 'yearly'],
    ];
    return response()->view('sitemap', ['urls' => $urls])->header('Content-Type', 'application/xml');
});

Route::get('/robots.txt', function () {
    return response("User-agent: *\nAllow: /\nSitemap: " . url('/sitemap.xml'))->header('Content-Type', 'text/plain');
});
