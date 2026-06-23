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
use App\Http\Controllers\User\UserRendezVousController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\User\UserMessageController;
use App\Http\Controllers\Admin\AdminPaiementController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\RendezVousController as AdminRendezVousController;
use App\Http\Controllers\Admin\AdminFactureController;
use App\Http\Controllers\Admin\AdminServiceConfigController;
use App\Http\Controllers\User\PanierController;
use App\Http\Controllers\StripeWebhookController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\SupportController;

// --------------------------------------------------
// ADMIN
// --------------------------------------------------
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


Route::prefix('admin')->middleware(['auth', 'isadmin'])->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    // Devis
    Route::get('/devis', [AdminDevisController::class, 'index'])->name('admin.devis.index');
    Route::get('/devis/create', [AdminDevisController::class, 'create'])->name('admin.devis.create');
    Route::post('/devis/store', [AdminDevisController::class, 'store'])->name('admin.devis.store');
    Route::get('/devis/{devis}', [AdminDevisController::class, 'show'])->name('admin.devis.show');

    // Messages
    Route::get('/messages', [AdminMessageController::class, 'index'])->name('admin.messages.index');
    Route::get('/messages/{id}/repondre', [AdminMessageController::class, 'repondre'])->name('admin.messages.repondre');
    Route::post('/messages/{id}/envoyer', [AdminMessageController::class, 'envoyerReponse'])->name('admin.messages.envoyerReponse');

    // Paiements admin
    Route::get('/paiements', [AdminPaiementController::class, 'index'])->name('admin.paiements.index');

    // Rendez-vous
    Route::get('/rendezvous', [AdminRendezVousController::class, 'index'])->name('admin.rendezvous.index');
    Route::post('/rendezvous/store', [AdminRendezVousController::class, 'store'])->name('admin.rendezvous.store');
    Route::delete('/rendezvous/{id}', [AdminRendezVousController::class, 'destroy'])->name('admin.rendezvous.destroy');

    // Paramètres admin
    Route::get('/settings', [AdminUserController::class, 'settings'])->name('admin.users.settings');
    Route::post('/settings/update', [AdminUserController::class, 'updateSettings'])->name('admin.user.settings.update');

    // Liste utilisateurs
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');

    // Factures
    Route::get('/facture/{devis}', [AdminFactureController::class, 'show'])->name('admin.facture.show');
    Route::get('/facture/download/{devis}', [AdminFactureController::class, 'download'])->name('admin.facture.download');

    // Configuration service
    Route::get('/service-config/{devis}', [AdminServiceConfigController::class, 'form'])->name('admin.service.config.form');
    Route::post('/service-config/{devis}', [AdminServiceConfigController::class, 'store'])->name('admin.service.config.store');
});
Route::post('/stripe/webhook', [\App\Http\Controllers\StripeWebhookController::class, 'handle']);


// --------------------------------------------------
// DEVIS + PANIER
// --------------------------------------------------
Route::post('/devis/accepter', [DevisController::class, 'accepter'])
    ->middleware('auth')
    ->name('devis.accepter');

Route::get('/panier/from-devis/{devis}', [PanierController::class, 'fromDevis'])
    ->middleware('auth')
    ->name('panier.fromDevis');

// --------------------------------------------------
// RESET PASSWORD
// --------------------------------------------------
Route::get('/password/forgot', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

Route::post('/password/email', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

Route::get('/password/reset/{token}', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');

Route::post('/password/reset', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])
    ->name('password.update');

Route::get('/debug-mail', function () {
    return env('MAIL_HOST');
});

// --------------------------------------------------
// UTILISATEURS AUTHENTIFIÉS
// --------------------------------------------------
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {

    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // Rendez-vous
    Route::get('/rendezvous', [UserRendezVousController::class, 'index'])->name('rendezvous.index');
    Route::post('/rendezvous/select', [UserRendezVousController::class, 'select'])->name('rendezvous.select');
    Route::delete('/rendezvous/{id}', [UserRendezVousController::class, 'destroy'])->name('rendezvous.delete');

    // Messages utilisateur
    Route::get('/messages', [UserMessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [UserMessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{id}/reply', [UserMessageController::class, 'reply'])->name('messages.reply');

    // Devis utilisateur
    Route::get('/devis/{devis}', [UserDevisController::class, 'show'])->name('devis.show');
    Route::get('/devis', function () {
        return view('user.devis.index');
    })->name('devis.index');
});

// --------------------------------------------------
// PAIEMENT STRIPE (SIMPLE)
// --------------------------------------------------
Route::middleware(['auth'])->group(function () {
    Route::get('/paiement/total/{devis}', [PaiementController::class, 'checkoutTotal'])->name('paiement.total');
    Route::get('/paiement/acompte/{devis}', [PaiementController::class, 'checkoutAcompte'])->name('paiement.acompte');
});

Route::get('/paiement/reste/{devis}', [PaiementController::class, 'checkoutReste'])->name('paiement.reste');
Route::get('/paiement/success', [PaiementController::class, 'success'])->name('paiement.success');
Route::get('/paiement/cancel', [PaiementController::class, 'cancel'])->name('paiement.cancel');

// --------------------------------------------------
// PAGES PUBLIQUES
// --------------------------------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/competences', [HomeController::class, 'competences'])->name('competences');

// Contact
Route::middleware(['auth'])->group(function () {
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
});

// Support
Route::get('/support', [SupportController::class, 'index'])->name('support.form');
Route::post('/support', [SupportController::class, 'send'])->name('support.send');
