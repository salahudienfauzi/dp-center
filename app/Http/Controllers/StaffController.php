<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $staffs = User::byRole('staff')->where('id', '!=', 1)->get();
            return datatables()->of($staffs)
                ->addIndexColumn()
                ->addColumn('phone_number_my', function ($item) {
                    return $item->phone_number_my;
                })
                ->addColumn('action', function ($row) {
                    $html = '<a href="' . route('staff.show', $row) . '" class="btn btn-xs btn-primary">View</a> ';
                    return $html;
                })->toJson();
        }

        return view('staff.index');
    }

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
                    $html = '<a href="' . route('staff.parcel.destroy', ['user' => $user->id, 'parcel' => $row->id]) . '" class="btn btn-xs btn-danger">Delete</a>';
                    return $html;
                })->toJson();
        }

        return view('staff.show', compact('user'));
    }

    public function parcelCreate(User $user)
    {
        return view('staff.parcel-create', compact('user'));
    }

    public function parcelStore(Request $request, User $user)
    {
        $request->validate([
            'parcel_no' => 'required',
            'courier_name' => 'required',
            'date' => 'required'
        ]);

        $parcel = Parcel::create([
            'user_id' => $user->id,
            'admin_id' => auth()->user()->id,
            'parcel_no' => $request->parcel_no,
            'courier' => $request->courier_name,
            'date' => $request->date,
        ]);

        $to_name = $user->name;
        $to_email = $user->email;

        $data = array(
            'name' => $to_name,
            'parcel_no' => $parcel->parcel_no,
            'courier_name' => $parcel->courier_name,
            'date' => $parcel->date->format('d/m/Y')
        );

        Mail::send('mail.parcel-notification', $data, function ($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Parcel Arrival Notification');
        });

        return redirect()->route('staff.show', $user)->with('success', 'You have successfully add parcel.');
    }

    public function parcelDestroy(User $user, Parcel $parcel)
    {
        $parcel->delete();

        return redirect()->route('staff.show', $user)->with('danger', 'You have successfully delete parcel.');
    }
}
