<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function index(Request $request)
    {
        $limit = 10;
        $categories = Category::orderBy('sort')
            ->paginate($limit);

        return view('back.category-index')
            ->with('categories', $categories);
    }
}
