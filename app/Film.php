<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    //
    protected $primaryKey = 'film_id';
    protected $table = 'film';
    public $timestamps = false;

    public function actor()
    {
        return $this->belongsToMany(Actor::class, 'film_actor', 'film_id', 'actor_id');

    }

    public function filmText()
    {
        return $this->belongsTo(FilmText::class, 'film_id', 'film_id');
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'film_id', 'film_id');
    }
}
