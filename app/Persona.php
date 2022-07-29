<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'persona';
    protected $primaryKey = 'id';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ci',
        'nombre',
        'apellido',
        'fecha_nac',
        'image',
        'dirrecion',
        'telefono',
        'celular',
        'email',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
    /* public function rol()
{
$personal = DB::table('rol')->select('rol.rolId')
->where('rol.personaId', json_decode(auth()->user()->personaId))
->get();
foreach ($personal as $value) {
switch ($value) {
case 'Administrador':
return 'Administrador';
break;
case 'Personal':
return 'Personal';
break;
case 'Invitado':
return 'Invitado';
break;
default:
break;
}
}
} */
}
