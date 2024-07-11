<?php


namespace App\Http\Controllers\API;


use App\Helper\CustomController;
use App\Models\Transaction;

class TransactionController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        try {
            $userID = auth()->id();
            $data = Transaction::with([])
                ->where('user_id', '=', $userID)
                ->orderBy('created_at', 'DESC')
                ->get();
            return $this->jsonSuccessResponse('success', $data);
        }catch (\Exception $e) {
            return $this->jsonErrorResponse($e->getMessage());
        }
    }
}
