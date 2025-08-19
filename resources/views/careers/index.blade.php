@extends('layouts.app')

@section('title', 'Careers')

@section('content')

    <!-- Hero Section -->
    <section class="bg-white py-24 md:py-32">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h1 class="text-5xl md:text-7xl font-light text-gray-900 mb-8 tracking-tight">
                Do what you can't
            </h1>
            <div class="w-16 h-px bg-gray-300 mx-auto mb-12"></div>
            <p class="text-lg md:text-xl text-gray-600 font-light leading-relaxed max-w-2xl mx-auto">
                Who we hire
            </p>
            <p class="text-base text-gray-500 mt-4 max-w-3xl mx-auto leading-relaxed">
                Our mission is to help people do the impossible.
            </p>
            <p class="text-base text-gray-500 mt-2 max-w-3xl mx-auto leading-relaxed">
                We seek employees from all walks of life who are committed to their lives and work to create products that empower others to do what they can't. This is what drives our innovation forward.
            </p>
            <p class="text-base text-gray-500 mt-6 max-w-3xl mx-auto leading-relaxed">
                Find your opportunity to do what can't be done at Samsung.
            </p>
        </div>
    </section>

    <!-- Opportunities Section -->
    <section class="bg-gray-50 py-20">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div class="bg-white rounded-lg overflow-hidden shadow-sm">
                    <div class="h-80 bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-blue-500 rounded-full mx-auto mb-4 flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-medium text-gray-900">Explore exciting opportunities and apply now to join us.</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <a href="#jobs" class="inline-block bg-black text-white px-6 py-2 text-sm font-medium hover:bg-gray-800 transition-colors">
                            Apply now
                        </a>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-light text-gray-900 mb-8 leading-tight">
                        Explore exciting<br>
                        opportunities and apply<br>
                        now to join us.
                    </h2>
                </div>
            </div>
        </div>
    </section>

    <!-- Innovation Section -->
    <section class="bg-white py-20">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-3xl font-light text-gray-900 mb-8 leading-tight">
                        Work with the very best people<br>
                        and be a part of innovation that<br>
                        makes a real difference in the<br>
                        lives of millions worldwide.
                    </h2>
                </div>
                <div class="bg-gray-50 rounded-lg overflow-hidden">
                    <div class="h-80 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-gray-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <a href="#about" class="inline-block bg-black text-white px-6 py-2 text-sm font-medium hover:bg-gray-800 transition-colors">
                            Learn more
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Leadership Section -->
    <section class="bg-gray-50 py-20">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div class="bg-white rounded-lg overflow-hidden shadow-sm">
                    <div class="h-80 bg-gradient-to-br from-purple-100 to-purple-200 flex items-center justify-center">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-purple-500 rounded-full mx-auto mb-4 flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <a href="#leadership" class="inline-block bg-black text-white px-6 py-2 text-sm font-medium hover:bg-gray-800 transition-colors">
                            Learn more
                        </a>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-light text-gray-900 mb-8 leading-tight">
                        Become a global leader<br>
                        in your field and take your<br>
                        career to new heights.
                    </h2>
                </div>
            </div>
        </div>
    </section>

    <!-- Job Opportunities Section -->
    <section id="jobs" class="bg-white py-20">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-light text-gray-900 mb-12">Current Opportunities</h2>

            <div class="space-y-6">
                <div class="border border-gray-200 rounded-lg p-6 text-left hover:border-gray-300 transition-colors">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Software Engineer</h3>
                            <p class="text-gray-600 mb-1">Engineering • Full-time</p>
                            <p class="text-sm text-gray-500">Join our engineering team to develop cutting-edge solutions.</p>
                        </div>
                        <a href="mailto:careers@digiappliances.com" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Apply</a>
                    </div>
                </div>

                <div class="border border-gray-200 rounded-lg p-6 text-left hover:border-gray-300 transition-colors">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Product Designer</h3>
                            <p class="text-gray-600 mb-1">Design • Full-time</p>
                            <p class="text-sm text-gray-500">Create beautiful and intuitive user experiences.</p>
                        </div>
                        <a href="mailto:careers@digiappliances.com" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Apply</a>
                    </div>
                </div>

                <div class="border border-gray-200 rounded-lg p-6 text-left hover:border-gray-300 transition-colors">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Marketing Manager</h3>
                            <p class="text-gray-600 mb-1">Marketing • Full-time</p>
                            <p class="text-sm text-gray-500">Lead marketing strategies and drive growth.</p>
                        </div>
                        <a href="mailto:careers@digiappliances.com" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Apply</a>
                    </div>
                </div>
            </div>

            <div class="mt-12">
                <p class="text-gray-600 mb-4">Don't see a role that fits?</p>
                <a href="mailto:careers@digiappliances.com" class="inline-block bg-black text-white px-8 py-3 font-medium hover:bg-gray-800 transition-colors">
                    Send us your resume
                </a>
            </div>
        </div>
    </section>



@endsection
