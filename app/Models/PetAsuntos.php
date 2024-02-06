<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PetActividades;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PetAsuntos extends Model
{
    //
    protected $table = 'pet_asuntos';

    protected $fillable = [
        'id', 'asunto', 'userid_created', 'userid_updated',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Get all of the actividades for the PetActividades
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function actividades(): HasMany
    {
        return $this->hasMany(PetActividades::class, 'asunto_id', 'id');
    }
}
