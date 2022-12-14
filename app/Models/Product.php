<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function tipo(){
        return $this->belongsTo("App\Models\tipo_produto","id", "tipo_produto_id");
    } 
}
