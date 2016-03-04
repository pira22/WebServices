<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Product extends Eloquent
{
    protected $primaryKey = 'p_id';
    protected $table = 'products';
    public $timestamps = true;

    
    
    // public function category()
    // {
    //     return $this->belongsTo('Category','cat_id');
    // }
    public function Bid(){
        return $this->hasMany('Bid','pro_id');
    }
    public function Favorite(){
        return $this->hasMany('Favorite','p_id');
    }
    public function category()
    {
        return $this->belongsTo('Category','cat_id');
    }

    public function user()
    {
        return $this->belongsTo('User','u_id');
    }
    public function users()
    {
        return $this->belongsTo('User','u_id');
    }

    public function bids(){
        return $this->belongsToMany('User','bidding','p_id','u_id')->withPivot('amount','created_at','state','date_take','date_delivery');
    }

   public function transaction(){
        return $this->belongsToMany('Product','transactions','p_id','ac_id')->withPivot('tr_amount','tr_date');
    }

    public function pictures(){
         return $this->hasMany('Picture','p_id');
    }
    /*public function usersBid(){
        //return $this->belongsToMany('User');
        return $this->belongsToMany('User','bids','pr_id','u_id')->withPivot('amount','is_confirmed','date_take','period');
    }*/


   


}