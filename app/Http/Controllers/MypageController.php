<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $myProducts = DB::table('products')
            ->where('company_id', $user->company_id)
            ->get();
        
        $purchaseHistory = DB::table('sales')
            ->join('products', 'sales.product_id', '=', 'products.id')
            ->join('companies', 'products.company_id', '=', 'companies.id')
            ->select(
                'sales.*',
                'products.product_name',
                'products.price',
                'companies.company_name'
                )
            ->where('sales.user_id', $user->id) 
            ->orderBy('sales.created_at', 'desc')
            ->get();      
        
        $favoriteProducts = DB::table('likes')
            ->join('products', 'likes.product_id', '=', 'products.id')
            ->join('companies', 'products.company_id', '=', 'companies.id')
            ->select(
                'products.id',
                'products.product_name',
                'products.price',
                'products.img_path',
                'companies.company_name'
                )
            ->where('likes.user_id', $user->id)
            ->orderBy('likes.created_at', 'desc')
            ->get();

            return view('mypage.index', compact('user', 'myProducts', 'purchaseHistory', 'favoriteProducts'));

    }
}

