<?php

namespace App;

use App\Observers\ContractObserver;
use App\Scopes\CompanyScope;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class Service extends Authenticatable
{
   

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'vendor_category';
    protected $fillable = [
        'vendor_category_id',
        'category_name',
        'category_image',
        'ui_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
