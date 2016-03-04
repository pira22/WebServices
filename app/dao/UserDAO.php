<?php


class UserDAO {

      public function login($options) {
          try {
          // $user = User::with('account')->find(1);
            //return $user;
            
             $user= User::where('u_email' ,'=', $options['email'])->where('u_password','=',$options['password'])->with('account')->first();
            
          return $user;
        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }
    public function addPictureuser($options)
    {
        try {
            $user =User::find($options['uid']);
            $user->u_picture = UploadHelper::upload($options['image']);

            if ($user->save()) {
                return true;
            }


        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }
    public function loginWithSocialmedia($options){
        try{
            $user = User::where('u_email' ,'=', $options['u_email'])->first();
            if (empty($user)) {
                $user = new User();
                foreach ($options as $key => $value) {
                    $user->$key = $value;

                }
                $user->save();
                $user = User::where('u_email' ,'=', $options['u_email'])->first();
              return $user;
            }else
                return $user;

        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }
    public function getUserdetail($uid) {
        try {
            $user =  User::find($uid);
          return $user;
        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }

    public function addUser($options) {
        try {            
            $user = new User();
            foreach ($options as $key => $value) {
               $user->$key = $value;

            }
            $check = $user->save();
            
          

            $userdetail= getUserdetail($user->u_id);
            return $user;
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
