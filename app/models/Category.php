<?php


use Illuminate\Database\Eloquent\Model as Eloquent;

class Category extends Eloquent
{
    protected $primaryKey = 'cat_id';
    protected $table = 'categories';
     public $timestamps = false;
     
    /*public function pics(){
        return $this->belongsToMany('Picture','pictures_users_like','pic_id','u_id');
    }
    */
    public function products(){
    	return $this->hasMany('Product','cat_id');
    }

    // public function bids(){
    //     return $this->belongsToMany('Picture','bidding','pic_id','u_id');
    // }

    public function subs(){
        return $this->hasMany('Category','cat_parentid');
    }
    
    

}