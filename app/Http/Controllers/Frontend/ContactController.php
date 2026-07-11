<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Show the contact page.
     * GET /contact
     */
    public function index()
    {
        return view('frontend.contact');
    }

    /**
     * Store a contact form submission.
     * POST /contact
     *
     * Saves to the enquiries table with product_id = null
     * and subject set (General Enquiry, Order Question, etc.)
     * so the admin panel can distinguish from product enquiries.
     * Status defaults to 'new' — dealer follows up manually.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'phone'   => 'nullable|string|max:30',
            'subject' => 'required|string|max:100',
            'message' => 'required|string|max:2000',
        ]);

        Enquiry::create([
            'product_id' => null,                       // null = contact form, not a product enquiry
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'phone'      => $validated['phone'] ?? null,
            'subject'    => $validated['subject'],
            'message'    => $validated['message'],
            'status'     => 'new',
        ]);

        return redirect()
            ->route('contact')
            ->with('success', 'Thank you, ' . $validated['name'] . '! Your message has been sent. We\'ll get back to you within 1–2 business days.');
    }
}