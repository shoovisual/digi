@extends('layouts.app')

@section('title', 'Order Return Request')

@section('content')
    <!-- Header -->
    <section class="bg-black text-white py-16">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h1 class="text-4xl font-light mb-4">Return / Cancel Order</h1>
            <p class="text-gray-300">Complete the form below to begin the process</p>
        </div>
    </section>

    <!-- Content -->
    <section class="bg-white py-16">
        <div class="max-w-4xl mx-auto px-4">
            @if(session('status'))
                <div class="bg-green-100 text-green-800 border border-green-200 rounded p-4 mb-6">
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 text-red-800 border border-red-200 rounded p-4 mb-6">
                    <ul class="list-disc pl-6">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid md:grid-cols-3 gap-8">
                <div class="md:col-span-2">
                    <form action="{{ route('return-request.submit') }}" method="POST" class="space-y-6" x-data="returnForm()" x-init="init()">
                        @csrf

                        <div>
                            <label class="block text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" class="w-full border rounded px-3 py-2" />
                            <p class="text-xs text-gray-500 mt-1">Provide email or phone. At least one is required.</p>
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Phone</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+255 700 000 000" class="w-full border rounded px-3 py-2" />
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Product Category</label>
                            <select name="category_id" x-model="categoryId" @change="fetchProducts()" class="w-full border rounded px-3 py-2" required>
                                <option value="">Selection</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Product Name</label>
                            <select name="product_id" x-model="productId" class="w-full border rounded px-3 py-2" :disabled="!categoryId" required>
                                <option value="">Selection</option>
                                <template x-for="p in products" :key="p.id">
                                    <option :value="p.id" x-text="p.name"></option>
                                </template>
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Order Number (optional)</label>
                            <input type="text" name="order_number" value="{{ old('order_number') }}" placeholder="e.g., #DG-123456" class="w-full border rounded px-3 py-2" />
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Return Reason</label>
                            <select name="return_reason_id" class="w-full border rounded px-3 py-2" required>
                                <option value="">Selection</option>
                                @isset($reasons)
                                    @foreach($reasons as $reason)
                                        <option value="{{ $reason->id }}" @selected(old('return_reason_id') == $reason->id)>{{ $reason->name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Optional details below.</p>
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Details (optional)</label>
                            <textarea name="details" rows="4" class="w-full border rounded px-3 py-2" placeholder="Additional information">{{ old('details') }}</textarea>
                        </div>

                        <button type="submit" class="bg-orange-600 text-white px-6 py-3 rounded hover:bg-orange-700">GET ORDER</button>
                    </form>
                </div>

                <aside class="md:col-span-1">
                    <div class="bg-gray-50 border rounded p-4 space-y-4">
                        <h3 class="text-lg font-semibold">Note</h3>
                        <ul class="list-disc pl-5 text-gray-700 space-y-2">
                            <li>If you go ahead with a return request, <strong>$10</strong> will be charged for printing the label against your request.</li>
                            <li>The return request below <strong>$10</strong> will not be accepted.</li>
                            <li>Items must be in original condition with packaging and accessories.</li>
                            <li>Returns are generally accepted within <strong>14 days</strong> of delivery.</li>
                        </ul>
                        <p class="text-sm text-gray-500">For urgent assistance, please contact our team via the <a href="{{ route('contact') }}" class="text-orange-600 hover:underline">Contact Us</a> page.</p>
                    </div>
                </aside>
            </div>
        </div>
    </section>
    <script>
        function returnForm() {
            return {
                categoryId: '{{ old('category_id') }}',
                productId: '{{ old('product_id') }}',
                products: [],
                async init() {
                    if (this.categoryId) { await this.fetchProducts(); }
                },
                async fetchProducts() {
                    if (!this.categoryId) { this.products = []; this.productId = ''; return; }
                    try {
                        const res = await fetch(`/api/products-by-category/${this.categoryId}`);
                        const data = await res.json();
                        this.products = (data.products || data) ?? [];
                    } catch (e) {
                        this.products = [];
                    }
                }
            }
        }
    </script>
@endsection