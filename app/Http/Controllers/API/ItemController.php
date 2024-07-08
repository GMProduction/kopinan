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
            $items = Item::with(['category'])
                ->get();
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
}
