<?php

/**
 * Created by PhpStorm.
 * User: Khaled EL ABED
 * Date: 13/01/2015
 * Time: 12:03
 */

require (__DIR__.'/../controllers/ProductController.php');

class ProductRoute
{
    protected $app;
    private $product_controller;

    function __construct($app)
    {
        $this->app = $app;
    }


    public function getProposal($url){
         return $this->app->post($url, function () {
            $this->product_controller = new ProductController();
            $this->product_controller->getProposal();
            
        });
      }
    public function getCategories($url)
    {
        return $this->app->post($url, function () {
            $this->product_controller = new ProductController();
            $this->product_controller->getCategories();
            
        });
    }
    public function getFavoritewithuserandproduct($url)
    {
        return $this->app->post($url, function () {
            $this->product_controller = new ProductController();
            $this->product_controller->getFavoritewithuserandproduct();

        });
    }
    public function getFavoritewithuser($url)
    {
        return $this->app->post($url, function () {
            $this->product_controller = new ProductController();
            $this->product_controller->getFavoritewithuser();

        });
    }
    // get category's subs 
    public function getSubCategory($url)
    {
        return $this->app->post($url, function () {
            $this->product_controller = new ProductController();
            $this->product_controller->getSubCategory();
            
        });
    }
    public function validateproduct($url){
        return $this->app->post($url, function () {
            $this->product_controller = new ProductController();
            $this->product_controller->validateProduct();

        });
    }
    // get sub's product
    public function getProductBySub($url)
    {
        return $this->app->post($url, function () {
            $this->product_controller = new ProductController();
            $this->product_controller->getProductBySub();
            
        });
    }

    public function getPanierWithuser($url)
    {
        return $this->app->post($url, function () {
            $this->product_controller = new ProductController();
            $this->product_controller->getPanierWithuser();

        });
    }

    public function addPicture($url)
    {
        return $this->app->post($url, function () {
            $this->product_controller = new ProductController();
            $this->product_controller->addPicture();

        });
    }
    public function getProductByUser($url)
    {
        return $this->app->post($url, function () {
            $this->product_controller = new ProductController();
            $this->product_controller->getProductByUser();
            
        });
    }

     public function getUserByProduct($url)
    {
        return $this->app->post($url, function () {
            $this->product_controller = new ProductController();
            $this->product_controller->getUserByProduct();
            
        });
    }

    public function addProduct($url)
    {
        return $this->app->post($url, function () {
            $this->product_controller = new ProductController();
            $this->product_controller->addProduct();
            
        });
    }
    public function addFavorite($url)
    {
        return $this->app->post($url, function () {
            $this->product_controller = new ProductController();
            $this->product_controller->addFavorite();

        });
    }
    public function deleteFavorite($url)
    {
        return $this->app->post($url, function () {
            $this->product_controller = new ProductController();
            $this->product_controller->deleteFavorite();

        });
    }
    public function addBid($url)
    {
        return $this->app->post($url, function () {
            $this->product_controller = new ProductController();
            $this->product_controller->addBid();
            
        });
    }
    public function addProposal($url)
    {
        return $this->app->post($url, function () {
            $this->product_controller = new ProductController();
            $this->product_controller->addProposal();

        });
    }
     public function updateBid($url)
    {
        return $this->app->post($url, function () {
            $this->product_controller = new ProductController();
            $this->product_controller->updateBid();
            
        });
    }

    
    public function getBidByProduct($url)
    {
        return $this->app->post($url, function () {
            $this->product_controller = new ProductController();
            $this->product_controller->getBidByProduct();
            
        });
    }

    
    public function makePayment($url)
    {
        return $this->app->post($url, function () {
            $this->product_controller = new ProductController();
            $this->product_controller->makePayment();
            
        });
    }

    public function getTransaction($url)
    {
        return $this->app->post($url, function () {
            $this->product_controller = new ProductController();
            $this->product_controller->getTransaction();
            
        });
    }

    public function getAllProductsByCategory($url)
    {
        return $this->app->post($url, function () {
            $this->product_controller = new ProductController();
            $this->product_controller->getAllProductsByCategory();
            
        });
    }
    // public function getProducts($url)
    // {
    //     return $this->app->get($url, function () {
    //         $this->product_controller = new ProductController();
    //         $this->product_controller->getProducts();
    //     });
    // } 

    // public function getProductsByCat($url)
    // {
    //     return $this->app->post($url, function () {
    //         $this->product_controller = new ProductController();
    //         $this->product_controller->getProductsByCat();
    //     });
    // } 


    
}