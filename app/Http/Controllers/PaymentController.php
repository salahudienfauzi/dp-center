<?php

namespace App\Http\Controllers;

use App\Models\{Parcel, Payment};
use Illuminate\Http\Request;
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
            'pick_up_option' => 'required',
            'receipt' => 'required_if:payment_option,transfer'
        ]);

        $filepath = null;
        if ($request->receipt) {
            $extension = $request->receipt->extension();
            $filename = now()->format('Ymd_Hisv') . '.' . $extension;
            $filepath = 'receipt/' . $filename;

            Storage::disk('public')->put($filepath, file_get_contents($request->receipt));
        }

        Payment::create([
            'parcel_id' => $parcel->id,
            'type' => $request->payment_option == 'cash' ? 1 : 2,
            'pick_up' => $request->pick_up_option,
            'file_path' => $filepath
        ]);

        return redirect()->route('payment.index')->with('success', 'You have successfully pay for your parcel.');
    }
}
