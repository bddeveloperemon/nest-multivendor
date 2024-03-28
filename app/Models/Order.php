<?php

namespace App\Models;

use App\Models\User;
use App\Models\ShipState;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
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
    public function state(): BelongsTo
    {
        return $this->belongsTo(ShipState::class,'state_id','id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
