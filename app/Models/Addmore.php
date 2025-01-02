<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Auth;

class Addmore extends BaseModel
{
    protected $table='addmore';
    use HasFactory;
    protected $fillable = [
         'bank_id', 'location', 'mobile', 'nominee', 'document'
    ];
}
