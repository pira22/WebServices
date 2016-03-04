<?php
/**
 * Created by PhpStorm.
 * User: Rami Jemli
 * Date: 11/01/2015
 * Time: 15:12
 */

require('./vendor/autoload.php');
require(dirname(__FILE__) . '/app/routes/UserRoute.php');
require(dirname(__FILE__) . '/app/routes/ProductRoute.php');

$app = new \Slim\Slim();
$app->GOOGLE_API_KEY = "AIzaSyCd63SzWgwKxF3iVF_TW8HS08RsTg0NTA8";
// authentification route
$user_router = new UserRoute($app);
$user_router->getFriends("/friends");
$user_router->login("/login");
$user_router->loginWithSocialmedia("/socialmedialogin");
$user_router->addUser("/register");
$user_router->getUserdetail("/getuser");
// $user_router->replyConversation("/reply");

$user_router->addPictureuser("/addpicuser");
$user_router->getConversationByuser("/conversations");
$user_router->getRepliesByConversation("/replies");

$product_router = new ProductRoute($app);
$product_router->getCategories("/categories");
$product_router->getSubCategory("/subs");
$product_router->getProductBySub("/prosub");
$product_router->getProductByUser("/probyuser");
// $product_router->getUserByProduct("/userbypro");
$product_router->getProposal("/prop");
$product_router->addProduct("/addprod");
$product_router->addBid("/addbid");
$product_router->getPanierWithuser("/getpanier");
$product_router->validateproduct("/validproduct");
$product_router->getFavoritewithuserandproduct("/favoriteuserproduct");
$product_router->getFavoritewithuser("/favoriteuser");
$product_router->addFavorite("/addfavorite");
$product_router->deleteFavorite("/deletefavorite");
$product_router->addProposal("/addproposal");
$product_router->updateBid("/updatebid");
$product_router->addPicture("/addpic");


// $product_router->makePayment("/pay");

// $product_router->getAllProductsByCategory("/productsbycategory");


$app->run();