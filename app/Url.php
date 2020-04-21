<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $table = 'urls';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['url', 'token', 'lifetime'];

    public function statistic()
    {
        return $this->hasMany('App\Statistic', 'url_id', 'id');
    }
}
