<?php


use Illuminate\Database\Eloquent\Model as Eloquent;

class Proposal extends Eloquent
{
    protected $primaryKey = 'pro_id';
    protected $table = 'proposal';
     public $timestamps = false;
     
    public function Product(){
        return $this->belongsTo('Product','p_id');
    }
    
    public function Bid(){
        return $this->hasMany('Bid','pro_id');
    }
    public function Panier(){
        return $this->hasMany('Panier','pro_id');
    }

    public function bids(){
        return $this->hasOne('Bid','pro_id');
    }
}