@extends('layouts.app')

@section('title', 'Return Policy')

@section('content')
    <!-- Return Policy Header -->
    <section class="bg-black text-white py-16">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h1 class="text-4xl font-light mb-4">Return Policy</h1>
            <p class="text-gray-300">Guidelines for returns, exchanges, and refunds</p>
        </div>
    </section>

    <!-- Return Policy Content -->
    <section class="bg-white py-16">
        <div class="max-w-4xl mx-auto px-4">
            <div class="prose prose-lg max-w-none">
                <h2 class="text-2xl font-semibold text-gray-900 mb-6">Product Return Policy</h2>

                <div class="space-y-8 text-gray-700 leading-relaxed">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">1. Overview</h3>
                        <p class="mb-4">
                            We aim to ensure you are satisfied with your purchase. If you need to return or exchange a product, this policy explains the conditions, timelines, and process for returns and refunds.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">2. Eligibility</h3>
                        <ul class="list-disc pl-6 mb-4 space-y-2">
                            <li>Items must be returned within <strong>14 days</strong> of delivery unless otherwise stated.</li>
                            <li>Items must be in their original condition: unused, undamaged, and in original packaging with all accessories and manuals.</li>
                            <li>Proof of purchase (order confirmation or receipt) is required.</li>
                            <li>Software, downloadable products, consumables, and customized orders are generally <strong>non‑returnable</strong> unless defective.</li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">3. Non‑Returnable Items</h3>
                        <ul class="list-disc pl-6 mb-4 space-y-2">
                            <li>Items damaged due to misuse, improper installation, or unauthorized repairs.</li>
                            <li>Products without original packaging, missing accessories, or serial numbers altered.</li>
                            <li>Hygiene-sensitive items that have been unsealed or used.</li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">4. Return Process</h3>
                        <ol class="list-decimal pl-6 mb-4 space-y-2">
                            <li>Contact our support team with your order details and reason for return.</li>
                            <li>We will review eligibility and provide a Return Authorization (RA) if approved.</li>
                            <li>Pack the item securely in its original packaging and include all accessories.</li>
                            <li>Ship or drop off the item per the instructions provided with the RA.</li>
                        </ol>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">5. Refunds</h3>
                        <p class="mb-4">
                            After your return is received and inspected, we will notify you of the approval or rejection of your refund. Approved refunds are processed to the original payment method within <strong>7–14 business days</strong>. Shipping fees are generally non‑refundable unless the item was defective or an incorrect item was sent.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">6. Exchanges</h3>
                        <p class="mb-4">
                            If you need to exchange an item (e.g., for a different model), follow the return process. Once approved, we will guide you on placing a replacement order or dispatch an exchange as applicable.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">7. Damaged or Defective Items</h3>
                        <p class="mb-4">
                            Please inspect your order upon receipt and contact us immediately if the item is defective, damaged, or if you receive the wrong item. We will evaluate the issue and make it right, including replacement, repair, or refund according to warranty terms.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">8. Warranty</h3>
                        <p class="mb-4">
                            Returns may be covered under manufacturer warranty. For warranty claims, please contact our support team or visit the product support page. Proof of purchase is required for warranty service.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">9. Contact</h3>
                        <p class="mb-4">
                            For return requests, exchanges, or warranty support, contact our team via the <a href="{{ route('contact') }}" class="text-orange-600 hover:underline">Contact Us</a> page.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection