@extends('layouts.app')

@section('title', 'Feedback')

@section('content')
    <div class="w-full py-6 border-gray-400">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <h2 class="text-4xl font-bold text-gray-900 mb-10">Feedback</h1>
            <p class="my-3 text-md w-2xl text-gray-700">Welcome! Your feedback is very important to us and we want to hear from you. We're always looking for ways to improve our services and products. Please take a minute to tell us how we're doing and how we can better serve you.</p>

            <div class="grid grid-cols-2">
                {{-- <div class=""></div> --}}
                {{-- Write your feedback form here --}}
                <form method="POST" action="{{ route('contact.send') }}">
                    @csrf
                    <div class="max-w-7xl mx-auto py-4">
                        <div class="mb-4">
                            <label for="name" class="block text-md font-medium text-gray-700 mb-1">Name</label>
                            <input type="text" name="name" id="name" placeholder="Enter your name" class="w-full p-2 placeholder:text-sm border border-gray-300 rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-md font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" id="email" placeholder="Enter your email" class="w-full p-2 placeholder:text-sm border border-gray-300 rounded">
                        </div>
                        <div class="mb-4">
                            <label class="block text-md font-medium text-gray-700 mb-1">Are you a client?</label>
                            <div class="flex items-center space-x-4">
                                <input type="radio" name="is_client" value="No" id="no" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                <label for="no" class="block text-sm font-medium text-gray-700">No</label>
                                <input type="radio" name="is_client" value="Yes" id="yes" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                <label for="yes" class="block text-sm font-medium text-gray-700">Yes</label>
                            </div>
                            <div class="mt-2" id="client-form">
                                <label for="product_model" class="block text-md font-medium text-gray-700 mb-1">Product Model:</label>
                                <select name="product_model" id="product_model" class="w-full p-2 border border-gray-300 rounded">
                                    <option value="">Select Model</option>
                                    @foreach ($categories as $category)
                                        @foreach ($category->products as $product)
                                            <option value="{{ $product->name }}">{{ $product->name }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                document.getElementById("client-form").style.display = "none";
                                document.querySelectorAll('input[name="is_client"]').forEach(function(radio) {
                                    radio.checked = false;
                                    radio.addEventListener('change', function() {
                                        if (this.value === "Yes") {
                                            document.getElementById("client-form").style.display = "block";
                                        } else {
                                            document.getElementById("client-form").style.display = "none";
                                        }
                                    });
                                });
                            });
                        </script>
                        <div class="mb-4">
                            <label for="message" class="block text-md font-medium text-gray-700 mb-1">Message:</label>
                            <textarea name="message" id="message" rows="4" class="w-full p-2 border border-gray-300 rounded"></textarea>
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
                        <button type="submit" class="bg-digi-orange hover:bg-digi-orange-dark text-white mt-2 font-semibold py-2 px-4 rounded-full">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('sections.need-help')
@endsection
