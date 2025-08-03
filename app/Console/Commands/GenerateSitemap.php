<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/'))
            ->add(Url::create('/services'))
            ->add(Url::create('/contact'))
            ->add(Url::create('/about'))
            ->add(Url::create('/about-digi'))
            ->add(Url::create('/products'))
            ->add(Url::create('/products/{product}'))
            ->add(Url::create('/wishlist'))
            ->add(Url::create('/about-digi'));
    }
}
