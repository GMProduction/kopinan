<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use Yajra\DataTables\DataTables;

class TransactionController extends Controller
{
    public function datatable(){
        $data = Transaction::with('user');

        return DataTables::of($data)
                         ->make(true);
    }

    public function datatableCart($id){
        $data = Cart::with('item_all')->where('transaction_id',$id);

        return DataTables::of($data)
                         ->make(true);
    }

    public function index(){
        return view('transaction.index');

    }

    public function detail($id){
        $data = Transaction::with('user')->where('transaction_number', $id)->first();
        return view('transaction.detail', ['data' => $data]);
    }



}
