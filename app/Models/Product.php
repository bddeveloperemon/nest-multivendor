<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(User::class,'vendor_id','id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class,'brand_id','id');
    }

    public function sub_category(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class,'subcategory_id','id');
    }
}
