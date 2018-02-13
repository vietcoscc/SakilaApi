<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmText extends Model
{
    //
    protected $primaryKey = 'film_id';
    protected $table = 'film_text';
    public $timestamps = false;
    
}
