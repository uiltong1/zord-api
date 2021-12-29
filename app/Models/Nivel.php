<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    use HasFactory;

    protected $table = 'niveis';
    protected $primaryKey = 'co_nivel';
    protected $fillable = [
        'nm_nivel'
    ];

    /**
     * Get all of the comments for the Nivel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function desenvolvedores()
    {
        return $this->hasMany(Desenvolvedor::class, 'co_nivel', 'co_nivel');
    }
}
