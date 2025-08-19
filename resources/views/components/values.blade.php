<div class="grid grid-col-1 md:grid-cols-4 gap-8">

    @php
        $values = [
            ['title' => 'Integrity',
                'text'  => 'Conducting business with ethics, respect and meeting commitments.',
                'image' => 'img/values/integrity.png'
            ],
            ['title' => 'Value Consciousness & Quality',
                'text'  => 'Optimising resources while adhering to international quality standards.',
                'image' => 'img/values/quality-focus.png'
            ],
            ['title' => 'Customer Focus',
                'text'  => 'Being obsessed with understanding and exceeding customer needs.',
                'image' => 'img/values/customer-focus.png'
            ],
            ['title' => 'Moving Forward',
                'text'  => 'Leading markets where we operate and continuously growing.',
                'image' => 'img/values/moving-forward.png'
            ],
            ['title' => 'Professionalism',
                'text'  => 'We accomplish more working together across the organisation.',
                'image' => 'img/values/professionalism.png'
            ],
            ['title' => 'Employee Focus',
                'text'  => 'Attracting, developing and retaining top talent through empowerment.',
                'image' => 'img/values/employee-focus.png'
            ],
            ['title' => 'Teamwork',
                'text'  => 'We accomplish more working together across the organisation.',
                'image' => 'img/values/teamwork.png'
            ],
        ];
    @endphp

    @foreach ($values as $v)
        <div class=" bg-gray-100 border border-digi-orange/20 font-medium rounded-lg group">
            <img src="{{ asset($v['image']) }}" width="100%" alt="{{ 'DIGI' . ' ' . $v['title'] }}" class="rounded-xl group-hover:scale-105 transition-all">
        </div>
    @endforeach
</div>
