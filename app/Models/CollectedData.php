<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CollectedData extends Model
{
    use HasFactory;
    use HasUlids;

    public $timestamps = false;

    public function market(): BelongsTo
    {
        return $this->belongsTo(Market::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'collected_data_products',
            'collected_data_id',
            'product_id'
        );
    }
}
