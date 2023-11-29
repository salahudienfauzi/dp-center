<?php

namespace App\Http\Controllers;

use App\Models\{Parcel, Payment};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = null;
        if (auth()->user()->id != 1) {
            $filter = auth()->user()->id;
        }

        if ($request->ajax()) {
            $students = Parcel::when($filter, function($query, $filter) {
                    return $query->where('user_id', $filter);
                })
                ->whereHas('payment')
                ->get();

            return datatables()->of($students)
                ->addIndexColumn()
                ->addColumn('date_my', function ($item) {
                    return $item->date->format('d-m-Y');
                })
                ->addColumn('action', function ($item) {
                    $html = '<a href="' . route('history.show', $item->id) . '" class="btn btn-xs btn-primary">View</a>';
                    return $html;
                })
                ->toJson();
        }

        return view('history.index');
    }

    public function show(Parcel $parcel)
    {
        return view('history.show', compact('parcel'));
    }
}
