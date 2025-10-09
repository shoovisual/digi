<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('promotions', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('name');
        });

        // Backfill slugs for existing promotions
        $promotions = DB::table('promotions')->select('id', 'name')->get();
        foreach ($promotions as $promo) {
            $base = Str::slug($promo->name);
            $slug = $base;
            $i = 1;
            while (DB::table('promotions')->where('slug', $slug)->exists()) {
                $slug = $base.'-'.$i;
                $i++;
            }
            DB::table('promotions')->where('id', $promo->id)->update(['slug' => $slug]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promotions', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};