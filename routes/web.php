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
use App\Models\Devis;
use App\Models\User;
use App\Http\Controllers\User\PanierController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\SupportController;



// -----------------------------
// AUTH
// -----------------------------
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// =========================
// ROUTES ADMIN DEVIS
// =========================
Route::prefix('admin')->middleware(['auth', 'isadmin'])->group(function () {

    // Tableau de bord
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    // Devis
    Route::get('/devis', [App\Http\Controllers\Admin\AdminDevisController::class, 'index'])
        ->name('admin.devis.index');

    Route::get('/devis/create', [App\Http\Controllers\Admin\AdminDevisController::class, 'create'])
        ->name('admin.devis.create');

    Route::post('/devis/store', [App\Http\Controllers\Admin\AdminDevisController::class, 'store'])
        ->name('admin.devis.store');

    Route::get('/devis/{devis}', [App\Http\Controllers\Admin\AdminDevisController::class, 'show'])
        ->name('admin.devis.show');

    // Messages
    Route::get('/messages', [App\Http\Controllers\Admin\AdminMessageController::class, 'index'])
        ->name('admin.messages.index');

    Route::get('/messages/{id}/repondre', [App\Http\Controllers\Admin\AdminMessageController::class, 'repondre'])
        ->name('admin.messages.repondre');

    Route::post('/messages/{id}/envoyer', [App\Http\Controllers\Admin\AdminMessageController::class, 'envoyerReponse'])
        ->name('admin.messages.envoyerReponse');

    // Paiements
    Route::get('/paiements', [App\Http\Controllers\Admin\AdminPaiementController::class, 'index'])
        ->name('admin.paiements.index');

    // Rendez-vous
    Route::get('/rendezvous', [App\Http\Controllers\Admin\RendezVousController::class, 'index'])
        ->name('admin.rendezvous.index');

    Route::post('/rendezvous/store', [App\Http\Controllers\Admin\RendezVousController::class, 'store'])
        ->name('admin.rendezvous.store');

    Route::delete('/rendezvous/{id}', [App\Http\Controllers\Admin\RendezVousController::class, 'destroy'])
        ->name('admin.rendezvous.destroy');

    // PARAMÈTRES ADMIN
Route::get('/settings', [App\Http\Controllers\Admin\AdminUserController::class, 'settings'])
    ->name('admin.users.settings');

Route::post('/settings/update', [App\Http\Controllers\Admin\AdminUserController::class, 'updateSettings'])
    ->name('admin.user.settings.update');

// LISTE DES UTILISATEURS
Route::get('/users', [App\Http\Controllers\Admin\AdminUserController::class, 'index'])
    ->name('admin.users.index');

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
Route::get('/whoami', function () {
    return get_class(auth()->getProvider()->createModel());
});

Route::get('/test-mail', function () {
    try {
        Mail::raw('Test SMTP OK', function ($m) {
            $m->to('thomaspierrard1980@gmail.com')->subject('Test SMTP Brevo');
        });
        return 'Email envoyé';
    } catch (\Exception $e) {
        return $e->getMessage();
    }
});
Route::get('/debug-mail', function () {
    return [
        'MAIL_MAILER' => config('mail.default'),
        'MAIL_HOST' => config('mail.mailers.smtp.host'),
        'MAIL_PORT' => config('mail.mailers.smtp.port'),
        'MAIL_USERNAME' => config('mail.mailers.smtp.username'),
        'MAIL_PASSWORD_END' => substr(config('mail.mailers.smtp.password'), -6),
        'FROM' => config('mail.from'),
    ];
});
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {

    // Tableau de bord utilisateur
    Route::get('/dashboard', [UserDashboardController::class, 'index'])
        ->name('dashboard');

    // Rendez-vous
    Route::get('/rendezvous', [UserRendezVousController::class, 'index'])
        ->name('rendezvous.index');

    Route::post('/rendezvous/select', [UserRendezVousController::class, 'select'])
        ->name('rendezvous.select');

    Route::delete('/rendezvous/{id}', [UserRendezVousController::class, 'destroy'])
        ->name('rendezvous.delete');

    // Messages utilisateur
    Route::get('/messages', [UserMessageController::class, 'index'])
        ->name('messages.index');

    Route::get('/messages/{message}', [UserMessageController::class, 'show'])
        ->name('messages.show');

    Route::post('/messages/{id}/reply', [UserMessageController::class, 'reply'])
        ->name('messages.reply');

    // Devis utilisateur
    Route::get('/devis/{devis}', [UserDevisController::class, 'show'])
        ->name('devis.show');
    Route::get('/devis', function () {
    return view('user.devis.index');
})->name('devis.index');
    
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
    Route::get('/paiement/total/{devis}', [PaiementController::class, 'checkoutTotal'])->name('paiement.total');
Route::get('/paiement/acompte/{devis}', [PaiementController::class, 'checkoutAcompte'])->name('paiement.acompte');
;
});
Route::get('/paiement/reste/{devis}', [PaiementController::class, 'checkoutReste'])
    ->middleware('auth')
    ->name('paiement.reste');

Route::get('/admin/paiements', [AdminPaiementController::class, 'index'])
    ->middleware('auth')
    ->name('admin.paiements.index');


Route::post('/paiement/checkout', [PaiementController::class, 'checkout'])
    ->middleware('auth')
    ->name('paiement.checkout');
    // Paiement : annulation
Route::get('/paiement/cancel', [App\Http\Controllers\PaiementController::class, 'cancel'])
    ->name('paiement.cancel');

// Paiement : succès
Route::get('/paiement/success', [App\Http\Controllers\PaiementController::class, 'success'])
    ->name('paiement.success');


Route::get('/paiement/success', [PaiementController::class, 'success'])
    ->middleware('auth')
    ->name('paiement.success');
    Route::get('/support', [SupportController::class, 'index'])->name('support.form');
Route::post('/support', [SupportController::class, 'send'])->name('support.send');
Route::get('/admin/paiements', [\App\Http\Controllers\Admin\AdminPaiementController::class, 'index'])
    ->middleware(['auth', 'isadmin'])
    ->name('admin.paiements.index');
    


