<!-- ======= Footer ======= -->
<footer class="border-t pt-10 pb-6 bg-white text-sm">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Top section ---------------------------------------------------->
    <div class="grid gap-8 font-medium md:grid-cols-5">
      <!-- 1️⃣ Logo column -->
      <div>
        <img src="{{ asset('img/digi-logo.svg') }}" alt="DIGI logo" class="h-10 w-auto" />
      </div>

      <!-- 2️⃣ Shop -->
      <div>
        <h3 class="font-semibold text-lg mb-3 tracking-wide">Shop</h3>
        <ul class="space-y-2">
          <li><a href="#" class="hover:underline">Latest Products</a></li>
          <li><a href="#" class="hover:underline">TVs</a></li>
          <li><a href="#" class="hover:underline">Home Appliances</a></li>
          <li><a href="#" class="hover:underline">Air conditioning</a></li>
        </ul>
      </div>

      <!-- 3️⃣ Support -->
      <div>
        <h3 class="font-semibold text-lg mb-3 tracking-wide">Support</h3>
        <ul class="space-y-2">
          <li><a href="#" class="hover:underline">Chat with Us</a></li>
          <li><a href="#" class="hover:underline">Product Support</a></li>
          <li><a href="#" class="hover:underline">Contact Us</a></li>
          <li><a href="#" class="hover:underline">Give Feedback</a></li>
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
        <ul class="space-y-2">
        <li >
            <a href="#" target="_blank" class="flex gap-1 hover:underline items-center">
            Instagram
            <span>
                <svg class="group-hover:fill-white -rotate-45 fill-current" width="15" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M25.3012 15.2813L15.3322 5.00068L16.3641 4L28.0005 16L16.3641 28L15.3322 26.9993L25.3012 16.7187H4V15.2813H25.3012Z"></path>
                </svg>
            </span>
            </a>
        </li>
        <li >
            <a href="#" target="_blank" class="flex gap-1 hover:underline items-center">
            facebook
            <span>
                <svg class="group-hover:fill-white -rotate-45 fill-current" width="15" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M25.3012 15.2813L15.3322 5.00068L16.3641 4L28.0005 16L16.3641 28L15.3322 26.9993L25.3012 16.7187H4V15.2813H25.3012Z"></path>
                </svg>
            </span>
            </a>
        </li>
        <li >
            <a href="#" target="_blank" class="flex gap-1 hover:underline items-center">
            LinkedIn
            <span>
                <svg class="group-hover:fill-white -rotate-45 fill-current" width="15" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M25.3012 15.2813L15.3322 5.00068L16.3641 4L28.0005 16L16.3641 28L15.3322 26.9993L25.3012 16.7187H4V15.2813H25.3012Z"></path>
                </svg>
            </span>
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
        <a href="#" class="hover:underline">Terms and Conditions</a>
        <span class="hidden sm:inline-block">|</span>
        <a href="#" class="hover:underline">Privacy &amp; Policies</a>
      </nav>
    </div>
  </div>
</footer>
@include('layouts.partials.vendor_js')
