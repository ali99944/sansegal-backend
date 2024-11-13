<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'name',
        'address',
        'phone_number',
        'other_phone_number',
        'country',
        'city'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
