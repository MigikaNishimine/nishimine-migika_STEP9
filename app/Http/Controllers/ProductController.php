<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Company;
use App\Models\Like;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Product::with('company');

        if ($request->filled('product_name')) {
            $query->where('product_name', 'like', '%' . $request->product_name . '%');
        }

        if ($request->filled('company_id')) {
            $query->where('company_id', $request->company_id);
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        if ($request->filled('comment')) {
            $query->where('comment', 'like', '%' . $request->comment . '%');
        }

        if ($request->filled('img_path')) {
            $query->where('img_path', 'like', '%' . $request->img_path . '%');
        }

        if ($request->filled('created_at')) {
            $query->whereDate('created_at', $request->created_at);
        }

        if ($request->filled('updated_at')) {
            $query->whereDate('updated_at', $request->updated_at);
        }

        $products = $query->paginate(10);
        $companies = Company::all();

        return view('products.index', compact('products', 'companies'));
    }

    
    public function show($id)
    {
        $product = Product::with('company')->findOrFail($id);

        $isLiked = Like::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->exists();

        return view('products.show', compact('product', 'isLiked'));

    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $companies = Company::all();

        return view('products.edit', compact('product', 'companies'));
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

        $product = Product::findOrFail($id);

        if ($request->hasFile('img_path')) {
            $path = $request->file('img_path')->store('products', 'public');
        } else {
            $path = $product->img_path;
        }

        $product->update([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'company_id' => $request->company_id,
            'comment' => $request->comment,
            'img_path' => $path,
            
        ]);

        return redirect()->route('products.show', $id)->with('success', '更新しました');
    }


    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->route('products.index')->with('success', '削除しました');
    }

    
    public function create()
    {
        $companies = Company::all();
        return view('products.create', compact('companies'));
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

        $path = $request->hasFile('img_path')
            ? $request->file('img_path')->store('products', 'public')
            : null;

        Product::create([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'company_id' => $request->company_id,
            'comment' => $request->comment,
            'img_path' => $path,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('products.index')->with('success', '登録しました');
    }
}
