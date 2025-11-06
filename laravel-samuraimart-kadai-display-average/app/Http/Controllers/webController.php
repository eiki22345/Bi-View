<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\MajorCategory;
use App\Models\Product;

class webController extends Controller
{

    public function index(Request $request)
    {

        $keyword = $request->keyword;

        if ($request->category !== null) {
            $products = Product::where('category_id', $request->category)->withAvg('reviews', 'score')->Sortable()->paginate(15);
            $total_count  = Product::where('category_id', $request->category)->count();
            $category = Category::find($request->category);
            $major_category = MajorCategory::find($category->major_category_id);
        } elseif ($keyword !== null) {
            $products = Product::where('name', 'like', "%{$keyword}%")->withAvg('reviews', 'score')->Sortable()->paginate(15);
            $total_count = $products->total();
            $category = null;
            $major_category = null;
        } else {

            $category = null;
            $major_category = null;
            $major_category = null;
        }
        $categories = Category::all();
        $major_categories = MajorCategory::all();

        $products = Product::withAvg('reviews', 'score')->sortable()->paginate(15);

        $categories = Category::all();

        $major_categories = MajorCategory::all();

        $recently_products = Product::orderby('created_at', 'desc')->withAvg('reviews', 'score')->take(4)->get();

        $recommend_products = Product::where('recommend_flag', true)->withAvg('reviews', 'score')->take(3)->get();

        return view('web.index', compact('major_categories', 'categories', 'recently_products', 'recommend_products', 'products'));
    }
}
