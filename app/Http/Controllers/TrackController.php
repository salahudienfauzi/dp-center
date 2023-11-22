<?php

namespace App\Http\Controllers;

use App\Models\{Parcel};
use Illuminate\Http\Request;

class TrackController extends Controller
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
                ->toJson();
        }

        return view('track.index');
    }
}
