<!-- ======= Footer ======= -->
<footer class="border-t pt-10 pb-6 bg-white text-sm">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
          <li><a href="#" class="hover:underline">Company Info</a></li>
          <li><a href="#" class="hover:underline">Our Business</a></li>
          <li><a href="#" class="hover:underline">Brand Identity</a></li>
          <li><a href="#" class="hover:underline">Careers</a></li>
          <li><a href="#" class="hover:underline">Newsroom</a></li>
          <li><a href="#" class="hover:underline">Ethics</a></li>
        </ul>
      </div>

      <!-- 5️⃣ Sustainability -->
      <div>
        <h3 class="font-semibold text-lg mb-3 tracking-wide">Sustainability</h3>
        <ul class="space-y-2">
          <li><a href="#" class="hover:underline">Overview</a></li>
          <li><a href="#" class="hover:underline">Environment</a></li>
          <li><a href="#" class="hover:underline">Digital Responsibility</a></li>
          <li><a href="#" class="hover:underline">Security & Privacy</a></li>
          <li><a href="#" class="hover:underline">Accessibility</a></li>
          <li><a href="#" class="hover:underline">Labor & Human Rights</a></li>
          <li><a href="#" class="hover:underline">Diversity · Equity · Inclusion</a></li>
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
