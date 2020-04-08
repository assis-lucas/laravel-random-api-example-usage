<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
	protected $fillable = ['name', 'car_id', 'data_hora'];
	protected $dates = ['data_hora'];
	public $timestamps = false;
}
