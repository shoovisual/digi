<!-- ======= Footer ======= -->
<footer class="border-t pt-10 pb-6 bg-white text-sm">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="md:hidden block mb-4">
        <img src="{{ asset('img/digi-logo.svg') }}" alt="DIGI logo" class="h-7 w-auto" />
    </div>
    <!-- Top section ---------------------------------------------------->
    <div class="grid gap-8 font-medium grid-cols-2 md:grid-cols-5">

        <div class="md:block hidden">
            <img src="{{ asset('img/digi-logo.svg') }}" alt="DIGI logo" class="h-10 w-auto" />
        </div>

        <!-- 2️⃣ Shop -->
        <div>
            <h3 class="font-semibold text-lg mb-3 tracking-wide">Shop</h3>
            <ul class="space-y-2">
            <li><a href="#" class="hover:underline">Latest Products</a></li>
            <li><a href="{{ url('/categories/digi-tvs') }}" class="hover:underline">TVs</a></li>
            <li><a href="{{ url('/categories/digi-refrigerators') }}" class="hover:underline">Fridges</a></li>
            <li><a href="{{ url('/categories/digi-acs') }}" class="hover:underline">Air conditioning</a></li>
            </ul>
        </div>

        <!-- 3️⃣ Support -->
        <div>
            <h3 class="font-semibold text-lg mb-3 tracking-wide">Support</h3>
            <ul class="space-y-2">
            <li><a href="https://wa.me/255793333444" target="_blank" class="hover:underline">Chat with Us</a></li>
            <li><a href="{{ route('contact') }}" class="hover:underline">Product Support</a></li>
            <li><a href="{{ route('contact') }}" class="hover:underline">Contact Us</a></li>
            <li><a href="{{ route('feedback') }}" class="hover:underline">Give Feedback</a></li>
            </ul>
        </div>

        <!-- 4️⃣ About Us -->
        <div>
            <h3 class="font-semibold text-lg mb-3 tracking-wide">About&nbsp;Us</h3>
            <ul class="space-y-2">
            <li><a href="{{ route('about') }}" class="hover:underline">Company Info</a></li>
            <li><a href="{{ route('about-digi.index') }}" class="hover:underline">Our Business</a></li>
            <li><a href="{{ asset('img/branding/digi_branding_guide.pdf') }}" target="_blank" class="hover:underline">Brand Identity</a></li>
            <li><a href="#" class="hover:underline">Careers</a></li>
            {{-- <li><a href="#" class="hover:underline">Newsroom</a></li> --}}
            {{-- <li><a href="#" class="hover:underline">Ethics</a></li> --}}
            </ul>
        </div>

        <!-- 5️⃣ Sustainability -->
        <div>
            <h3 class="font-semibold text-lg mb-3 tracking-wide">Social Links</h3>
            <ul class="flex gap-4 text-2xl">
                <li >
                    <a href="https://www.instagram.com/digi_tanzania/" target="_blank">
                        <i class="bi bi-instagram"></i>
                    </a>
                </li>
                <li >
                    <a href="https://www.facebook.com/profile.php?id=61573040064155" target="_blank">
                        <i class="bi bi-facebook"></i>
                    </a>
                </li>
                <li >
                    <a href="https://www.tiktok.com/@digi_tanzania" target="_blank">
                        <i class="bi bi-tiktok"></i>
                    </a>
                </li>
                <li >
                    <a href="https://youtube.com/@digi_tanzania?si=atTe-OGoDBLNMe7_" target="_blank">
                        <i class="bi bi-youtube"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Divider ------------------------------------------------------->
    <hr class="my-8 border-gray-300" />

    <!-- Bottom bar ---------------------------------------------------->
    <div class="flex flex-col sm:flex-row justify-between font-medium items-center gap-4">
      <p class="text-gray-700">&copy;{{ date('Y') }} DIGI&nbsp;| All Rights Reserved.</p>

      <nav class="flex items-center text-blue-600 font-medium space-x-4">
        <a href="{{ route('terms-conditions') }}" class="hover:underline">Terms and Conditions</a>
        <span class="hidden sm:inline-block">|</span>
        <a href="{{ route('privacy-policy') }}" class="hover:underline">Privacy &amp; Policies</a>
        <span class="hidden sm:inline-block">|</span>
        <a href="{{ route('return-policy') }}" class="hover:underline">Return &amp; Exchange Policy</a>
      </nav>
    </div>
  </div>
</footer>
@include('layouts.partials.vendor_js')
