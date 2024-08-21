<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\User;
use Yajra\DataTables\DataTables;

class TransactionController extends Controller
{
    public function datatable()
    {
        $data = Transaction::with('user');

        return DataTables::of($data)
            ->make(true);
    }

    public function datatableCart($id)
    {
        $data = Cart::with('item_all')->where('transaction_id', $id);

        return DataTables::of($data)
            ->make(true);
    }

    public function index()
    {
        return view('transaction.index');
    }

    public function detail($id)
    {
        $data = Transaction::with('user')->where('transaction_number', $id)->first();
        return view('transaction.detail', ['data' => $data]);
    }

    public function updateStatus()
    {
        $id = request('id');
        $stat = request('status');
        $type = request('type');

        try {
            $trans = Transaction::find($id);
            $user = User::find($trans->user_id);
            $points = intval($trans->total_price / 50000);


            if ($type == 'status_pembayaran' && $stat == 2) {
                if (file_exists('../public' . $trans->image_payment)) {
                    unlink('../public' . $trans->image_payment);
                }
                $trans->update([
                    'image_payment' => null
                ]);
            }

            if ($type == 'status_pembayaran' && $stat == 1) {
                $user->update([
                    'point' => $user->point + $points
                ]);
            }

            $trans->update([
                $type => $stat
            ]);
            return response()->json([
                'payload' => [],
                'message' => 'success',
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function checkNoTransaction($id)
    {
        $trans = Transaction::where('transaction_number', $id)->first();
        return response()->json([
            'payload' => $trans,
            'message' => 'success',
        ], 200);
    }
}
