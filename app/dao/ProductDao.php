<?php
include_once(__DIR__ . '/../models/Proposal.php');
include_once(__DIR__ . '/../models/Bid.php');
include_once(__DIR__ . '/../models/Panier.php');
include_once(__DIR__ . '/../models/Favorite.php');

class ProductDao
{


    public function getBidsWithProduct($pro)
    {
        try {
            $bid = Bid::with('Product')->with('User')->where('pro_id', '=', $pro)->get();
            return $bid;
        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }

    public function addProposal($options)
    {
        try {
            $user = User::find($options['uid']);
            $product = Product::find($options['pid']);

            $bid = new Bid();
            $bid->amount = $options['amount'];
            $bid->date_take = $options['date_take'];
            $bid->date_delivery = $options['date_delivery'];
            $bid = $bid->User()->associate($user);
            $bid = $bid->Product()->associate($product);
            if ($bid->save()) {
                return array('success' => true);
            }

        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }

    public function getPanierWithuser($uid)
    {
        try {

            $proposal = Panier::whereHas('Bid', function ($query) use ($uid) {
                $query->where('bidding.u_id', '=', $uid);
            })->with('Bid.Product')->get();
            return $proposal;
        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }

    public function getProducts()
    {
        try {
            $products = Product::all()->take(10);
            return $products;
        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }


    public function getCategories()
    {
        try {
            $products = Category::with('subs')->whereNull('cat_parentid')->get()->toArray();
            return $products;
        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }


    public function getSubCategory($cat_id)
    {
        try {
            $products = Category::where('cat_parentid', '=', $cat_id)->get();
            return $products;
        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }

    public function getFavoritewithuser($u_id)
    {
        try {
            $products = Favorite::with("Product.Bid")->with("Product.pictures")->where('u_id', '=', $u_id)->get();
            return $products;
        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }

    public function getFavoritewithuserandproduct($u_id, $p_id)
    {
        try {
            $products = Favorite::where('u_id', '=', $u_id)->where('p_id', '=', $p_id)->get();
            return $products;
        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }

    public function getProductBySub($cat_id)
    {
        try {

            $products = Product::where('cat_id', '=', $cat_id)->with('pictures')->with('users')->with('Bid')->get();
            return $products;
        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }

    //get 
    public function getProductByUser($u_id)
    {
        try {
            return Product::where('u_id', '=', $u_id)->with('pictures')->with('users')->with('Bid')->get();
        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }

    //get 
    public function getUserByProduct($pr_id)
    {
        try {
            $product = Product::find($pr_id);
            return $product->user;
        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }

    public function addProduct($options)
    {
        try {
            $user = User::find($options['uid']);
            $product = new Product();
            $product->p_picture = UploadHelper::upload($options['image']);
            $product->p_title = $options['name'];
            $product->p_description = $options['desc'];
            $product->p_price = $options['price'];
            $cat = Category::find($options['cat']);
            $product->category()->associate($cat);
            $product->user()->associate($user);
            $check = $product->save();
            $productinsert = Product::find($product->p_id);
            return $productinsert;
        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }

    public function addPicture($options)
    {
        try {
            $product =Product::find($options['pid']);
            $picture = new Picture();
            $picture->pic_name = UploadHelper::upload($options['image']);
            $picture->pic_link = $options['piclink'];
            $picture->Product()->associate($product);
            if ($picture->save()) {
                return array('success' => true);
            }


        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }

    public function addFavorite($options)
    {
        try {
            $user = User::find($options['uid']);
            $product = Product::find($options['pid']);
            $favorite = new Favorite();
            $favorite->Product()->associate($product);
            $favorite->user()->associate($user);
            $check = $favorite->save();

            //  $date = $this->currentDate();

            // $isSaved = $user->bids()->attach($product->p_id, array('created_at' => $this->currentDate(),'amount'=>$options['topay'] ,'date_take'=>$date));

            return $check;
        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }

    public function deleteFavorite($options)
    {
        try {
            $favorite = Favorite::where("u_id", "=", $options["uid"])->where("p_id", "=", $options["pid"])->delete();
            return true;
        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }

    public function getBidByProduct($pid)
    {

        try {

            $product = Product::find($pid);
            $bids = $product->bids;
            $listBids = array();
            foreach ($bids as $key => $value) {
                $value->pivot->user = User::find($value->u_id);
                $listBids [] = $value->pivot;
            }
            return $listBids;// $product->bids;
        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }

    public function addBid($options)
    {
        try {
            $user = User::find($options['uid']);
            $product = Proposal::find($options['prid']);
            $bid = new Bid();
            $bid->amount = $options['amount'];
            $bid->date_take = $options['date_take'];
            $bid->date_delivery = $options['date_delivery'];
            $bid = $bid->User()->associate($user);
            $bid = $bid->Proposal()->associate($product);
            $bid->save();
            //$isSaved = $product->Bid()->attach($product->pro_id,);
            return true;
        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }


    public function updateBid($options)
    {
        try {
            $bid = Bid::find($options['bid']);
            $bid->amount = $options['amount'];
            $bid->date_take = $options['date_take'];
            $bid->date_delivery = $options['date_delivery'];
            if ($bid->save()) {
                return array('success' => true);
            }
            return true;
        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }


    public function makePayment($options)
    {
        try {
            $account = Account::find($options['acid']);
            $product = Product::find($options['prid']);
            $isSaved = $account->transaction()->attach($product->p_id, array('tr_amount' => $options['amount'], 'tr_date' => $options['date'], 'created_at' => $this->currentDate()));
            return true;
        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }

    public function getTransaction($options)
    {
        try {
            $transaction = Transaction::all();
            //$product = Product::find($options['prid']);             
            //$isSaved = $account->transaction()->attach($product->p_id, array('tr_amount' => $options['amount'] ,'tr_date'=>$options['date'],'created_at'=>$this->currentDate()));
            return $transaction;
        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }


    public function getAllProductsByCategory($cat_id)
    {
        try {
            return Product::whereHas('Category', function ($q) use ($cat_id) {
                // $q->where('places_categories.cat_id', '=', $this->cat)
                $q->where('categories.cat_parentid', '=', $cat_id);
            })->with('pictures')->get();


        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }

    }


    public function validateProduct($pro_id, $bid)
    {
        try {
            $product = Product::find($pro_id);
            $product->p_status = true;
            $product->save();
            $bid = Bid::find($bid);
            $bid->state = 1;
            $bid->save();
            //$user = User::find($u_id);
            return true;
        } catch (Exception $e) {
            echo 'Error' . $e;
            return false;
        }
    }

    private function currentDate()
    {
        $today = getdate();
        return $date = $today['year'] . '-' . $today['mon'] . '-' . $today['mday'] . ' ' . $today['hours'] . ':' . $today['minutes'] . ':' . $today['seconds'];

    }

}