<?php


use Illuminate\Database\Eloquent\Model as Eloquent;

class Picture extends Eloquent {

    public $timestamps = false;
    protected $primaryKey = 'pic_id';
    protected $table = 'pictures';
    
 //    public function friends()
	// {
 //    	return $this->belongsToMany('User', 'friendship','u_id', 'fr_id')->withPivot('request_date', 'is_accepted');
	// }

     public function Product(){
       return $this->belongsTo('Product','p_id');
    }

 //    public function bids(){
 //        return $this->belongsToMany('Product','bidding','p_id','u_id')->withPivot('created_at','state','date_take','date_delivery');
 //    }

 //    public function account()
 //    {
 //        return $this->hasOne('Account','ac_id');
 //    }
	

}