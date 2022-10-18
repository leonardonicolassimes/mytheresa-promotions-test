<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    
    public function getProducts(Request $request)
    {
        $where = '';
        $bindings = array();
        if ($request->has('category')) {
            $where.= 'and c.name like :categoryName ';
            $bindings['categoryName'] = $request->input('category');
        }

        if ($request->has('priceLessThan')) {
            $where.= 'and p.price < :priceLessThan';
            $bindings['priceLessThan'] = $request->input('priceLessThan');
        }

        $result = array();

        $query = DB::select("select p.sku as sku, p.name as name, p.price as price, p.discount_percentage as discount_product, c.name as category, c.discount_percentage as discount_category from 
        products p inner join categories c where p.category = c.id $where order by p.sku asc", $bindings);
        
        foreach ($query as $product) {
            $discountPercentage = ($product->discount_product > $product->discount_category) ? $product->discount_product : $product->discount_category;
            $finalPrice = 0;
            if ($discountPercentage > 0) {
                $finalPrice = $product->price - ($product->price * $discountPercentage / 100); 
                $discountPercentage .= "%";
            } else {
                $finalPrice = $product->price;
                $discountPercentage = null;
            }
            
            array_push($result,
            [
                "sku" => $product->sku,
                "name" => $product->name,
                "category" => $product->category,
                "price" => [
                    "original" => $product->price,
                    "final" => $finalPrice,
                    "discount_percentage" => $discountPercentage,
                    "currency" => "EUR",
                ]
            ]);
        }

        return response()->json($result);
    }
}