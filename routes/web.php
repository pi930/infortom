<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\Admin\AdminMessageController;
use App\Http\Controllers\Admin\AdminDevisController;
use App\Http\Controllers\User\UserDevisController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\Admin\RendezVousController;
use App\Models\Devis;
use App\Models\User;
use App\Http\Controllers\User\PanierController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Mail;


// -----------------------------
// AUTH
// -----------------------------
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['auth', 'isadmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // Devis
        Route::get('/devis/create', [AdminDevisController::class, 'create'])->name('devis.create');
        Route::post('/devis/store', [AdminDevisController::class, 'store'])->name('devis.store');
        Route::get('/devis/{devis}', [AdminDevisController::class, 'show'])->name('devis.show');

        // Rendez-vous
        Route::get('/rendezvous', [RendezVousController::class, 'index'])->name('rendezvous.index');
        Route::post('/rendezvous', [RendezVousController::class, 'store'])->name('rendezvous.store');
        Route::delete('/rendezvous/{id}', [RendezVousController::class, 'destroy'])->name('rendezvous.destroy');

        // Messages
        Route::get('/messages/{id}/repondre', [AdminMessageController::class, 'repondre'])->name('messages.repondre');
        Route::post('/messages/{id}/repondre', [AdminMessageController::class, 'envoyerReponse'])->name('messages.envoyerReponse');

        // Utilisateurs
        Route::get('/utilisateurs', [AdminDevisController::class, 'index'])
    ->name('users.index');

        // Paramètres
        Route::get('/parametres', [AdminDevisController::class, 'settings'])->name('user.settings');
        Route::post('/parametres', [AdminDevisController::class, 'updateSettings'])->name('user.settings.update');
    });

// -----------------------------
// USER (protégé par auth)
// -----------------------------
Route::middleware(['auth'])->group(function () {

    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])
        ->name('user.dashboard');
});
/*
|--------------------------------------------------------------------------
| Routes Utilisateur
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard utilisateur
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])
        ->name('user.dashboard');

    // Sélection d’un rendez-vous
    Route::post('/user/rendezvous/select', [UserDashboardController::class, 'select'])
        ->name('user.rendezvous.select');

    // Suppression d’un rendez-vous
    Route::delete('/user/rendezvous/{id}', [UserDashboardController::class, 'destroy'])
        ->name('user.rendezvous.destroy');

        Route::get('/panier', [PanierController::class, 'show'])->name('panier.show');
         Route::get('/user/devis/{devis}', [\App\Http\Controllers\User\UserDevisController::class, 'show'])
        ->name('user.devis.show');
        Route::post('/messages/{id}/reply', [\App\Http\Controllers\User\UserMessageController::class, 'reply'])
    ->name('user.messages.reply');

});   
      
Route::post('/devis/accepter', [DevisController::class, 'accepter'])
    ->middleware('auth')
    ->name('devis.accepter');
    Route::get('/panier/from-devis/{devis}', [PanierController::class, 'fromDevis']) ->middleware('auth') ->name('panier.fromDevis');
    // Page pour entrer l'email
Route::get('/password/forgot', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

// Envoi de l'email
Route::post('/password/email', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

// Page pour entrer le nouveau mot de passe
Route::get('/password/reset/{token}', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');

// Validation du nouveau mot de passe
Route::post('/password/reset', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])
    ->name('password.update');
    Route::get('/debug-mail', function () {
    return env('MAIL_HOST');
});

Route::get('/test-mail', function () {
    Mail::raw('Test HTTP → Brevo', function ($m) {
        $m->to('t.pierrard.131.198@outlook.fr')
          ->subject('Test HTTP Brevo');
    });

    return 'OK';
});


// -----------------------------
// PAGES PUBLIQUES
// -----------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/competences', [HomeController::class, 'competences'])->name('competences');

// Contact
Route::middleware(['auth'])->group(function () {
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
});

Route::post('/paiement/checkout', [PaiementController::class, 'checkout'])
    ->middleware('auth')
    ->name('paiement.checkout');

Route::get('/paiement/success', [PaiementController::class, 'success'])
    ->middleware('auth')
    ->name('paiement.success');

