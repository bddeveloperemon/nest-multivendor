<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // User Active Now 
    public function UserOnline(){
        return Cache::has('user-is-online' . $this->id);
    }

    // Get Permissions Group
    public static function getPermissionsGroup()
    {
        $permission_group = DB::table('permissions')->select('group_name')->orderBy('group_name','asc')->groupBy('group_name')->get();
        return $permission_group;
    }

    // Get Permissions By Group Name
    public static function getPermissionByGroupName($group_name)
    {
        $permissions = DB::table('permissions')
                    ->where('group_name',$group_name)
                    ->select('id','name')
                    ->get();
        return $permissions;
    }
}
