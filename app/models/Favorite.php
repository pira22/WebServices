<?php

/**
 * Created by PhpStorm.
 * User: Pira
 * Date: 26/01/2016
 * Time: 00:38
 */
use Illuminate\Database\Eloquent\Model as Eloquent;
class favorite extends Eloquent
{
    protected $primaryKey = 'f_id';
    protected $table = 'favorite';
    public $timestamps = true;
    public function Product()
    {
        return $this->belongsTo('Product','p_id');
    }
    public function User()
    {
        return $this->belongsTo('User','u_id');
    }

}