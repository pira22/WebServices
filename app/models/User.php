<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent {

    public $timestamps = false;
    protected $primaryKey = 'u_id';
    protected $table = 'users';
    
    public function friends()
	{
    	return $this->belongsToMany('User', 'friendship','u_id', 'fr_id')->withPivot('request_date', 'is_accepted');
	}

    public function products(){
        return $this->hasMany('Product','u_id');
    }
    public function Favorite(){
        return $this->hasMany('Favorite','u_id');
    }
    public function bids(){
        return $this->belongsToMany('Proposal','bidding','pro_id','u_id')->withPivot('created_at','state','date_take','date_delivery');
    }

    public function account()
    {
        return $this->hasOne('Account','ac_id');
    }


    public function conversations(){
        return $this->belongsToMany('Conversation','users_conversations','u_id','c_id')->withPivot('created_at');
    }

    public function msgs(){
        return $this->belongsToMany('User','conversation_reply','c_id','u_id')->withPivot('created_at','reply','status');
    }
	
    public function Bid(){
        return $this->hasMany('Bid','u_id');
    }
}