<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    
    public function persona(){
        return $this->belongsTo(Persona::class, 'persona_id');
    }

    public function cotizacione(){
        return $this->hasMany(Cotizacione::class, 'cliente_id');
    }

    protected $fillable = ['persona_id'];
}
