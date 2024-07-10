<?php


namespace App\Http\Controllers\API;


use App\Helper\CustomController;
use App\Models\Item;

class ItemController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        try {
            $priceType = $this->field('price_type');
            $query = Item::with(['category']);
            if ($priceType) {
                $query->where('price_point', '>', 0);
            }
            $items = $query->get();
            return $this->jsonSuccessResponse('success', $items);
        } catch (\Exception $e) {
            return $this->jsonErrorResponse($e->getMessage());
        }
    }

    public function findByID($id)
    {
        try {
            $item = Item::with(['category'])
                ->where('id', '=', $id)
                ->first();
            return $this->jsonSuccessResponse('success', $item);
        } catch (\Exception $e) {
            return $this->jsonErrorResponse($e->getMessage());
        }
    }

    public function findByCategoryID($id)
    {
        try {
            $item = Item::with(['category'])
                ->where('category_id', '=', $id)
                ->get();
            return $this->jsonSuccessResponse('success', $item);
        } catch (\Exception $e) {
            return $this->jsonErrorResponse($e->getMessage());
        }
    }
}
