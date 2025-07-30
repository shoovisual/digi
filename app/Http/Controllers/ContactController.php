<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Category;
use App\Mail\ContactFormMail;


use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::where('name', '!=', 'All Products')->get();
        return view('contact.index', compact('categories'));
    }

    public function send(Request $request)
    {
        // ✅ Validate form fields
        $validated = $request->validate([
            'reason'             => 'required|string',
            'is_under_warranty'  => 'nullable|in:0,1',
            'product_type'       => 'required|string',
            'product_model'      => 'required|string',
            'name'               => 'required|string|max:255',
            'phone'              => 'required|string|max:20',
            'email'              => 'nullable|email',
            'country'            => 'required|string',
            'address'            => 'nullable|string',
            'message'            => 'required|string',
        ]);

        // ✅ Prepare data for email
        $data = [
            'reason'            => $request->reason,
            'is_under_warranty' => $request->is_under_warranty == '1' ? 'Yes' : 'No',
            'product_type'      => $request->product_type,
            'product_model'     => $request->product_model,
            'name'              => $request->name,
            'phone'             => $request->phone,
            'email'             => $request->email,
            'country'           => $request->country,
            'address'           => $request->address,
            'message'           => $request->message,
        ];

        // ✅ Send Email
       Mail::to('shoovisual@gmail.com')->send(new ContactFormMail($data));

        return back()->with('success', 'Your message has been sent successfully.');
    }
}
