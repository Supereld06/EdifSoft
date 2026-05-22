<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AperturaExpensa extends Model
{
    use HasFactory;

    protected $fillable = [
        'mes',
        'gestion',
        'saldo_inicial',
        'edificio_id',
    ];

    public function edificio()
    {
        return $this->belongsTo(Edificio::class);
    }

    public function expensas()
    {
        return $this->hasMany(Expensa::class);
    }
   // public function expensas()
   // {
   //     return $this->hasMany(Expensa::class);
   // }
}