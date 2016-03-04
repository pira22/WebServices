<?php

/**
 * Created by PhpStorm.
 * User: Pira
 * Date: 31/12/2015
 * Time: 23:02
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class Panier extends Eloquent
{
    protected $primaryKey = 'pa_id';
    protected $table = 'panier';
    public $timestamps = false;

    public function Bid(){
        return $this->belongsTo('Bid','pro_id');
    }

}