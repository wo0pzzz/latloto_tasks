<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;


class ScriptController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [];
        $db_data = DB::table('data')->get();

        $exports = [];
        $payments = [];
        $pay_ids = [];
        $new_export = [];

        foreach ($db_data as $key => $one) {
            $exports[$one->export_id][] = $one;
            $payments[$one->payment_id][] = $one;
        }

        foreach ($payments as $key => $payment) {
            foreach ($payment as $key2 => $one_pay) {
                if (isset($pay_ids[$one_pay->payment_id])) {
                    if (isset($pay_ids[$one_pay->payment_id]->count)) {
                        $pay_ids[$one_pay->payment_id]->count += 1;
                        $pay_ids[$one_pay->payment_id]->sum += $one_pay->sum;
                    } else {
                        $pay_ids[$one_pay->payment_id]->count = 1;
                    }
                } else {
                    $pay_ids[$one_pay->payment_id] = $one_pay;
                    $pay_ids[$one_pay->payment_id]->count = 1;
                }
            }
        }


        //$exp_count = [];
        foreach ($exports as $keyz => $export) {
            //$exp_count[$keyz] = count($export);
            $new_export[$keyz]['sum'] = 0;

            foreach ($pay_ids as $key2 => $pay_id) {
                if ($keyz == $pay_id->export_id) {
                    $new_export[$keyz][$key2] = $pay_id;
                    $new_export[$keyz]['sum'] += $pay_id->sum;
                }
            }
        }


        $data['exports'] = $new_export;
        $data['payments'] = $payments;
        //$data['exp_count'] = $exp_count;

        return view('public/script', $data);
    }
}
