<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Category;


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
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string',
        ]);

        // Optionally send mail or store in DB
        // Mail::to('support@yourdomain.com')->send(new ContactMail($data));

        return back()->with('success', 'Your message has been sent successfully!');
    }
}
