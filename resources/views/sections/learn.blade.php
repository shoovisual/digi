@php
    $learning = [
            [
                'title' => 'Enjoy the Best in Every Pixel',
                'subtitle' => 'Introducing Our UHD Smart TV',
                'description' => 'Presenting Our 43” UHD Smart TV with WebOS inside',
                'image' => 'img/tv-cover.png',
            ],
            [
                'title' => 'Wash and Rinse with Ease',
                'subtitle' => ' Our New 12kg Washing Machine',
                'description' => 'Presenting Our 12kg Washing Machine with advanced features',
                'image' => 'img/digi-washing-machine-featured.jpg',
            ],
            [
                'title' => 'Eat Fresh, Live Fresh',
                'subtitle' => 'Introducing Our 120L fridge',
                'description' => 'Presenting Our 120L fridge with advanced cooling technology',
                'image' => 'img/digi-fridge-featured.jpg',
            ],
            [
                'title' => 'Cook with Precision',
                'subtitle' => 'Introducing Our Gas Cooker',
                'description' => 'Presenting Our Gas Cooker with advanced features',
                'image' => 'img/tv-cover.png',
            ],
        ];
@endphp
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4">
    <div class="grid md:grid-cols-4 gap-4">

       @foreach($learning as $lesson)
      <div class="bg-white overflow-hidden">
        <img src="{{ asset($lesson['image']) }}" alt="{{ $lesson['title'] }}" class="w-full rounded-2xl h-60 object-cover">
        <div class="py-6">
          <p class="text-sm font-medium">{{ $lesson['subtitle'] }}</p>
          <h3 class="text-xl font-bold mt-2">{{ $lesson['title'] }}</h3>
          <p class="text-gray-600 font-medium mt-2">{{ $lesson['description'] }}</p>
          <button class="mt-4 px-5 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-full text-sm font-medium">
            Watch Video
          </button>
        </div>
      </div>
      @endforeach

    </div>
  </div>
</section>
