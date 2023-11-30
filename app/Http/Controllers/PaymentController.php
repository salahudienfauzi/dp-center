<?php

namespace App\Http\Controllers;

use App\Models\{Parcel, Payment};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $students = Parcel::where('user_id', auth()->user()->id)->get();
            return datatables()->of($students)
                ->addIndexColumn()
                ->addColumn('date_my', function ($item) {
                    return $item->date->format('d-m-Y');
                })
                ->addColumn('action', function ($item) {
                    $html = $item->payment ? '<span class="badge badge-success">PAID</span>' : '<a href="' . route('payment.edit', $item->id) . '" class="btn btn-xs btn-primary">Pay</a>';
                    return $html;
                })
                ->toJson();
        }

        return view('payment.index');
    }

    public function edit(Parcel $parcel)
    {
        return view('payment.edit', compact('parcel'));
    }

    public function update(Request $request, Parcel $parcel)
    {
        $request->validate([
            'payment_option' => 'required',
            'pick_up_option' => 'required'
        ]);

        try {
            if ($request->payment_option == '2') {
                $someData = [
                    'userSecretKey' => 'eo71frxq-cc59-wadq-gx5j-6ukytqwtrg3a',
                    'categoryCode' => 'srf69fys',
                    'billName' => auth()->user()->name,
                    'billDescription' => 'Parcel services using online payment',
                    'billPriceSetting' => 1,
                    'billPayorInfo' => 0,
                    'billAmount' => $request->price * 100,
                    'billReturnUrl' => route('payment.receipt', $parcel),
                    'billCallbackUrl' => '#',
                    'billExternalReferenceNo' => $parcel->id,
                    'billTo' => auth()->user()->name,
                    'billEmail' => auth()->user()->email,
                    'billPhone' => auth()->user()->phone,
                    'billPaymentChannel' => '2',
                ];

                $curl = curl_init();
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_URL, 'https://dev.toyyibpay.com/index.php/api/createBill');
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $someData);

                $result = curl_exec($curl);
                $info = curl_getinfo($curl);
                curl_close($curl);

                $obj = json_decode($result);

                if (isset($obj[0]->BillCode)) {
                    $billCode = $obj[0]->BillCode;
                    $redirectUrl = "https://dev.toyyibpay.com/$billCode";

                    return Redirect::away($redirectUrl);
                } else {
                    return redirect()->route('payment.index')->with('fail', 'Invalid response from ToyyibPay');
                }
            }
        } catch (\Throwable $th) {
            return redirect()->route('payment.edit', $parcel)->with('danger', 'Your payment has failed. Kindly consider trying to proceed payment again. If you continue to experience issues, please contact our support team for further assistance. We appreciate your understanding.');
        }

        Payment::create([
            'parcel_id' => $parcel->id,
            'type' => $request->payment_option,
            'pick_up' => $request->pick_up_option,
            'price' => $request->price
        ]);

        return redirect()->route('payment.receipt', $parcel);
    }

    public function receipt(Request $request, Parcel $parcel)
    {
        return view('payment.receipt', compact('parcel'));
    }
}
