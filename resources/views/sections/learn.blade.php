<section class="py-16 bg-white">
  <div class="container mx-auto px-4">
    <div class="grid md:grid-cols-3 gap-8">

       @foreach($learning as $lesson)
      <div class="bg-white rounded-2xl shadow-md overflow-hidden text-center">
        <img src="{{ asset($lesson['image']) }}" alt="{{ $lesson['title'] }}" class="w-full h-60 object-cover">
        <div class="p-6">
          <p class="text-sm text-gray-500">{{ $lesson['subtitle'] }}</p>
          <h3 class="text-xl font-bold mt-2">{{ $lesson['title'] }}</h3>
          <p class="text-gray-600 mt-2">{{ $lesson['description'] }}</p>
          <button class="mt-4 px-5 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-full text-sm font-medium">
            Watch Video
          </button>
        </div>
      </div>
      @endforeach

    </div>
  </div>
</section>
