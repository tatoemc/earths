<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Earth;


class Square extends Model
{
    use HasFactory;
    protected $dates = ['deleted_at'];
    use SoftDeletes;
    protected $guarded = [];


    public function earths()
    {
         return $this->hasMany(Earth::class);
    } 



    

}
