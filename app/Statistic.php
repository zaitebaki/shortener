<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $table = 'statistic';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['date_time', 'country', 'city', 'user_agent'];
}
