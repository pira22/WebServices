<?php

/**
 * Created by PhpStorm.
 * User: Khaled EL ABED
 * Date: 13/01/2015
 * Time: 12:03
 */

require (__DIR__.'/../controllers/UserController.php');

class UserRoute
{
    protected $app;
    private $user_controller;

    function __construct($app)
    {
        $this->app = $app;
    }

   
    public function login($url)
    {
        return $this->app->post($url, function () {
            $this->user_controller = new UserController();
            
            $this->user_controller->login();
            
        });
    }

    public function getUserdetail($url)
    {
        return $this->app->post($url, function () {
            $this->user_controller = new UserController();
            $this->user_controller->getUserdetail();

        });
    }
    public function addPictureuser($url)
    {
        return $this->app->post($url, function () {
            $this->user_controller = new UserController();
            $this->user_controller->addPictureuser();

        });
    }
    public function loginWithSocialmedia($url)
    {
        return $this->app->post($url, function () {
            $this->user_controller = new UserController();
            $this->user_controller->loginWithSocialmedia();

        });
    }
    public function addUser($url)
    {
        return $this->app->post($url, function () {
            $this->user_controller = new UserController();
            $this->user_controller->addUser();

        });
    }  

    public function addConversation($url)
    {
        return $this->app->post($url, function () {
            $this->user_controller = new UserController();
            $this->user_controller->addConversation();

        });
    } 

    public function replyConversation($url)
    {
        return $this->app->post($url, function () {
            $this->user_controller = new UserController();
            $this->user_controller->replyConversation();

        });
    }

    public function getConversation($url)
    {
        return $this->app->post($url, function () {
            $this->user_controller = new UserController();
            $this->user_controller->getConversation();

        });
    }

    public function getFriends($url)
    {
        return $this->app->post($url, function () {
            $this->user_controller = new UserController();
            $this->user_controller->getFriends();

        });

    }





    public function getConversationByuser($url)
    {
        return $this->app->get($url, function () {
            
            $this->user_controller = new UserController();
            $this->user_controller->getConversationByuser();

        });
    }

     public function getRepliesByConversation($url)
    {
        return $this->app->get($url, function () {
            $this->user_controller = new UserController();
            $this->user_controller->getRepliesByConversation();

        });
    }


    
}