<?php

/**
 * Created by PhpStorm.
 * User: Khaled ElAbed
 * Date: 13/01/2015
 * Time: 13:21
 */

require(__DIR__ . '/../dao/ProductDao.php');


class ProductController
{

    protected $app;
    private $product_dao;


    public function __construct()
    {
        $this->app = \Slim\Slim::getInstance();


    }


    public function getProposal()
    {
        $proposal_id = $this->app->request()->post('pro_id');
        $productDao = new ProductDao();
        $check = $productDao->getBidsWithProduct($proposal_id);
        echo(json_encode($check));
    }

    public function getFavoritewithuser()
    {
        $uid = $this->app->request()->post('u_id');
        $productDao = new ProductDao();
        $check = $productDao->getFavoritewithuser($uid);
        echo(json_encode($check));
    }

    public function getFavoritewithuserandproduct()
    {
        $uid = $this->app->request()->post('u_id');
        $pid = $this->app->request()->post('p_id');
        $productDao = new ProductDao();
        $check = $productDao->getFavoritewithuserandproduct($uid, $pid);
        echo(json_encode($check));
    }

    public function getPanierWithuser()
    {
        $uid = $this->app->request()->post('u_id');
        $productDao = new ProductDao();
        $check = $productDao->getPanierWithuser($uid);
        echo(json_encode($check));
    }

    public function getCategories()
    {
        //$cat_id = $this->app->request()->get('cat');

        $productDao = new ProductDao();
        $check = $productDao->getCategories();
        echo(json_encode($check));


    }

    public function validateProduct()
    {
        $pro_id = $this->app->request()->post('pro_id');
        $bid = $this->app->request()->post('bid');
        $productDao = new ProductDao();
        $check = $productDao->validateProduct($pro_id,$bid);
        echo(json_encode($check));
    }

    public function getSubCategory()
    {
        $cat_id = $this->app->request()->post('cat');
        $productDao = new ProductDao();
        $check = $productDao->getSubCategory($cat_id);
        echo(json_encode($check));


    }

    public function addPicture()
    {
        $options = array();
        $options['pid'] = $this->app->request()->post('pid');
        $options['piclink'] = $this->app->request()->post('piclink');
        $options['image'] = $this->app->request()->post('image');
        $productDao = new ProductDao();
        $check = $productDao->addPicture($options);
        echo(json_encode($check));
    }
    public function getProductBySub()
    {
        $cat_id = $this->app->request()->post('cat');
        $productDao = new ProductDao();
        $check = $productDao->getProductBySub($cat_id);
        echo(json_encode($check));


    }

    public function getProductByUser()
    {
        $u_id = $this->app->request()->post('uid');
        $productDao = new ProductDao();
        $check = $productDao->getProductByUser($u_id);
        echo(json_encode($check));

    }


    public function getUserByProduct()
    {
        $pr_id = $this->app->request()->post('prid');
        $productDao = new ProductDao();

        $check = $productDao->getUserByProduct($pr_id);
        echo(json_encode($check));

    }

    public function addProduct()
    {
        $options = array();
        $options['uid'] = $this->app->request()->post('uid');
        $options['name'] = $this->app->request()->post('name');
        $options['desc'] = $this->app->request()->post('desc');
        $options['price'] = $this->app->request()->post('price');
        $options['cat'] = $this->app->request()->post('cat');
        $options['image'] = $this->app->request()->post('image');
        $productDao = new ProductDao();
        $check = $productDao->addProduct($options);
        echo(json_encode($check));

    }

    public function addFavorite()
    {
        $options = array();
        $options['uid'] = $this->app->request()->post('uid');
        $options['pid'] = $this->app->request()->post('pid');
        $productDao = new ProductDao();
        $check = $productDao->addFavorite($options);
        echo(json_encode($check));

    }

    public function deleteFavorite()
    {
        $options = array();
        $options['uid'] = $this->app->request()->post('uid');
        $options['pid'] = $this->app->request()->post('pid');
        $productDao = new ProductDao();
        $check = $productDao->deleteFavorite($options);
        echo(json_encode($check));

    }

    public function addProposal()
    {
        $options = array();
        $options['uid'] = $this->app->request()->post('uid');
        $options['pid'] = $this->app->request()->post('pid');
        $options['date_delivery'] = $this->app->request()->post('date_delivery');
        $options['date_take'] = $this->app->request()->post('date_take');
        $options['amount'] = $this->app->request()->post('amount');
        $productDao = new ProductDao();
        $check = $productDao->addProposal($options);
        echo (json_encode($check));

    }
    public function addBid()
    {
        //$pr_id = $this->app->request()->post('prid');
        $options = array();
        $options['uid'] = $this->app->request()->post('uid');
        $options['prid'] = $this->app->request()->post('prid');
        $options['date_delivery'] = $this->app->request()->post('date_delivery');
        $options['date_take'] = $this->app->request()->post('date_take');
        $options['amount'] = $this->app->request()->post('amount');
        //$options['confirmed'] =$this->app->request()->post('confirmed');
        $productDao = new ProductDao();

        $check = $productDao->addBid($options);
        //echo (json_encode($check));

    }

    public function updateBid()
    {
        //$pr_id = $this->app->request()->post('prid');
        $options = array();
        $options['date_delivery'] = $this->app->request()->post('date_delivery');
        $options['date_take'] = $this->app->request()->post('date_take');
        $options['amount'] = $this->app->request()->post('amount');
        $options['bid'] =$this->app->request()->post('bid');
        $productDao = new ProductDao();

        $check = $productDao->updateBid($options);
        echo(json_encode($check));

    }


    public function getBidByProduct()
    {
        $pr_id = $this->app->request()->post('prid');
        $productDao = new ProductDao();
        $check = $productDao->getBidByProduct($pr_id);
        echo(json_encode($check));

    }


    public function makePayment()
    {

        $options = array();
        $options['acid'] = $this->app->request()->post('acid');
        $options['prid'] = $this->app->request()->post('prid');
        $options['amount'] = $this->app->request()->post('amount');
        $options['date'] = $this->app->request()->post('date');
        $productDao = new ProductDao();
        $check = $productDao->makePayment($options);
        echo(json_encode($check));

    }

    public function getTransaction()
    {

        $id = $this->app->request()->post('uid');

        $productDao = new ProductDao();
        $check = $productDao->getTransaction($id);
        echo(json_encode($check));

    }


    public function getAllProductsByCategory()
    {
        $cat_id = $this->app->request()->post('cat');
        $productDao = new ProductDao();
        $check = $productDao->getAllProductsByCategory($cat_id);
        echo(json_encode($check));
    }


//////////////////////////////////////////////////////


    private function echoResponse($status_code, $response)
    {
        $this->app->status($status_code);
        $this->app->contentType('application/json');
        echo json_encode($response);
        $this->app->stop();
    }


}