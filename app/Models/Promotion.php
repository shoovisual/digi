<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'cover',
        'start_date',
        'end_date',
        'status',
        'user_id',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    /**
     * Products included in the promotion.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'promotion_product')
            ->withTimestamps();
    }

    /**
     * Use slug for route model binding.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Computed status label based on start/end dates.
     */
    public function getStatusLabelAttribute(): string
    {
        $now = Carbon::now();
        if ($this->start_date && $now->lt($this->start_date)) {
            return 'Scheduled';
        }
        if ($this->end_date && $now->gt($this->end_date)) {
            return 'Ended';
        }
        return 'Active';
    }
}