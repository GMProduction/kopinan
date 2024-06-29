<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function json()
    {
        return Category::all();
    }

    public function postData()
    {
        request()->validate([
            'name' => 'required'
        ]);
        try {
            $category = new Category();
            $cat      = $category->create(request()->all());

            return response()->json([
                'payload' => $cat,
                'message' => 'success',
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

}
