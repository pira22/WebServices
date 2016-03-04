<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Transaction extends Eloquent {

    public $timestamps = false;
    protected $primaryKey = 'tr_id';
    protected $table = 'transactions';
    
    // public function products(){
    //     return $this->hasMany('Product','u_id');
    // }

    // public function users(){
    //     return $this->belongsToMany('Product','bidding','p_id','u_id')->withPivot('created_at','state','date_take','date_delivery');
    // }

    // public function account()
    // {
    //     return $this->hasOne('Account','ac_id');
    // }
	

}