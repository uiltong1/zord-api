<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desenvolvedor extends Model
{
    use HasFactory;

    protected $table = 'desenvolvedores';
    protected $primaryKey = 'co_desenvolvedor';
    protected $fillable = [
        'co_desenvolvedor',
        'nm_desenvolvedor',
        'ds_sexo',
        'dt_nascimento',
        'nu_idade',
        'ds_hobby',
        'co_nivel',
    ];

    /**
     * Get the user associated with the Desenvolvedor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function nivel()
    {
        return $this->hasOne(Nivel::class, 'co_nivel', 'co_nivel');
    }
}
