<?php

namespace App;

use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class OrdersDetails extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'idproducto', 'idorder','codigo','descripcion','cantidad','precio','categoria','modelo','color',
    ];
}
