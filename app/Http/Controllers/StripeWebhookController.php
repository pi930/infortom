<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Webhook;
use App\Models\Devis;
use App\Models\Paiement;

class StripeWebhookController extends Controller
{
    public function handle(Request $request)
    {
        // Récupération de la signature envoyée par Stripe
        $signature = $request->header('Stripe-Signature');

        // Clé secrète du webhook (whsec_xxx)
        $endpointSecret = config('services.stripe.webhook_secret');

        // Récupération du payload brut
        $payload = $request->getContent();

        try {
            // Vérification de la signature Stripe
            $event = Webhook::constructEvent(
                $payload,
                $signature,
                $endpointSecret
            );
        } catch (\Exception $e) {
            Log::error('Stripe Webhook signature error: ' . $e->getMessage());
            return response('Invalid signature', 400);
        }

        // On traite uniquement checkout.session.completed
        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;

            // Récupération de l'ID du devis passé dans metadata
            $devisId = $session->metadata->devis_id ?? null;
            $typePaiement = $session->metadata->type_paiement ?? 'inconnu';

            if ($devisId) {
                $devis = Devis::find($devisId);

                if ($devis) {
                    // Mise à jour du devis
                    $devis->statut_paiement = 'payé';
                    $devis->save();

                    // Enregistrement du paiement
                    Paiement::create([
                        'devis_id' => $devis->id,
                        'montant' => $session->amount_total / 100,
                        'type' => $typePaiement,
                        'stripe_session_id' => $session->id,
                    ]);

                    Log::info("Paiement Stripe confirmé pour le devis #{$devis->id}");
                } else {
                    Log::error("Devis introuvable pour l'ID : {$devisId}");
                }
            } else {
                Log::error("Aucun devis_id dans metadata Stripe");
            }
        }

        return response('Webhook handled', 200);
    }
}