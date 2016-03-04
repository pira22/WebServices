<?php

/**
 * Created by PhpStorm.
 * User: Khaled ElAbed
 * Date: 13/01/2015
 * Time: 13:21
 */

require (__DIR__ . '/../dao/UserDAO.php');
require (__DIR__ . '/../dao/ConversationDao.php');
require (__DIR__ . '/../includes/PasswordHash.php');
require (__DIR__ . '/../includes/UploadHelper.php');
require (__DIR__ . '/../includes/GCM.php');

class UserController {

    protected $app;
    
    

    public function __construct() {
        $this->app = \Slim\Slim::getInstance();
        
       
    }
    public function addPictureuser()
    {
        $options = array();
        $options['uid'] = $this->app->request()->post('uid');
        $options['image'] = $this->app->request()->post('image');

        $userDao = new UserDAO();
        $check = $userDao->addPictureuser($options);
        //echo (json_encode($check));
        $response = array();
        if ($check === false) {

            $response["error"] = 'true';
            $response["message"] = 'Internal error !';
            self::echoResponse(500, $response);
        } else {
            //$response = array();
            $response["error"] = 'false';
            $response["message"] = 'Welcome';
            self::echoResponse(200, $check);
        }
    }
     public function login() {   
        $options = array();     
        $options['email'] = $this->app->request()->post('email');
        $options['password'] = $this->app->request()->post('password');
       
        $userDao = new UserDAO();
        $check = $userDao->login($options);
        //echo (json_encode($check)); 
        $response = array(); 
        if ($check === false) {
                
                $response["error"] = 'true';
                $response["message"] = 'Internal error !';
                self::echoResponse(500, $response);
        } else {
                //$response = array();
                $response["error"] = 'false';
                $response["message"] = 'Welcome'; 
                self::echoResponse(200, $check);
        }    
    }
   
   public function getUserdetail() {
        $id = $this->app->request()->post('uid');
        $userDao = new UserDAO();
        $check = $userDao->getUserdetail($id);
        echo (json_encode($check)); 
        
    }

    public function addUser(){
        //echo $this->app->GOOGLE_API_KEY;
        $options = array();
        $options['u_email'] =$this->app->request()->post('u_email');
        $options['u_firstname'] =$this->app->request()->post('u_firstname');
        $options['u_lastname'] =$this->app->request()->post('u_lastname');
        $options['gcm_regid'] =$this->app->request()->post('gcm_regid');
        $options['u_tel'] =$this->app->request()->post('u_tel');
        $options['u_password'] =$this->app->request()->post('u_password');
         //$options['cat'] =$this->app->request()->post('cat');

        $userDao = new UserDao(); 
        $check = $userDao->addUser($options);
        $response = array();
         /*if ($check === false) {
                $response = array();
                $response["error"] = 'true';
                $response["message"] = 'Internal error !';
                Self::echoResponse(500, $response);
            } else {*/
                $response = array();
                $response["error"] = 'false';
                $response["message"] = $check;  
                self::echoResponse(200, $response);
           // }
        
        //echo (json_encode($check));
        //echo .GOOGLE_API_KEY;
        //echo '{"products":'.json_encode($check).'}';

    }
    public function loginWithSocialmedia(){
        $options = array();
        $options['u_email'] =$this->app->request()->post('u_email');
        $options['u_firstname'] =$this->app->request()->post('u_firstname');
        $options['u_lastname'] =$this->app->request()->post('u_lastname');
        $options['gcm_regid'] =$this->app->request()->post('gcm_regid');
        $options['u_tel'] =$this->app->request()->post('u_tel');
        $options['u_link_img'] =$this->app->request()->post('u_link_img');
        $userDao = new UserDao();
        $check = $userDao->loginWithSocialmedia($options);
       echo $check;

    }

    public function addConversation(){
        $options = array();
        $options['c_title'] =$this->app->request()->post('c_title');
        $options['u_ids'] =$this->app->request()->post('u_ids');
        $options['u_id'] =$this->app->request()->post('u_id');
        $options['reply'] =$this->app->request()->post('reply');
        
        $conversationDAO = new ConversationDAO(); 
        $cid = $conversationDAO->addConversation($options);
        
       $response = array();
        if ($cid === false) {
                
                $response["error"] = 'true';
                $response["message"] = 'Internal error !';
                Self::echoResponse(500, $response);
        } else {
                $options['c_id']=$cid;
                $check = $conversationDAO->replyConversation($options);
                $response = array();
                if ($check === false) {
                
                            $response["error"] = 'true';
                            $response["message"] = 'Internal error !';
                            Self::echoResponse(500, $response);
                    } else {
                            //$response = array();
                            $response["error"] = 'false';
                            $response["message"] = 'Message sent'; 
                            //Self::echoResponse(200, $check[0]->users); 
                            //var_dump(count($check[0]->users));

                            foreach ( $check[0]->users as $value) {
                                    //echo $value->gcm_regid."  ";
                                    //echo $value->u_id." - ";
                                    $this->send_notification(array($value->gcm_regid),array("m" => $options['reply']));
                                
                            }
                } 
        }   
       
    }

    public function replyConversation(){
        $conversationDAO = new ConversationDAO();
        $options = array();
        $options['c_id'] =$this->app->request()->post('c_id');
        $options['u_id'] =$this->app->request()->post('u_id'); 
        $options['reply'] =$this->app->request()->post('reply');

        $check = $conversationDAO->replyConversation($options);
        $response = array();
        if ($check === false) {
                
                $response["error"] = 'true';
                $response["message"] = 'Internal error !';
                Self::echoResponse(500, $response);
        } else {
                //$response = array();
                $response["error"] = 'false';
                $response["message"] = 'Message sent'; 
                //Self::echoResponse(200, $check[0]->users); 
                //var_dump(count($check[0]->users));

                foreach ( $check[0]->users as $value) {
                        //echo $value->gcm_regid;
                        $this->send_notification(array($value->gcm_regid),array("m" => $options['reply']));
                    
                }
                // foreach ($check->users as $key => $value) {
                //     echo $key;
                // }
        } 

    }

    public function getConversation(){
        $conversationDAO = new ConversationDAO();
        $options = array();
        $options['c_id'] =$this->app->request()->post('c_id');
        $options['u_id'] =$this->app->request()->post('u_id'); 
        $options['reply'] =$this->app->request()->post('reply');

        $check = $conversationDAO->getConversation($options);
        $response = array();
        if ($check === false) {
                
                $response["error"] = 'true';
                $response["message"] = 'Internal error !';
                Self::echoResponse(500, $response);
        } else {
                //$response = array();
                
                Self::echoResponse(200, $check); 
        } 

    }

    public function getConversationByuser(){
        $conversationDAO = new ConversationDAO();
        $options = array();
        //$options['c_id'] =$this->app->request()->post('c_id');
        $options['u_id'] =$this->app->request()->get('u_id'); 
        //$options['reply'] =$this->app->request()->post('reply');
        
        $check = $conversationDAO->getConversationByuser($options);
        $response = array();
        if ($check === false) {
                
                // $response["error"] = 'true';
                // $response["message"] = 'Internal error !';
                // Self::echoResponse(500, $response);
        } else {
                //$response = array();
                
                Self::echoResponse(200, $check); 
        } 

    }

    public function getRepliesByConversation(){
        $conversationDAO = new ConversationDAO();
        $options = array();
        $options['c_id'] =$this->app->request()->get('c_id');
        $options['u_id'] =$this->app->request()->get('u_id'); 
        //$options['reply'] =$this->app->request()->post('reply');

        $check = $conversationDAO->getRepliesByConversation($options);
        $response = array();
        if ($check === false) {
                
                $response["error"] = 'true';
                $response["message"] = 'Internal error !';
                Self::echoResponse(500, $response);
        } else {
                //$response = array();
                
                Self::echoResponse(200, $check); 
        } 

    }


   private function send_notification($registatoin_ids, $message) {
        // include config
        //echo "START SENDING";

        // Set POST variables
        $url = 'https://android.googleapis.com/gcm/send';

        $fields = array(
            'registration_ids' => $registatoin_ids,
            'data' => $message,
        );

        $headers = array(
            'Authorization: key=' .$this->app->GOOGLE_API_KEY,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);
        //echo $result;
        
        $response = array();
        if (json_decode($result)->failure == 0) {
                $response["error"] = 'false';
                $response["message"] = 'Message Sent!';
                Self::echoResponse(200, $response); 
               
        } else {
                 $response["error"] = 'true';
                $response["message"] = 'Internal error !';
                Self::echoResponse(500, $response);
        } 
    }

    public function getFriends(){
        $fr_id = $this->app->request()->post('id');
        $productDao = new UserDao();
        $check = $productDao->getFriends($fr_id);
        //echo '{"products":'.json_encode($check).'}';

    }

//////////////////////////////////////////////////////



    private function echoResponse($status_code, $response) {
        $this->app->status($status_code);
        $this->app->contentType('application/json');
        echo json_encode($response);
        $this->app->stop();
    }

    

    

}