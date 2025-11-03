<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    protected $fillable = ['menu_id', 'quantity','user_id'];

    public function menu()
    {
        return $this->belongsTo(menu::class);
    }

    public function user()
    {
        return $this->belongsTo(Users::class);
    }
}
