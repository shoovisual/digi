@extends('layouts.app')

@section('title', 'Careers')

@section('content')

    <!-- Hero Section -->
    <section class="relative bg-cover flex items-center bg-center h-[80vh] py-32"
             style="background-image: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="absolute inset-0 bg-black/40"></div>
        <div class="relative container mx-auto px-4 text-center text-white">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">India</h1>
            <p class="max-w-4xl mx-auto text-xl md:text-2xl font-light leading-relaxed">
                At DIGI, we believe in empowering our people to innovate, grow, and make a meaningful impact. 
                Join our diverse team and be part of shaping the future of digital appliances.
            </p>
        </div>
    </section>

    <!-- Overview Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-6">Overview</h2>
                <div class="w-24 h-1 bg-red-500 mx-auto mb-8"></div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <p class="text-lg text-gray-700 leading-relaxed mb-6">
                        DIGI is more than just a workplace—it's a community of innovators, dreamers, and achievers. 
                        We foster an environment where creativity thrives, diversity is celebrated, and every voice matters.
                    </p>
                    <p class="text-lg text-gray-700 leading-relaxed mb-6">
                        Our commitment to excellence extends beyond our products to our people. We invest in your growth, 
                        support your ambitions, and provide the tools you need to succeed in your career journey.
                    </p>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        Whether you're just starting your career or looking to take the next step, DIGI offers 
                        opportunities across various disciplines—from engineering and design to marketing and operations.
                    </p>
                </div>
                <div class="bg-gray-100 rounded-lg p-8">
                    <div class="grid grid-cols-2 gap-6 text-center">
                        <div>
                            <div class="text-3xl font-bold text-red-500 mb-2">500+</div>
                            <div class="text-gray-600">Employees</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-red-500 mb-2">15+</div>
                            <div class="text-gray-600">Departments</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-red-500 mb-2">25+</div>
                            <div class="text-gray-600">Countries</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-red-500 mb-2">67</div>
                            <div class="text-gray-600">Years of Excellence</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-6">Benefits</h2>
                <div class="w-24 h-1 bg-red-500 mx-auto mb-8"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    We believe in taking care of our people with comprehensive benefits that support your well-being and growth.
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg p-8 shadow-lg text-center hover:shadow-xl transition-shadow">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Competitive Salary</h3>
                    <p class="text-gray-600">Industry-leading compensation packages with performance-based bonuses and regular salary reviews.</p>
                </div>
                
                <div class="bg-white rounded-lg p-8 shadow-lg text-center hover:shadow-xl transition-shadow">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Career Growth</h3>
                    <p class="text-gray-600">Clear career progression paths with mentorship programs and leadership development opportunities.</p>
                </div>
                
                <div class="bg-white rounded-lg p-8 shadow-lg text-center hover:shadow-xl transition-shadow">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Learning & Development</h3>
                    <p class="text-gray-600">Continuous learning opportunities through training programs, workshops, and educational support.</p>
                </div>
                
                <div class="bg-white rounded-lg p-8 shadow-lg text-center hover:shadow-xl transition-shadow">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Work-Life Balance</h3>
                    <p class="text-gray-600">Flexible working arrangements, generous leave policies, and wellness programs to support your lifestyle.</p>
                </div>
                
                <div class="bg-white rounded-lg p-8 shadow-lg text-center hover:shadow-xl transition-shadow">
                    <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Team Environment</h3>
                    <p class="text-gray-600">Collaborative and inclusive workplace culture that values diversity and encourages innovation.</p>
                </div>
                
                <div class="bg-white rounded-lg p-8 shadow-lg text-center hover:shadow-xl transition-shadow">
                    <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Security & Stability</h3>
                    <p class="text-gray-600">Job security with a stable, growing company that has been trusted for over 65 years in the industry.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Health and Wellness Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-6">Health and Wellness</h2>
                <div class="w-24 h-1 bg-red-500 mx-auto mb-8"></div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-2xl font-semibold text-gray-900 mb-6">Medical Insurance</h3>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <p class="text-gray-700">Comprehensive health coverage for employees and their families</p>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <p class="text-gray-700">Dental and vision care included in all plans</p>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <p class="text-gray-700">Mental health support and counseling services</p>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <p class="text-gray-700">Annual health checkups and preventive care</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-lg p-8">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-semibold text-gray-900 mb-4">Your Health Matters</h4>
                        <p class="text-gray-700">We believe that healthy employees are happy employees. Our comprehensive wellness programs are designed to support your physical and mental well-being.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Culture Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-6">Culture</h2>
                <div class="w-24 h-1 bg-red-500 mx-auto mb-8"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Our culture is built on innovation, collaboration, and respect. We foster an environment where everyone can thrive.
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Innovation First</h3>
                    <p class="text-gray-600">We encourage creative thinking and provide the resources to turn innovative ideas into reality.</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Diversity & Inclusion</h3>
                    <p class="text-gray-600">We celebrate differences and believe that diverse perspectives drive better solutions and outcomes.</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Continuous Growth</h3>
                    <p class="text-gray-600">We invest in our people's development and provide opportunities for continuous learning and advancement.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Internal Communications Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-6">Internal Communications</h2>
                <div class="w-24 h-1 bg-red-500 mx-auto mb-8"></div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-2xl font-semibold text-gray-900 mb-6">Monthly Communications</h3>
                    <div class="space-y-6">
                        <div class="bg-blue-50 rounded-lg p-6">
                            <h4 class="text-lg font-semibold text-blue-900 mb-3">All-Hands Meetings</h4>
                            <p class="text-blue-800">Monthly company-wide meetings to share updates, celebrate achievements, and align on goals.</p>
                        </div>
                        <div class="bg-green-50 rounded-lg p-6">
                            <h4 class="text-lg font-semibold text-green-900 mb-3">Team Updates</h4>
                            <p class="text-green-800">Regular departmental meetings to discuss projects, challenges, and collaborative opportunities.</p>
                        </div>
                        <div class="bg-purple-50 rounded-lg p-6">
                            <h4 class="text-lg font-semibold text-purple-900 mb-3">Innovation Sessions</h4>
                            <p class="text-purple-800">Monthly brainstorming sessions where all employees can share ideas and contribute to innovation.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg p-8">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-indigo-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-semibold text-gray-900 mb-4">Open Communication</h4>
                        <p class="text-gray-700">We believe in transparent communication at all levels. Every voice matters and every idea is valued in our collaborative environment.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Student Program Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-6">Student Program</h2>
                <div class="w-24 h-1 bg-red-500 mx-auto mb-8"></div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="bg-gradient-to-br from-yellow-50 to-orange-100 rounded-lg p-8">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-yellow-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-semibold text-gray-900 mb-4">Internship Program</h4>
                        <p class="text-gray-700">Our comprehensive internship program provides students with real-world experience and mentorship opportunities.</p>
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-semibold text-gray-900 mb-6">Internship Program</h3>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <p class="text-gray-700">3-6 month internship programs across various departments</p>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <p class="text-gray-700">Mentorship from experienced professionals</p>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <p class="text-gray-700">Hands-on experience with real projects and challenges</p>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <p class="text-gray-700">Potential for full-time employment upon graduation</p>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <p class="text-gray-700">Competitive stipend and learning allowances</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- People and Stories Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-6">People and Stories</h2>
                <div class="w-24 h-1 bg-red-500 mx-auto mb-8"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Meet some of our amazing team members and hear their stories about working at DIGI.
                </p>
            </div>
            
            <div class="grid md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-32 h-32 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full mx-auto mb-6 flex items-center justify-center">
                        <span class="text-white text-2xl font-bold">AS</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Ahmed Salim</h3>
                    <p class="text-gray-600 mb-4">Senior Engineer</p>
                    <p class="text-sm text-gray-700">"DIGI has provided me with incredible opportunities to grow and innovate. The collaborative environment here is truly inspiring."</p>
                </div>
                
                <div class="text-center">
                    <div class="w-32 h-32 bg-gradient-to-br from-green-400 to-green-600 rounded-full mx-auto mb-6 flex items-center justify-center">
                        <span class="text-white text-2xl font-bold">FM</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Fatima Mohamed</h3>
                    <p class="text-gray-600 mb-4">Product Manager</p>
                    <p class="text-sm text-gray-700">"Working at DIGI means being part of a team that values innovation and supports each other's success every day."</p>
                </div>
                
                <div class="text-center">
                    <div class="w-32 h-32 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full mx-auto mb-6 flex items-center justify-center">
                        <span class="text-white text-2xl font-bold">MH</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Mohamed Hassan</h3>
                    <p class="text-gray-600 mb-4">Marketing Specialist</p>
                    <p class="text-sm text-gray-700">"The diversity and inclusion at DIGI creates an environment where everyone can contribute their unique perspectives."</p>
                </div>
                
                <div class="text-center">
                    <div class="w-32 h-32 bg-gradient-to-br from-red-400 to-red-600 rounded-full mx-auto mb-6 flex items-center justify-center">
                        <span class="text-white text-2xl font-bold">SA</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Sara Ahmed</h3>
                    <p class="text-gray-600 mb-4">HR Manager</p>
                    <p class="text-sm text-gray-700">"DIGI's commitment to employee development and well-being makes it a wonderful place to build a career."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Moments at Work Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-6">Moments at Work</h2>
                <div class="w-24 h-1 bg-red-500 mx-auto mb-8"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Take a glimpse into our vibrant workplace culture and the moments that make DIGI special.
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                    <div class="h-64 bg-gradient-to-br from-blue-200 to-blue-400 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Team Collaboration</h3>
                        <p class="text-gray-600">Our teams work together seamlessly, sharing ideas and supporting each other to achieve common goals.</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                    <div class="h-64 bg-gradient-to-br from-green-200 to-green-400 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Innovation Sessions</h3>
                        <p class="text-gray-600">Regular brainstorming sessions where creativity flows and breakthrough ideas are born.</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                    <div class="h-64 bg-gradient-to-br from-purple-200 to-purple-400 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Team Events</h3>
                        <p class="text-gray-600">From celebrations to team building activities, we create memorable moments together.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Job Opportunities Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-6">DIGI Job Opportunities</h2>
                <div class="w-24 h-1 bg-red-500 mx-auto mb-8"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Ready to join our team? Explore current openings and find your next career opportunity.
                </p>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-8">
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-6">Current Openings</h3>
                        <div class="space-y-4">
                            <div class="bg-white rounded-lg p-6 border-l-4 border-blue-500">
                                <h4 class="text-lg font-semibold text-gray-900 mb-2">Senior Software Engineer</h4>
                                <p class="text-gray-600 mb-2">Engineering Department</p>
                                <p class="text-sm text-gray-700">Join our engineering team to develop cutting-edge solutions for our digital appliance ecosystem.</p>
                            </div>
                            
                            <div class="bg-white rounded-lg p-6 border-l-4 border-green-500">
                                <h4 class="text-lg font-semibold text-gray-900 mb-2">Product Marketing Manager</h4>
                                <p class="text-gray-600 mb-2">Marketing Department</p>
                                <p class="text-sm text-gray-700">Lead product marketing strategies and drive growth for our innovative appliance lines.</p>
                            </div>
                            
                            <div class="bg-white rounded-lg p-6 border-l-4 border-purple-500">
                                <h4 class="text-lg font-semibold text-gray-900 mb-2">UX/UI Designer</h4>
                                <p class="text-gray-600 mb-2">Design Department</p>
                                <p class="text-sm text-gray-700">Create intuitive and beautiful user experiences for our digital products and services.</p>
                            </div>
                            
                            <div class="bg-white rounded-lg p-6 border-l-4 border-red-500">
                                <h4 class="text-lg font-semibold text-gray-900 mb-2">Sales Representative</h4>
                                <p class="text-gray-600 mb-2">Sales Department</p>
                                <p class="text-sm text-gray-700">Build relationships with customers and drive sales growth across our product portfolio.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-6">How to Apply</h3>
                        <div class="bg-white rounded-lg p-6">
                            <div class="space-y-6">
                                <div class="flex items-start space-x-4">
                                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold">1</div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 mb-2">Review Positions</h4>
                                        <p class="text-gray-600">Browse through our current openings and find roles that match your skills and interests.</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start space-x-4">
                                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold">2</div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 mb-2">Submit Application</h4>
                                        <p class="text-gray-600">Send your resume and cover letter to our HR team at careers@digi.com</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start space-x-4">
                                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold">3</div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 mb-2">Interview Process</h4>
                                        <p class="text-gray-600">Participate in our comprehensive interview process designed to assess fit and potential.</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start space-x-4">
                                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold">4</div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 mb-2">Join Our Team</h4>
                                        <p class="text-gray-600">Welcome to DIGI! Begin your journey with comprehensive onboarding and training.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-8 text-center">
                                <a href="mailto:careers@digi.com" class="inline-flex items-center px-6 py-3 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-lg transition-colors">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    Apply Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection