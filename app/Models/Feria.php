<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Feria extends Model
{
    protected $fillable = ['nombre', 'fecha_evento', 'lugar', 'descripcion'];

    public function emprendedores(): BelongsToMany
    {
        return $this->belongsToMany(Emprendedor::class);
    }
}
