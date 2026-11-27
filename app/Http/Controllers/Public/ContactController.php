<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('public.contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
            'phone' => 'nullable|string|max:20',
            'client_address' => 'nullable|string|max:1000',

            'is_company' => 'nullable|boolean',
            'company_name' => 'nullable|string|required_if:is_company,1|max:255',
            'company_siren' => 'nullable|required_if:is_company,1|digits:9',
            'company_vat_number' => 'nullable|string|max:30',
        ]);

        $isCompany = (bool) ($validated['is_company'] ?? false);

        Message::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'phone' => $validated['phone'] ?? null,
            'client_address' => $validated['client_address'] ?? null,

            'is_company' => $isCompany,
            'company_name' => $isCompany ? $validated['company_name'] : null,
            'company_siren' => $isCompany ? $validated['company_siren'] : null,
            'company_vat_number' => $isCompany
                ? ($validated['company_vat_number'] ?? null)
                : null,
        ]);

        return redirect()
            ->route('contact')
            ->with('success', 'Votre message a été envoyé.');
    }
}
