<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'DIGI 55 Inches Smart – 4K UHD, WebOS, Dolby Audio, Frameless, Built-in Apps, Game Optimiser, 2Y Warranty (2025)',
            'slug' => 'smart-tv-55-inch-uhd',
            'image' => 'products/tvs/55/tv-01.png',
            'product_short' => 'DIGI TV 55 Frameless Smart TV',
            'serial' => 'HSDJAS6550B',
            'description' => 'Experience stunning 4K UHD resolution with vibrant colors and incredible detail.',
            'category_id' => Category::where('name', 'TVs')->first()->id,
            'specifications' => json_encode([
                'resolution' => '4K UHD',
                'screen_size' => '55 inches',
                'smart_features' => true,
                'hdmi_ports' => 3,
                'usb_ports' => 2,
            ]),
            'features' => json_encode([
                '4K UHD Resolution – Stunning clarity & lifelike details',
                'WebOS – Smooth and user-friendly interface',
                'Dolby Audio – Immersive cinematic sound',
                'Frameless Design – Sleek and modern look',
                'Built-in Apps – Netflix, YouTube, Prime Video, Disney+',
                'Game Optimiser – Enhanced gaming performance',
                '2-Year Warranty – Peace of mind guaranteed',
            ]),
            'product_images' => json_encode([
                'products/tvs/55/tv-01.png',
                'products/tvs/55/tv-02.png',
                'products/tvs/55/tv-03.png',
                'products/tvs/55/tv-04.png',
            ]),
        ]);

        Product::create([
            'name' => 'DIGI 43 Inches Smart – FHD Smart TV, Android OS, Wi-Fi, Frameless, Netflix & YouTube, 2Y Warranty (2025)',
            'slug' => 'smart-tv-43-inch-smart',
            'image' => 'products/tvs/43-smart/tv-02.png',
            'product_short' => 'DIGI TV 43 Frameless Smart TV',
            'serial' => 'HSDJAS4350B',
            'description' => 'Experience stunning High resolution with vibrant colors and incredible detail.',
            'category_id' => Category::where('name', 'TVs')->first()->id,
            'specifications' => json_encode([
                'resolution' => 'Full HD',
                'screen_size' => '43 inches',
                'smart_features' => true,
                'hdmi_ports' => 3,
                'usb_ports' => 2,
            ]),
            'features' => json_encode([
                '43” Smart TV – Smart, Sleek, and Powerful!',
                'FHD Resolution – Crisp and clear visuals',
                'Android OS – Smooth and user-friendly',
                'Wi-Fi Built-in – Stream seamlessly',
                'Frameless Design – Modern and stylish ',
                'Netflix & YouTube – Entertainment at your fingertips',
                '2-Year Warranty – Peace of mind',

            ]),
            'product_images' => json_encode([
                'products/tvs/43-smart/tv-02.png',
                'products/tvs/43-smart/tv-01.png',
                'products/tvs/43-smart/tv-03.png',
                'products/tvs/43-smart/tv-04.png',
            ]),
        ]);

        Product::create([
            'name' => 'DIGI 43 Inches – FHD LED, Frameless Design, Dynamic Contrast, Built-in Receiver, HDMI/USB, 2Y Warranty (2025)',
            'slug' => 'tv-43-inch-led',
            'image' => 'products/tvs/43-led/tv-04.png',
            'product_short' => 'DIGI TV 43 Frameless LED TV',
            'serial' => 'HBDJAS4340B',
            'description' => 'Experience stunning High resolution with vibrant colors and incredible detail.',
            'category_id' => Category::where('name', 'TVs')->first()->id,
            'specifications' => json_encode([
                'resolution' => 'Full HD',
                'screen_size' => '43 inches',
                'smart_features' => false,
                'hdmi_ports' => 3,
                'usb_ports' => 2,
            ]),
            'features' => json_encode([
                '43” LED TV – Stunning visuals and vibrant colors',
                'A+ Panel – Superior picture quality',
                'Frameless Design – Sleek and modern look',
                'Dynamic Contrast – Enhanced viewing experience',
                'Built-in Receiver – No need for external devices',
                'HDMI & USB – Multimedia connectivity',
                '2-Year Warranty – Peace of mind guaranteed',
            ]),
            'product_images' => json_encode([
                'products/tvs/43-led/tv-04.png',
                'products/tvs/43-led/tv-01.png',
                'products/tvs/43-led/tv-02.png',
                'products/tvs/43-led/tv-03.png',
            ]),
        ]);

        Product::create([
            'name' => 'DIGI 32 inches – HD LED, Frameless Design, AC/DC, Built-in Receiver, HDMI/USB, 2Y Warranty (2025)',
            'slug' => 'tv-32-inch-led',
            'image' => 'products/tvs/32/tv-03.png',
            'product_short' => 'DIGI TV 32 Frameless LED TV',
            'serial' => 'HBDJAS3240B',
            'description' => 'Experience stunning High resolution with vibrant colors and incredible detail.',
            'category_id' => Category::where('name', 'TVs')->first()->id,
            'specifications' => json_encode([
                'resolution' => 'HD',
                'screen_size' => '32 inches',
                'smart_features' => false,
                'hdmi_ports' => 3,
                'usb_ports' => 2,
            ]),
            'features' => json_encode([
                '32” LED TV – Stunning visuals and vibrant colors',
                'A+ Panel – Superior picture quality',
                'Frameless Design – Sleek and modern look',
                'AC & DC Supply – Versatile power options',
                'Built-in Receiver – No need for external devices',
                'HDMI & USB – Multimedia connectivity',
                '2-Year Warranty – Peace of mind guaranteed',
            ]),
            'product_images' => json_encode([
                'products/tvs/32/tv-03.png',
                'products/tvs/32/tv-01.png',
                'products/tvs/32/tv-02.png',
                'products/tvs/32/tv-04.png',
            ]),
        ]);

        // Washing Machine Start

        Product::create([
            'name' => 'DIGI Washing Machine 8kg – Twin Tub, High-Efficiency Motor, Durable Body, Elegant White, 2Y Warranty (2025)',
            'slug' => 'washing-machine-8kg',
            'product_short' => 'DIGI Washing Machine 8kg',
            'serial' => 'TTSKAB440W',
            'description' => 'Efficient and quiet washing machine with multiple programs for all fabric types.',
            'category_id' => Category::where('name', 'Washing Machine')->first()->id,
            'image' => 'products/washing-machine/wm-8.png',
            'specifications' => json_encode([
                'capacity' => '8 kg',
                'spin_speed' => '1400 RPM',
                'energy_rating' => 'A+++',
                'water_consumption' => '50 L per cycle',
            ]),
            'features' => json_encode([
                'Twin Tub Washing Machine',
                'High-efficiency motor',
                'Durable plastic body',
                'Elegant white design',
                '2-Year Warranty',
                'Wash Capacity : 8 kg',
                'Spin Capacity: 7 kg',
                'Dimension (W x D x H): 855 x 490 x 968',
            ]),
            'product_images' => json_encode([
                'products/washing-machine/wm-8.png',
                'products/washing-machine/wm-10.png',
            ]),
        ]);

        Product::create([
            'name' => 'DIGI Washing Machine 10kg – Twin Tub, High-Efficiency Motor, Durable Body, Elegant White, 2Y Warranty (2025)',
            'slug' => 'washing-machine-10kg',
            'product_short' => 'DIGI Washing Machine 10kg',
            'serial' => 'TTSKAB640W',
            'description' => 'Efficient and quiet washing machine with multiple programs for all fabric types.',
            'category_id' => Category::where('name', 'Washing Machine')->first()->id,
            'image' => 'products/washing-machine/wm-10.png',
            'specifications' => json_encode([
                'capacity' => '10 kg',
                'spin_speed' => '1400 RPM',
                'energy_rating' => 'A+++',
                'water_consumption' => '60 L per cycle',
            ]),
            'features' => json_encode([
                'Twin Tub Washing Machine',
                'High-efficiency motor',
                'Durable plastic body',
                'Elegant white design',
                '2-Year Warranty',
                'Wash Capacity : 10 kg',
                'Spin Capacity: 7 kg',
                'Dimension (W x D x H): 876 x 510 x 1017',
            ]),
            'product_images' => json_encode([
                'products/washing-machine/wm-10.png',
                'products/washing-machine/wm-8.png',
            ]),
        ]);

        Product::create([
            'name' => 'DIGI Washing Machine 12kg – Twin Tub, High-Efficiency Motor, Durable Body, Elegant White, 2Y Warranty (2025)',
            'slug' => 'washing-machine-12kg',
            'product_short' => 'DIGI Washing Machine 12kg',
            'serial' => 'TTSKAB740W',
            'description' => 'Efficient and quiet washing machine with multiple programs for all fabric types.',
            'category_id' => Category::where('name', 'Washing Machine')->first()->id,
            'image' => 'products/washing-machine/wm-12.png',
            'specifications' => json_encode([
                'capacity' => '12 kg',
                'spin_speed' => '1400 RPM',
                'energy_rating' => 'A+++',
                'water_consumption' => '70 L per cycle',
            ]),
            'features' => json_encode([
                'Twin Tub Washing Machine',
                'High-efficiency motor',
                'Durable plastic body',
                'Elegant white design',
                '2-Year Warranty',
                'Wash Capacity : 12 kg',
                'Spin Capacity: 7 kg',
                'Dimension (W x D x H): 947 x 537 x 1067',
            ]),
            'product_images' => json_encode([
                'products/washing-machine/wm-12.png',
                'products/washing-machine/wm-8.png',
            ]),
        ]);

        // Fridges start

        Product::create([
            'name' => 'DIGI 126 Liters Refrigerator – Fast Cooling, Tempered Shelves, Lock & LED, 5Y Compressor (2025)',
            'slug' => 'refrigerator-126l',
            'product_short' => 'DIGI Refrigerator 126L',
            'serial' => 'TD2HAB126S',
            'description' => 'Modern refrigerator with smart features, ample storage, and energy efficiency.',
            'category_id' => Category::where('name', 'Refrigerators')->first()->id,
            'image' => 'products/fridges/DG-RF-TD2HAB126S/close.png',
            'specifications' => json_encode([
                'capacity' => '128 L',
                'energy_rating' => 'A+',
            ]),
            'features' => json_encode([
                'Top Freezer',
                'Frost Type',
                'Fast Cooling ',
                'Longer Freshness',
                'Inox Color',
                'Strong Tempered Glass Shelves ',
                '5-Year Compressor Warranty ',
                'Gross Capacity: 128 L',
                'Net Capacity : 126 L',
                'Lock & Key',
                'LED Light',
                'Dimension (W x D x H): 480 x 510 x 1130',
            ]),
            'product_images' => json_encode([
                'products/fridges/DG-RF-TD2HAB126S/close.png',
                'products/fridges/DG-RF-TD2HAB126S/open.png',
            ]),
        ]);

        Product::create([
            'name' => 'DIGI Fridge 151 Liters – Fast Cooling, Tempered Glass Shelves, LED Light, Lock & Key, 5Y Compressor Warranty (2025)',
            'slug' => 'refrigerator-151l',
            'product_short' => 'DIGI Refrigerator 151L',
            'serial' => 'TD2HAB222S',
            'description' => 'Modern refrigerator with smart features, ample storage, and energy efficiency.',
            'category_id' => Category::where('name', 'Refrigerators')->first()->id,
            'image' => 'products/fridges/DG-RF-TD2HAB222S/close.png',
            'specifications' => json_encode([
                'capacity' => '151 L',
                'energy_rating' => 'A+',
            ]),
            'features' => json_encode([
                'Top Freezer',
                'Frost Type',
                'Fast Cooling ',
                'Longer Freshness',
                'Inox Color',
                'Strong Tempered Glass Shelves ',
                '5-Year Compressor Warranty ',
                'Gross Capacity: 159 L',
                'Net Capacity : 151 L',
                'Lock & Key',
                'LED Light',
                'Dimension (W x D x H): 500 x 580 x 1220',

            ]),
            'product_images' => json_encode([
                'products/fridges/DG-RF-TD2HAB222S/close.png',
                'products/fridges/DG-RF-TD2HAB222S/open.png',
            ]),
        ]);

        Product::create([
            'name' => 'DIGI Fridge 187 Liters – Fast Cooling, Tempered Glass Shelves, LED Light, Lock & Key, 5Y Compressor Warranty (2025)',
            'slug' => 'refrigerator-182l',
            'product_short' => 'DIGI Refrigerator 182L',
            'serial' => 'TD2HAB228S',
            'description' => 'Modern refrigerator with smart features, ample storage, and energy efficiency.',
            'category_id' => Category::where('name', 'Refrigerators')->first()->id,
            'image' => 'products/fridges/DG-RF-TD2HAB228S/close.png',
            'specifications' => json_encode([
                'capacity' => '182 L',
                'energy_rating' => 'A+',
            ]),
            'features' => json_encode([
                'Top Freezer',
                'Frost Type',
                'Fast Cooling ',
                'Longer Freshness',
                'Inox Color',
                'Strong Tempered Glass Shelves ',
                '5-Year Compressor Warranty ',
                'Gross Capacity: 187 L',
                'Net Capacity : 182 L',
                'Tempered Shelves Glass',
                'Lock & Key',
                'LED Light',
                'Dimension (W x D x H): 500 x 580 x 1370',
            ]),
            'product_images' => json_encode([
                'products/fridges/DG-RF-TD2HAB228S/close.png',
                'products/fridges/DG-RF-TD2HAB228S/open.png',
            ]),
        ]);

        Product::create([
            'name' => 'DIGI Fridge 205 Liters – Fast Cooling, Tempered Glass Shelves, LED Light, Lock & Key, 5Y Compressor Warranty (2025)',
            'slug' => 'refrigerator-205l',
            'product_short' => 'DIGI Refrigerator 205L',
            'serial' => 'TD2HAB322S',
            'description' => 'Modern refrigerator with smart features, ample storage, and energy efficiency.',
            'category_id' => Category::where('name', 'Refrigerators')->first()->id,
            'image' => 'products/fridges/DG-RF-TD2HAB322S/close.png',
            'specifications' => json_encode([
                'capacity' => '205 L',
                'energy_rating' => 'A+',
            ]),
            'features' => json_encode([
                'Top Freezer',
                'Frost Type',
                'Fast Cooling ',
                'Longer Freshness',
                'Inox Color',
                'Strong Tempered Glass Shelves ',
                '5-Year Compressor Warranty ',
                'Gross Capacity: 208 L',
                'Net Capacity : 205 L',
                'Tempered Shelves Glass',
                'Lock & Key',
                'LED Light',
                'Dimension (W x D x H): 550 x 560 x 1430',
            ]),
            'product_images' => json_encode([
                'products/fridges/DG-RF-TD2HAB322S/close.png',
                'products/fridges/DG-RF-TD2HAB322S/open.png',
            ]),
        ]);

        Product::create([
            'name' => 'DIGI Fridge 248 Liters – Fast Cooling, Tempered Glass Shelves, LED Light, Lock & Key, 5Y Compressor Warranty (2025)',
            'slug' => 'refrigerator-248l',
            'product_short' => 'DIGI Refrigerator 248L',
            'serial' => 'TD2HAB412S',
            'description' => 'Modern refrigerator with smart features, ample storage, and energy efficiency.',
            'category_id' => Category::where('name', 'Refrigerators')->first()->id,
            'image' => 'products/fridges/DG-RF-TD2HAB412S/close.png',
            'specifications' => json_encode([
                'capacity' => '248 L',
                'energy_rating' => 'A+',
            ]),
            'features' => json_encode([
                'Top Freezer',
                'Frost Type',
                'Fast Cooling ',
                'Longer Freshness',
                'Inox Color',
                'Strong Tempered Glass Shelves ',
                '5-Year Compressor Warranty ',
                'Gross Capacity: 252 L',
                'Net Capacity : 248 L',
                'Tempered Shelves Glass',
                'Lock & Key',
                'LED Light',
                'Dimension (W x D x H): 550 x 580 x 1660',
            ]),
            'product_images' => json_encode([
                'products/fridges/DG-RF-TD2HAB412S/close.png',
                'products/fridges/DG-RF-TD2HAB412S/open.png',
            ]),
        ]);

        Product::create([
            'name' => 'DIGI Fridge 204 Liters – Bottom Freezer, Fast Cooling, Tempered Glass Shelves, LED Light, Lock & Key, 5Y Compressor Warranty (2025)',
            'slug' => 'refrigerator-204l',
            'product_short' => 'DIGI Refrigerator 204L',
            'serial' => 'CF2HAB374S',
            'description' => 'Modern refrigerator with smart features, ample storage, and energy efficiency.',
            'category_id' => Category::where('name', 'Refrigerators')->first()->id,
            'image' => 'products/fridges/DG-RF-CF2HAB374S/close.png',
            'specifications' => json_encode([
                'capacity' => '204 L',
                'energy_rating' => 'A+',
            ]),
            'features' => json_encode([
                'Bottom Freezer',
                'Frost Type',
                'Fast Cooling ',
                'Longer Freshness',
                'Inox Color',
                'Strong Tempered Glass Shelves ',
                '5-Year Compressor Warranty ',
                'Gross Capacity: 215 L',
                'Net Capacity : 204 L',
                'Tempered Shelves Glass',
                'Lock & Key',
                'LED Light',
                'Dimension (W x D x H): 550 x 570 x 1510',
            ]),
            'product_images' => json_encode([
                'products/fridges/DG-RF-CF2HAB374S/close.png',
                'products/fridges/DG-RF-CF2HAB374S/open.png',
            ]),
        ]);


        // Freezer Start

        Product::create([
            'name' => 'DIGI 200L Freezer with Sliding Glass Top, Fast Freeze, LED Light, Lock & Key, 5Y Warranty (2025)',
            'slug' => 'digi-200l-freezer',
            'product_short' => 'DIGI 200L Freezer',
            'serial' => 'FG2HAB374S',
            'description' => 'Modern freezer with smart features, ample storage, and energy efficiency.',
            'category_id' => Category::where('name', 'Freezers')->first()->id,
            'image' => 'products/freezers/DG-FZ-CD1HAB315S/closed.png',
            'specifications' => json_encode([
                'capacity' => '200 L',
                'energy_rating' => 'A+',
            ]),
            'features' => json_encode([
                'Chest Freezer',
                'Sliding glass top',
                'Fast freezing',
                'Dual handles',
                '5 Year Warranty',
                'Frost Type',
                'Inox Color',
                'Net Capacity : 200 L',
                'Aluminum Cavity',
                '1 Basket',
                'LED Light',
                'Lock & Key',
                'Dimension (W x D x H): 905 x 545 x 845',
            ]),
            'product_images' => json_encode([
                'products/freezers/DG-FZ-CD1HAB315S/closed.png',
                'products/freezers/DG-FZ-CD1HAB315S/open.png',
            ]),
        ]);

        Product::create([
            'name' => 'DIGI Freezer 145L With Glass Top, Fast Freeze, LED, Lock & Key, 5Y Warranty (2025)',
            'slug' => 'digi-145l-freezer',
            'product_short' => 'DIGI 145L Freezer',
            'serial' => 'DG-FZ-CD1HAB215S',
            'description' => 'Modern freezer with smart features, ample storage, and energy efficiency.',
            'category_id' => Category::where('name', 'Freezers')->first()->id,
            'image' => 'products/freezers/DG-FZ-CD1HAB215S/closed.png',
            'specifications' => json_encode([
                'capacity' => '145 L',
                'energy_rating' => 'A+',
            ]),
            'features' => json_encode([
                'Chest Freezer',
                'Sliding glass top',
                'Fast freezing',
                'Dual handles',
                '5 Year Warranty',
                'Frost Type',
                'Inox Color',
                'Net Capacity : 145 L',
                'Aluminum Cavity',
                '1 Basket',
                'LED Light',
                'Lock & Key',
                'Dimension (W x D x H): 705 x 545 x 845',
            ]),
            'product_images' => json_encode([
                'products/freezers/DG-FZ-CD1HAB215S/closed.png',
                'products/freezers/DG-FZ-CD1HAB215S/open.png',
            ]),
        ]);

        Product::create([
            'name' => 'DIGI Freezer 100L With, Fast Freeze, LED Light, Lock & Key, 5Y Warranty (2025)',
            'slug' => 'digi-100l-freezer',
            'product_short' => 'DIGI 100L Freezer',
            'serial' => 'DG-RF-TD2HAB126S',
            'description' => 'Modern freezer with smart features, ample storage, and energy efficiency.',
            'category_id' => Category::where('name', 'Freezers')->first()->id,
            'image' => 'products/freezers/DG-RF-TD2HAB126S/closed.png',
            'specifications' => json_encode([
                'capacity' => '100 L',
                'energy_rating' => 'A+',
            ]),
            'features' => json_encode([
                'Chest Freezer',
                'Fast freezing',
                'Dual handles',
                '5 Year Warranty',
                'Frost Type',
                'Inox Color',
                'Net Capacity : 100 L',
                'Aluminum Cavity',
                '1 Basket',
                'LED Light',
                'Lock & Key',
                'Dimension (W x D x H): 545 x 550 x 845',
            ]),
            'product_images' => json_encode([
                'products/freezers/DG-RF-TD2HAB126S/closed.png',
                'products/freezers/DG-RF-TD2HAB126S/open.png',
            ]),
        ]);

        Product::create([
            'name' => 'DIGI InverterCool Pro 18K – Smart Temp Control, Hidden Display, 3m Pipe Kit, 2025',
            'slug' => 'invertercool-pro-18k',
            'product_short' => 'DIGI Smart Air Conditioner 18,000 BTU',
            'serial' => 'AC1.5T123456',
            'description' => 'Energy-efficient air conditioner with smart features for optimal cooling.',
            'category_id' => Category::where('name', 'Air Conditioner')->first()->id,
            'image' => 'products/ac/1.png',
            'specifications' => json_encode([
                'capacity' => '18,000 BTU',
                'energy_rating' => 'A+',
            ]),
            'features' => json_encode([
                '18 K BTU:',
                'Inverter Compressor™',
                'Warranty on compressor',
                'Energy saving ',
                'Faster Cooling',
                'Low noise level',
                'Precise temperature control',
                'Simple and Modern Design with Hidden display',
                '3m refrigerant pipes +  electric cable',
                'W:910   D:294   H:206'
            ]),
            'product_images' => json_encode([
                'products/ac/1.png',
                'products/ac/2.png',
                'products/ac/3.png',
            ]),
        ]);

        Product::create([
            'name' => 'DIGI InverterCool Pro 12K – Smart Temp Control, Hidden Display, 3m Pipe Kit, 2025',
            'slug' => 'invertercool-pro-12k',
            'product_short' => 'DIGI Smart Air Conditioner 12,000 BTU',
            'serial' => 'IR4TABS1250W',
            'description' => 'Energy-efficient air conditioner with smart features for optimal cooling.',
            'category_id' => Category::where('name', 'Air Conditioner')->first()->id,
            'image' => 'products/ac/4.png',
            'specifications' => json_encode([
                'capacity' => '12,000 BTU',
                'energy_rating' => 'A+',
            ]),
            'features' => json_encode([
                '12 K BTU:',
                'Inverter Compressor™',
                'Warranty on compressor',
                'Energy saving ',
                'Faster Cooling',
                'Low noise level',
                'Precise temperature control',
                'Simple and Modern Design with Hidden display',
                '3m refrigerant pipes +  electric cable',
                'W:777    D:250    H:201 ',
            ]),
            'product_images' => json_encode([
                'products/ac/4.png',
                'products/ac/2.png',
                'products/ac/3.png',
            ]),
        ]);

        // Gas Cooker Start

        Product::create([
            'name' => 'DIGI Cooker 50x50 Black – 3 Gas + 1 Hot Plate, Electric Oven, Thermostat, Push Ignition, 2Y Warranty (2025)',
            'slug' => 'gas-cooker-50x50-black',
            'product_short' => 'DIGI Smart Gas Cooker 4 Burner (Black)',
            'serial' => 'EMKABF550B',
            'description' => 'High-efficiency gas cooker with 4 burners and smart features.',
            'category_id' => Category::where('name', 'Gas Cookers')->first()->id,
            'image' => 'products/gas-cooker/DIGI-DG-GC-EMKABF550B-50x50_siyah.png',
            'specifications' => json_encode([
                'burners' => '3 Gas + 1 Hot Plate',
                'oven_type' => 'Electric',
                'push_ignition' => 'Yes',
            ]),
            'features' => json_encode([
                'Freestand Gas Cooker 50 cm x 50 cm Black Color',
                '3 Gas Burner + 1 Hot Plate (1000 W)',
                'Electric Oven',
                'Oven Thermostat',
                'Mechanical Timer',
                'Double Removable Glass Oven Door',
                'LPG GAS',
                '1 Tray',
                '1 Grid',
                'Push Ignition',
                'Oven Lamp',
                'Metal Cover',
                '2-Year Warranty',
            ]),

        ]);

        Product::create([
            'name' => 'DIGI Cooker 50x50 Steel – 3 Gas + 1 Hot Plate, Electric Oven, Thermostat, Glass Cover, 2Y Warranty (2025)',
            'slug' => 'gas-cooker-50x50-steel',
            'product_short' => 'DIGI Smart Gas Cooker 4 Burner (Steel)',
            'serial' => 'EMKABF552S',
            'description' => 'High-efficiency gas cooker with 4 burners and smart features.',
            'category_id' => Category::where('name', 'Gas Cookers')->first()->id,
            'image' => 'products/gas-cooker/DIGI-DG-GC-EMKABF552S-50x50_inox.png',
            'specifications' => json_encode([
                'burners' => '3 Gas + 1 Hot Plate',
                'oven_type' => 'Electric',
                'push_ignition' => 'Yes',
            ]),
            'features' => json_encode([
                'Freestand Gas Cooker',
                '50 cm x 50 cm Steel Color',
                '3 Gas Burner + 1 Hot Plate (1000 W)',
                'Electric Oven',
                'Oven Thermostat',
                'Mechanical Timer',
                'Double Removable Glass Oven Door',
                'LPG GAS',
                '1 Tray',
                '1 Grid',
                'Push Ignition',
                'Oven Lamp',
                'Glass Cover',
                '2-Year Warranty',
            ]),

        ]);

        Product::create([
            'name' => 'DIGI Cooker 60x60 Black – 3 Gas + 1 Hot Plate, Electric Oven, Thermostat, Metal Cover, 2Y Warranty (2025)',
            'slug' => 'gas-cooker-60x60-black',
            'product_short' => 'DIGI Smart Gas Cooker 4 Burner (Black)',
            'serial' => 'EMKABF651B',
            'description' => 'High-efficiency gas cooker with 4 burners and smart features.',
            'category_id' => Category::where('name', 'Gas Cookers')->first()->id,
            'image' => 'products/gas-cooker/DIGI-DG-GC-EMKABF651B-60x60_siyah.png',
            'specifications' => json_encode([
                'burners' => '3 Gas + 1 Hot Plate',
                'oven_type' => 'Electric',
                'push_ignition' => 'Yes',
            ]),
            'features' => json_encode([
                'Freestand Gas Cooker',
                '60 cm x 60 cm Black Color',
                '3 Gas Burner + 1 Hot Plate (1000 W)',
                'Electric Oven',
                'Oven Thermostat',
                'Mechanical Timer',
                'Double Removable Glass Oven Door',
                'LPG GAS',
                '1 Tray',
                '1 Grid',
                'Push Ignition',
                'Oven Lamp',
                'Metal Cover',
                '2-Year Warranty',
            ]),
        ]);

        Product::create([
            'name' => 'DIGI Cooker 60x60 Steel – 3 Gas + 1 Hot Plate, Electric Oven, Thermostat, Glass Cover, 2Y Warranty (2025)',
            'slug' => 'gas-cooker-60x60-steel',
            'product_short' => 'DIGI Smart Gas Cooker 4 Burner (Steel)',
            'serial' => 'EMKABF650S',
            'description' => 'High-efficiency gas cooker with 4 burners and smart features.',
            'category_id' => Category::where('name', 'Gas Cookers')->first()->id,
            'image' => 'products/gas-cooker/DIGI-DG-GC-EMKABF650S-60x60_inox.png',
            'specifications' => json_encode([
                'burners' => '3 Gas + 1 Hot Plate',
                'oven_type' => 'Electric',
                'push_ignition' => 'Yes',
            ]),
            'features' => json_encode([
                'Freestand Gas Cooker',
                '60 cm x 60 cm Steel Color',
                '3 Gas Burner + 1 Hot Plate (1000 W)',
                'Electric Oven',
                'Oven Thermostat',
                'Mechanical Timer',
                'Double Removable Glass Oven Door',
                'LPG GAS',
                '1 Tray',
                '1 Grid',
                'Push Ignition',
                'Oven Lamp',
                'Glass Cover',
                '2-Year Warranty',
            ]),
        ]);
    }
}
