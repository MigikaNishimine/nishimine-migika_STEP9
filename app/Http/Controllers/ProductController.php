<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $query = DB::table('products')
        ->join('companies', 'products.company_id', '=', 'companies.id')
        ->select('products.*', 'companies.company_name');

        if ($request->filled('product_name')) {
            $query->where('products.product_name', 'like', '%' . $request->input('product_name') . '%');
        }

        if ($request->filled('company_id')) {
            $query->where('products.company_id', $request->input('company_id'));
        }

        if ($request->filled('price_min')) {
            $query->where('products.price', '>=', $request->input('price_min'));
        }

        if ($request->filled('price_max')) {
            $query->where('products.price', '<=', $request->input('price_max'));
        }

        if ($request->filled('comment')) {
            $query->where('products.comment', 'like', '%' . $request->input('comment') . '%');
        }

        if ($request->filled('img_path')) {
            $query->where('products.img_path', 'like', '%' . $request->input('img_path') . '%');
        }

        if ($request->filled('created_at')) {
            $query->where('products.created_at', 'like', '%' . $request->input('created_at') . '%');
        }

        if ($request->filled('updated_at')) {
            $query->where('products.updated_at', 'like', '%' . $request->input('updated_at') . '%');
        }

        $products = $query->paginate(10);
        $companies = DB::table('companies')->get();
        return view('products.index', compact('products', 'companies'));
    }
    public function show($id)
    {
        $product = DB::table('products')
        ->join('companies', 'products.company_id', '=', 'companies.id')
        ->select('products.*', 'companies.company_name')
        ->where('products.id', $id)
        ->first();
        $isLiked = DB::table('likes')
        ->where('user_id', Auth::id())
        ->where('product_id', $id)
        ->exists();

        return view('products.show', compact('product', 'isLiked'));

    }
    public function edit($id)
    {
        $product = DB::table('products')
            ->join('companies','products.company_id','=','companies.id')
            ->select('products.*','companies.company_name')
            ->where('products.id',$id)
            ->first();
        $companies = DB::table('companies')->get();
        return view('products.edit',compact('product','companies'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required',
            'price' => 'required|numeric',
            'company_id' => 'required',
            'comment' => 'nullable',
            'img_path' => 'nullable|image'
        ]);
        
        if ($request->hasFile('img_path')){
            $path = $request->file('img_path')->store('products','public');
        } else {
            $path = DB::table('products')->where('id',$id)->value('img_path');
        }
        
        DB::table('products')->where('id',$id)->update([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'company_id' => $request->company_id,
            'comment' => $request->comment,
            'img_path' => $path,
            'updated_at' => now(),
        ]);
        return redirect()->route('products.show', $id)->with('success','更新しました');
    }
    public function destroy($id)
    {
        DB::table('products')->where('id', $id)->delete();
        return redirect()->route('products.index')->with('success','削除しました');
    }
    public function create()
    {
        $companies = DB::table('companies')->get();
        return view('products.create',compact('companies'));
    }
    public function store(Request $request)
{
    $request->validate([
        'product_name' => 'required',
        'price' => 'required|numeric',
        'company_id' => 'required',
        'comment' => 'nullable',
        'img_path' => 'nullable|image'
    ]);

    if ($request->hasFile('img_path')) {
        $path = $request->file('img_path')->store('products', 'public');
    } else {
        $path = null;
    }

    DB::table('products')->insert([
        'product_name' => $request->product_name,
        'price' => $request->price,
        'company_id' => $request->company_id,
        'comment' => $request->comment,
        'img_path' => $path,
        'user_id' => Auth::id(), 
        'created_at' => now(),
        'updated_at' => now(),
    ]);

        return redirect()->route('products.index')->with('success', '登録しました');
}

}
