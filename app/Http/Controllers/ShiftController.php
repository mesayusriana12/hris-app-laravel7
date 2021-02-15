<?php

namespace App\Http\Controllers;

use App\MasterShift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $shift = MasterShift::paginate(5);
        return view('masterdata.shift.list',[
            'shift' => $shift,
            'name'=>$user->name,
            'profile_photo'=>$user->profile_photo,
            'email'=>$user->email,
            'id'=>$user->id
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('masterdata.shift.create', [
            'name'=>$user->name,
            'profile_photo'=>$user->profile_photo,
            'email'=>$user->email,
            'id'=>$user->id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'start_working_time' => 'required',
            'end_working_time' => 'required'
        ]);
        MasterShift::create($request->all());
        Alert::success('Berhasil!', 'Shift baru telah ditambahkan!');
        return redirect('/admin/shift');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterShift $shift)
    {
        $user = Auth::user();
        return view('masterdata.shift.edit',[
            'shift' => $shift,
            'name'=>$user->name,
            'profile_photo'=>$user->profile_photo,
            'email'=>$user->email,
            'id'=>$user->id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterShift $shift)
    {
        $request->validate([
            'name' => 'required',
            'start_working_time' => 'required',
            'end_working_time' => 'required'
        ]);
        MasterShift::where('id', $shift->id)
            ->update([
                'name' => $request->name,
                'start_working_time' => $request->start_working_time,
                'end_working_time' => $request->end_working_time
            ]);
            Alert::success('Berhasil!', 'Shift '. $shift->name . ' telah diperbaharui!');
        return redirect('/admin/shift');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterShift $shift)
    {
        MasterShift::destroy($shift->id);
        return redirect('/admin/shift');
    }
    public function destroyAll(Request $request){
        foreach ($request->selectid as $item) {
            DB::table('master_shifts')->where('id','=',$item)->delete();
        }
        Alert::success('Berhasil!', 'Shift yang dipilih berhasil dihapus!');
        return redirect('/admin/shift');
    }
}
