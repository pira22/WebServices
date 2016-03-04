<?php


use Illuminate\Database\Eloquent\Model as Eloquent;

class Bid extends Eloquent
{
    protected $primaryKey = 'b_id';
    protected $table = 'bidding';
     public $timestamps = false;
     
    public function Product(){
    	return $this->belongsTo('Product','pro_id');
    }

     public function User()
    {
        return $this->BelongsTo('User','u_id');
    }

    public function Panier()
    {
        return $this->hasMany('Panier','pro_id');
    }
  
    

}