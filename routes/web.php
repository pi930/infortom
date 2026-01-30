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


// -----------------------------
// AUTH
// -----------------------------
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::prefix('admin')->middleware(['auth', 'isadmin'])->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/users', function () {
        return 'Liste des utilisateurs (à faire)';
    })->name('admin.users.index');

    Route::get('/settings', function () {
        return 'Paramètres admin (à faire)';
    })->name('admin.settings');

});
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index']) ->middleware(['auth', 'isadmin']) ->name('admin.dashboard');
Route::middleware(['auth'])->group(function () {

    Route::get('/profil', [UserProfileController::class, 'profile'])->name('user.profile');
    Route::get('/profil/edit', [UserProfileController::class, 'edit'])->name('user.edit');
    Route::post('/profil/update', [UserProfileController::class, 'update'])->name('user.update');

});
Route::middleware(['auth', 'isadmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/rendezvous', [App\Http\Controllers\Admin\RendezVousController::class, 'index'])->name('rendezvous.index');
    Route::post('/rendezvous', [App\Http\Controllers\Admin\RendezVousController::class, 'store'])->name('rendezvous.store');
    Route::delete('/rendezvous/{id}', [App\Http\Controllers\Admin\RendezVousController::class, 'destroy'])->name('rendezvous.destroy');
});



// ADMIN
Route::prefix('admin')->middleware(['auth', 'isadmin'])->group(function () {
    Route::get('/devis/create', [AdminDevisController::class, 'create'])->name('admin.devis.create');
    Route::post('/devis/store', [AdminDevisController::class, 'store'])->name('admin.devis.store');
    Route::get('/devis/{devis}', [AdminDevisController::class, 'show'])->name('admin.devis.show');
});

// USER
Route::middleware(['auth'])->group(function () {
    Route::get('/mon-devis/{devis}', [UserDevisController::class, 'show'])->name('user.devis.show');
});

// -----------------------------
// ADMIN (protégé par isadmin)
// -----------------------------
Route::middleware(['auth', 'isadmin'])->group(function () {


    // Répondre aux messages
    Route::get('/admin/messages/{id}/repondre', [AdminMessageController::class, 'repondre'])
        ->name('admin.messages.repondre');

    Route::post('/admin/messages/{id}/repondre', [AdminMessageController::class, 'envoyerReponse'])
        ->name('admin.messages.envoyerReponse');
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
        
});   
      
Route::post('/devis/accepter', [DevisController::class, 'accepter'])
    ->middleware('auth')
    ->name('devis.accepter');
    Route::get('/panier/from-devis/{devis}', [PanierController::class, 'fromDevis']) ->middleware('auth') ->name('panier.fromDevis');


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

