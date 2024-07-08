<?php


namespace App\Http\Controllers\API;


use App\Helper\CustomController;
use App\Models\Category;

class CategoryController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        try {
            $categories = Category::with([])
                ->get();
            return $this->jsonSuccessResponse('success', $categories);
        } catch (\Exception $e) {
            return $this->jsonErrorResponse($e->getMessage());
        }
    }

    public function findByID($id)
    {
        try {
            $category = Category::with([])
                ->where('id', '=', $id)
                ->first();
            return $this->jsonSuccessResponse('success', $category);
        } catch (\Exception $e) {
            return $this->jsonErrorResponse($e->getMessage());
        }
    }
}
