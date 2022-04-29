<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Square;

class Earth extends Model
{
    use HasFactory;
    protected $dates = ['deleted_at'];
    use SoftDeletes;
    protected $guarded = [];



    public function square()
    {
        return $this->belongsTo(Square::class);
    }

    
}
