<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consecutivo extends Model
{
    protected $table= 'consecutivo';
    public $timestamps=false;
    protected $fillable = ['numero'];

}