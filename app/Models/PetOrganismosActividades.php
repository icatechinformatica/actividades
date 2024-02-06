<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\PetActividades;

class PetOrganismosActividades extends Model
{
    //
    protected $table = 'pet_organismos_actividades';

    protected $fillable = [
        'id', 'actividad_id', 'id_organo', 'options', 'observacion', 'userid_created', 'userid_updated'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Get the user that owns the PetOrganismosActividades
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function actividad(): BelongsTo
    {
        return $this->belongsTo(PetActividades::class, 'actividad_id', 'id');
    }
}
