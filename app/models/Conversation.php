<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Conversation extends Eloquent
{
    protected $primaryKey = 'c_id';
    protected $table = 'conversation';
    public $timestamps = false;

    public function users(){
        return $this->belongsToMany('User','users_conversations','c_id','u_id');//->withPivot('created_at');
    }

    public function replies(){
        return $this->belongsToMany('User','conversation_reply','c_id','u_id')->withPivot('created_at','reply','status');
    }
}