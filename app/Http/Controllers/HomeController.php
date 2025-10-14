<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReturnRequestMail;
use App\Models\ReturnReason;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::take(5)->get();
        
        return view('home', compact('categories', 'products'));
    }
    public function feedback()
    {
        $categories = Category::all();
        return view('feedback', compact('categories'));
    }
    public function privacy()
    {
        $categories = Category::all();
        return view('legal.privacy-policy', compact('categories'));
    }
    public function terms()
    {
        $categories = Category::all();
        return view('legal.terms-conditions', compact('categories'));
    }
    public function returns()
    {
        $categories = Category::all();
        return view('legal.return-policy', compact('categories'));
    }

    // Show order return request form
    public function returnRequest()
    {
        $categories = Category::orderBy('name')->get();
        $reasons = ReturnReason::where('active', true)->orderBy('sort_order')->orderBy('name')->get();
        return view('legal.return-request', compact('categories','reasons'));
    }

    // Handle order return request submission
    public function submitReturnRequest(Request $request)
    {
        $validated = $request->validate([
            'email' => ['nullable','email'],
            'phone' => ['nullable','string','max:32'],
            'category_id' => ['required','integer','exists:categories,id'],
            'product_id' => ['required','integer','exists:products,id'],
            'return_reason_id' => ['required','integer','exists:return_reasons,id'],
            'order_number' => ['nullable','string','max:60'],
            'details' => ['nullable','string'],
        ]);

        if (empty($validated['email']) && empty($validated['phone'])) {
            return back()->withErrors(['contact' => 'Provide either email or phone.'])->withInput();
        }

        try {
            $category = Category::find($validated['category_id']);
            $product = Product::find($validated['product_id']);
            $reason = ReturnReason::find($validated['return_reason_id']);
            $payload = array_merge($validated, [
                'category_name' => $category?->name,
                'product_name' => $product?->name,
                'reason_name' => $reason?->name,
            ]);
            $to = config('mail.from.address') ?: 'shoovisual@gmail.com';
            Mail::to($to)->send(new ReturnRequestMail($payload));
        } catch (\Throwable $e) {
            return back()->withErrors(['mail' => 'Unable to send request at this time.'])->withInput();
        }

        return redirect()->route('return-request')
            ->with('status', 'Your return request has been submitted. Our team will contact you shortly.');
    }
}
