<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finished extends Model
{
    protected $table = 'Finished';
    use HasFactory;

    public function finished()
    {
        return $this->hasMany('finished');
    }
}
