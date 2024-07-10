<?php


namespace App\Http\Controllers\API;


use App\Helper\CustomController;
use App\Models\Cart;
use App\Models\Item;

class CartController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->request->method() === 'POST') {
            return $this->addToCart();
        }
        try {
            $userID = auth()->id();
            $carts = Cart::with(['item'])
                ->whereNull('transaction_id')
                ->where('user_id', '=', $userID)
                ->get();
            return $this->jsonSuccessResponse('success', $carts);
        } catch (\Exception $e) {
            return $this->jsonErrorResponse($e->getMessage());
        }
    }

    private function addToCart()
    {
        try {
            $itemID = $this->postField('item_id');
            $qty = (int)$this->postField('qty');
            $note = $this->postField('note');
            $isPoint = (int)$this->postField('is_point');
            $userID = auth()->id();

            $item = Item::with([])
                ->where('id', '=', $itemID)
                ->first();

            if (!$item) {
                return $this->jsonNotFoundResponse('item not found...');
            }

            $price = $item->price;
            if ($isPoint === 1) {
                $price = $item->price_point;
            }

            $subTotal = $price * $qty;
            $data_request = [
                'transaction_id' => null,
                'item_id' => $itemID,
                'user_id' => $userID,
                'note' => $note,
                'price' => $price,
                'qty' => $qty,
                'sub_total' => $subTotal,
                'is_point' => $isPoint === 1 ? true : false
            ];
            Cart::create($data_request);
            return $this->jsonSuccessResponse('success');
        } catch (\Exception $e) {
            return $this->jsonErrorResponse($e->getMessage());
        }
    }
}
