<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PetAsuntos;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\PetOrganismosActividades;

class PetActividades extends Model
{
    //
    protected $table = 'pet_actividades';

    protected $fillable = [
        'id', 'asunto_id', 'actividad', 'userid_created', 'userid_updated',
    ];

    protected $hidden = ['created_at', 'updated_at'];


    /**
     * Get the user that owns the PetAsuntos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function asunto(): BelongsTo
    {
        return $this->belongsTo(PetAsuntos::class, 'asunto_id', 'id');
    }

    /**
     * Get all of the comments for the PetActividades
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function organismo(): HasMany
    {
        return $this->hasMany(PetOrganismosActividades::class, 'actividad_id', 'id');
    }
}
