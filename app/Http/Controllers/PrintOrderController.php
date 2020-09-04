<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pixelpeter\Woocommerce\Facades\Woocommerce;

class PrintOrderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->id) {
            try {
                $order = Woocommerce::get('orders/'.$request->id);
                $order = (object) $order;

            } catch (\Exception $ex) {
                dd("Invalid Order Id");
            }


            return view('print',compact('order'));
        } else {
            return view('welcome');
        }
    }
}
