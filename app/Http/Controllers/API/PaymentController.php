<?php


namespace App\Http\Controllers\API;


use App\Helper\CustomController;
use App\Models\Transaction;
use Ramsey\Uuid\Uuid;

class PaymentController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($id)
    {
        try {
            $transaction = Transaction::with('cart.item')
                ->where('id', '=', $id)
                ->first();
            if (!$transaction) {
                return $this->jsonNotFoundResponse('transaction not found');
            }

            $data_request = [
                'status_pembayaran' => 0
            ];
            if ($this->request->hasFile('file')) {
                $file = $this->request->file('file');
                $extension = $file->getClientOriginalExtension();
                $document = Uuid::uuid4()->toString() . '.' . $extension;
                $storage_path = public_path('assets/bukti');
                $documentName = $storage_path . '/' . $document;
                $data_request['image_payment'] = '/assets/bukti/' . $document;
                $file->move($storage_path, $documentName);
            } else {
                return $this->jsonBadRequestResponse('no image attached');
            }
            $transaction->update($data_request);
            return $this->jsonSuccessResponse('success');
        } catch (\Exception $e) {
            return $this->jsonErrorResponse($e->getMessage());
        }
    }
}
