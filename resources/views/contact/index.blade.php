@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<section class="bg-white py-16">
    <div class="container mx-auto px-4 max-w-7xl">
        <h2 class="text-4xl font-bold text-gray-900 mb-10">Contact Us</h2>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Contact Form -->
            <div class="lg:col-span-2">
                @if(session('success'))
                    <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('contact.send') }}" class="font-medium space-y-6">
                    @csrf

                    <!-- Reason -->
                    <div>
                        <label class="block text-md font-medium text-gray-700 mb-1">Reason*</label>
                        <select name="reason" id="reason" class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring focus:ring-teal-300" onchange="toggleWarrantyCheck()">
                            <option selected value="Select Reason" disabled>Select Reason</option>
                            <option>Customer Service – Products</option>
                            <option>Technical Support</option>
                            <option>Warranty Inquiry</option>
                        </select>
                    </div>

                    <script>
                        function toggleWarrantyCheck() {
                            const reason = document.getElementById('reason');
                            const show   = reason.value === 'Warranty Inquiry';
                            document.getElementById('warrantyCheck').hidden = !show;
                        }

                        /* ---- reset to the hard‑coded <option selected> value and apply logic ---- */
                        document.addEventListener('DOMContentLoaded', () => {
                            const reasonSelect = document.getElementById('reason');
                            const defaultVal   = reasonSelect.querySelector('option[selected]')?.value || '';
                            reasonSelect.value = defaultVal;        // ← ensures reset on every reload
                            toggleWarrantyCheck();                  // ← show / hide warranty toggle
                        });
                    </script>


                    <!-- Is under warranty -->
                    <div id="warrantyCheck" style="display: none;">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Is the product under warranty?</label>
                        <div class="flex items-center space-x-2">
                            <input type="radio" name="is_under_warranty" id="is_under_warranty" value="1" class="rounded-full" />
                            <label for="is_under_warranty" class="text-sm font-medium text-gray-700">Yes</label>
                        </div>
                        <div class="flex items-center space-x-2">
                            <input type="radio" name="is_under_warranty" id="is_under_warranty" value="0" class="rounded-full" />
                            <label for="is_under_warranty" class="text-sm font-medium text-gray-700">No</label>
                        </div>
                    </div>

                    <script>
                        function toggleWarrantyCheck() {
                            if (document.getElementById('reason').value == 'Customer Service – Products') {
                                document.getElementById('warrantyCheck').style.display = 'block';
                            } else {
                                document.getElementById('warrantyCheck').style.display = 'none';
                            }
                        }
                    </script>

                    <!-- Product Type & Model -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-md font-medium text-gray-700 mb-1">Product Type*</label>
                            <select name="product_type" id="product_type" class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring focus:ring-teal-300">
                                <option>Please select</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-md font-medium text-gray-700 mb-1">Product Model*</label>
                            <select name="product_model" id="product_model" class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring focus:ring-teal-300">
                                <option>Please select</option>
                            </select>
                        </div>

                        <script>
                            document.getElementById('product_type').addEventListener('change', function () {
                                var productTypeId = this.value;
                                var productModelSelect = document.getElementById('product_model');
                                productModelSelect.innerHTML = '<option>Please select</option>';
                                @foreach ($categories as $category)
                                    if (productTypeId == '{{ $category->name }}') {
                                        @foreach ($category->products as $product)
                                            productModelSelect.innerHTML += '<option value="{{ $product->name }}">{{ $product->name }} - SN: {{ $product->serial }}</option>';
                                        @endforeach
                                    }
                                @endforeach
                            });
                        </script>
                    </div>

                    <!-- Name -->
                    <div>
                        <label class="block text-md font-medium text-gray-700 mb-1">Name*</label>
                        <input type="text" name="name" required class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring focus:ring-teal-300">
                    </div>

                    <!-- Phone & Email -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-md font-medium text-gray-700 mb-1">Phone*</label>
                            <input type="text" name="phone" required class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring focus:ring-teal-300">
                        </div>
                        <div>
                            <label class="block text-md font-medium text-gray-700 mb-1">Email (Optional)</label>
                            <input type="email" name="email" class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring focus:ring-teal-300">
                        </div>
                    </div>

                    <!-- Country -->
                    <div>
                        <label class="block text-md font-medium text-gray-700 mb-1">Country*</label>
                        <select name="country" required class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring focus:ring-teal-300">
                            <option>Please select</option>
                            <option>Tanzania</option>
                            <option>Kenya</option>
                            <option>Uganda</option>
                        </select>
                        <p class="text-sm text-gray-500 mt-1">If you cannot find your country, contact your local reseller directly.</p>
                    </div>

                    <!-- Address -->
                    <div>
                        <label class="block text-md font-medium text-gray-700 mb-1">Address (Optional)</label>
                        <input type="text" name="address" class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring focus:ring-teal-300">
                    </div>

                    <!-- Message -->
                    <div>
                        <label class="block text-md font-medium text-gray-700 mb-1">How can we help?*</label>
                        <textarea name="message" required rows="5" class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring focus:ring-teal-300"></textarea>
                    </div>

                    <!-- Checkboxes -->
                    <div class="space-y-4 text-md text-gray-600">
                        <label class="flex items-start space-x-2">
                            <input type="checkbox" required id="privacy-policy-checkbox" class="mt-1" onchange="toggleSubmitButton()">
                            <span>I have read and agreed to the <a href="#" class="text-teal-600 underline">Privacy Policy</a>.</span>
                        </label>

                        <label class="flex items-start space-x-2">
                            <input type="checkbox" class="mt-1">
                            <span>I agree to receive news and promotional materials.</span>
                        </label>
                    </div>

                    <!-- Submit -->
                    <button type="submit" id="submit-button" disabled class="bg-digi-orange text-white px-6 py-2 rounded-full text-lg font-semibold shadow hover:bg-gradient-to-l transition ease-in-out duration-300 cursor-pointer">
                        Send
                    </button>

                    <script>
                        function toggleSubmitButton() {
                            const checkbox = document.getElementById('privacy-policy-checkbox');
                            const submitButton = document.getElementById('submit-button');
                            submitButton.disabled = !checkbox.checked;
                        }
                    </script>
                </form>
            </div>

            <!-- Right Side Social Box -->
            <div class="relative h-80 text-white rounded-2xl p-8 flex flex-col justify-between" style="background-image: url('img/contact-us-featured.jpg'); background-size: cover;">
                <div class="overlay bg-gradient-to-b from-[#0f1d2d] to-[#777777]/70 rounded-2xl absolute z-10 inset-0"></div>
                <div class="z-30">
                    <div>
                        <h3 class="text-4xl font-semibold mb-2">FOLLOW US ON SOCIAL MEDIA</h3>
                        <p class="text-md font-medium text-white/80">Get in touch with us and we’re looking forward to you.</p>
                    </div>
                    <div class="mt-8 absolute bottom-10 flex space-x-3">
                        <a href="#" class="block hover:underline">@Facebook</a>
                        <a href="#" class="block hover:underline">@Twitter</a>
                        <a href="#" class="block hover:underline">@Instagram</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
