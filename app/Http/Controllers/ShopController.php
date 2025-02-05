<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Cart;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query("page");
        $size = $request->query("size");
        if(!$page)
            $page = 1;
        if(!$size)
            $size = 12;
        $order = $request->query("order");
        if(!$order)
            $order = -1;
        $o_column = "";
        $o_order = "";
        switch($order)
        {
            case 1:
                $o_column = "created_at";
                $o_order = "DESC";
                break;
            case 2:
                $o_column = "created_at";
                $o_order = "ASC";
                break;
            case 3:
                $o_column = "regular_price";
                $o_order = "ASC";
                break;
            case 4:
                $o_column = "regular_price";
                $o_order = "DESC";
                break;
           default:
                $o_column = "id";
                $o_order = "DESC";
                  
        }
        // $categories = Category::orderBy("name",'ASC')->get();
        $prange = $request->query("prange");
        if(!$prange)
            $prange ="0,500";
        $from = explode(",",$prange)[0];
        $to = explode(",",$prange)[1];

        $products = Product::whereBetween('regular_price',array($from,$to))->orderBy('created_at','DESC')->orderBy($o_column,$o_order)->paginate($size);
        return view('shop',['products'=>$products,'page'=>$page,'size'=>$size,'order'=>$order,'from'=>$from,'to'=>$to]);
    }
    public function productDetails($slug)
    {
        $product = Product::where('slug',$slug)->first();
        $rproducts = Product::where('slug','!=',$slug)->inRandomOrder('id')->get()->take(8);
        return view('details',['product'=>$product,'rproducts'=>$rproducts]);
    }
    public function getCartAndWishlistCount(){
        $cartCount = Cart::instance('cart')->content()->count();
        $wishlistCount = Cart::instance('wishlist')->content()->count();
        return response()->json(['status'=>200,'cartCount'=>$cartCount,'wishlistCount'=>$wishlistCount]);

    }
}
