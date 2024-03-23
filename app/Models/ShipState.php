<?php

namespace App\Models;

use App\Models\ShipDistrict;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShipState extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $guarded = [];
    public function division(): BelongsTo
    {
        return $this->belongsTo(ShipDivision::class,'division_id','id');
    }
    public function district(): BelongsTo
    {
        return $this->belongsTo(ShipDistrict::class,'district_id','id');
    }
}
