<?php


class ConversationDAO {

   
    public function addConversation($options) {
        try {     
            $users=$options['u_ids'];
            $ids = explode(",", $users);
            
            $conversation = new Conversation();
            $conversation->c_title =  $options['c_title'];  
            $conversation->save();
           
            foreach ($ids as $id) {
                
                $conversation->users()->attach($id);
                
            }  
            $options['c_id'] = $conversation->c_id;
            
            //$conversation = $this->replyConversation($options);      
        return  $options['c_id'];
        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }


    public function replyConversation($options) {
        try {     
            $uid=$options['u_id'];
            $cid = $options['c_id'];

            $conversation = Conversation::find($cid);

            $check = $conversation->replies()->attach($uid,array("reply"=>$options['reply'])); 
                   
        return    Conversation::with('users')->where('c_id', '=', $cid)->get();
        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }

    public function getConversation($options) {
        try {     
            $uid=$options['u_id'];
            $cid=$options['c_id'];

            //$users = Conversation::with('users','replies')->where('c_id', '=', $cid)->get()->toArray();//($options['c_id']);
            
            // $users = Conversation::with(array('users' => function($query)use ($cid)
            // {
            //     $query->where('users_conversations.c_id','=',$cid); 
            // }))->find($cid); 

            $users = User::with(array('conversations' => function($query)use ($uid)
            {
                $query->where('users_conversations.u_id','=',$uid); 
            }))->find($uid); 


        return  $users;
        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }

    public function getRepliesByConversation($options) {
        try {     
            $uid=$options['u_id'];
            $cid=$options['c_id'];

            $users = Conversation::with('users')->where('c_id', '=', $cid)->get()->toArray();//($options['c_id']);
            

            // $users = Conversation::with(array('users' => function($query)use ($cid)
            // {
            //     $query->where('users_conversations.c_id','=',$cid); 
            // }))->find($cid); 


        return  $users;
        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }

    public function getConversationByuser($options) {
        try {     
            $uid=$options['u_id'];
            

           // $cid=$options['c_id'];

            //$users = Conversation::with('users')->where('c_id', '=', $cid)->get()->toArray();//($options['c_id']);
            

            // $users = Conversation::with(array('users' => function($query)use ($uid)
            // {
            //     $query->where('users_conversations.u_id','=',$uid); 
            // }))->get(); 

            // $users = User::with(array('conversations' => function($query)use ($uid)
            // {
            //     $query->where('users_conversations.u_id','=',$uid); 
            // }))->get(); 

            $conversations =User::find($uid)->conversations()->with('users','replies')->orderBy('created_at', 'DESC')->get();//->get();

            //var_dump($conversations);die;
        return  $conversations;
        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }

    public function getFriends($id){
        
        //var_dump($user->friends()->orderBy('request_date', 'DESC')->get());
        // $friend1 = User::with(array('friends' => function($query)use ($id)
        // {
        //     $query->where('friendship.u_id','=', $id); 
        // }))->find($id);


        $friend1 = User::find($id);
        
        $friend2 = User::with(array('friends' => function($query)use ($id)
        {
            $query->where('friendship.fr_id','=', $id); 
        }))->get();
        
        echo(
            json_encode($friend2)
        );

       // $friends = array_merge($friend1->friends()->get(), $friend2->friend->toArray());
       //  echo(
       //      json_encode($friends)
       //      );
        // foreach($user->friends as $friend)
        // {
        //     echo $friend->u_first .'<br>';
        // }
    }




   

}
