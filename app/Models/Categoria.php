<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Categoria extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    use HasFactory;
    protected $guarded = ['id'];

    public function salas()
    {
        return $this->hasMany(Sala::class);
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'categoria_user')->withTimestamps();
    }

}
