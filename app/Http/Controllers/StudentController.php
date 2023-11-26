<?php

namespace App\Http\Controllers;

use App\Models\{Parcel, User};
use Illuminate\Http\Request;
use DataTables;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $students = User::byRole('student')->get();
            return datatables()->of($students)
                ->addIndexColumn()
                ->addColumn('phone_number_my', function ($item) {
                    return $item->phone_number_my;
                })
                ->addColumn('action', function ($row) {
                    $html = '<a href="' . route('student.show', $row) . '" class="btn btn-xs btn-primary">View</a> ';
                    return $html;
                })->toJson();
        }

        return view('student.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user)
    {
        if ($request->ajax()) {
            $students = Parcel::where('user_id', $user->id)->get();
            return datatables()->of($students)
                ->addIndexColumn()
                ->addColumn('date_my', function ($item) {
                    return $item->date->format('d-m-Y');
                })
                ->addColumn('action', function ($row) use ($user) {
                    $html = '<a href="' . route('student.parcel.destroy', ['user' => $user->id, 'parcel' => $row->id]) . '" class="btn btn-xs btn-danger">Delete</a>';
                    return $html;
                })->toJson();
        }

        return view('student.show', compact('user'));
    }

    public function parcelCreate(User $user)
    {
        return view('student.parcel-create', compact('user'));
    }

    public function parcelStore(Request $request, User $user)
    {
        $request->validate([
            'parcel_no' => 'required',
            'courier_name' => 'required',
            'date' => 'required'
        ]);

        Parcel::create([
            'user_id' => $user->id,
            'admin_id' => auth()->user()->id,
            'parcel_no' => $request->parcel_no,
            'courier' => $request->courier_name,
            'date' => $request->date,
        ]);

        return redirect()->route('student.show', $user)->with('success', 'You have successfully add parcel.');
    }

    public function parcelDestroy(User $user, Parcel $parcel)
    {
        $parcel->delete();

        return redirect()->route('student.show', $user)->with('danger', 'You have successfully delete parcel.');
    }
}
