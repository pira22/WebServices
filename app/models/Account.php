<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Account extends Eloquent
{
    protected $primaryKey = 'ac_id';
    protected $table = 'account';
    public $timestamps = true;

    public function transaction(){
        return $this->belongsToMany('Product','transactions','p_id','ac_id')->withPivot('tr_amount','tr_date');
    }

}