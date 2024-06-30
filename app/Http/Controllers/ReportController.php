<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{

    public function datatable(){

        $data = Transaction::with('user')->where('status_pembayaran',1);
        if (request('start_date')){
            $data = $data->whereBetween('created_at',[request('start_date'),request('end_date')]);
        }

        return DataTables::of($data)
                         ->make(true);
    }

    public function index(){
        return view('report.index');
    }

}
