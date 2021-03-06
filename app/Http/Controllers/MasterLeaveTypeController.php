<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\MasterLeaveType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;

class MasterLeaveTypeController extends Controller
{
    public function index()
    {
        if(Gate::denies('is_admin')){
            Alert::error('403 - Unauthorized', 'Halaman tersebut hanya bisa diakses oleh Admin!')->width(600);
            return back();
        }elseif(Gate::allows('is_admin')){
            $user = Auth::user();
            $leavetype = MasterLeaveType::paginate(5);

            return view('masterData.leavetype.list',['leavetype'=>$leavetype,
                'name'=>$user->name,
                'profile_photo'=>$user->profile_photo,
                'email'=>$user->email,
                'id'=>$user->id
            ]);
        }
        
    }

    public function create()
    {
        if(Gate::denies('is_admin')){
            Alert::error('403 - Unauthorized', 'Halaman tersebut hanya bisa diakses oleh Admin!')->width(600);
            return back();
        }elseif(Gate::allows('is_admin')){
            $user = Auth::user();
            return view('masterData.leavetype.create',[
                'name'=>$user->name,
                'profile_photo'=>$user->profile_photo,
                'email'=>$user->email,
                'id'=>$user->id
            ]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'default_day'=>'required|numeric'
        ]);
        MasterLeaveType::create($request->all());
        $user = Auth::user()->name;
        activity()->log($user.' telah menambahkan tipe cuti baru' .'('. $request->name.')');
        Alert::success('Berhasil!', 'Tipe Cuti baru telah ditambahkan!');
        return redirect('/admin/paid-leave-type');
    }

    public function edit(MasterLeaveType $leavetype)
    {
        if(Gate::denies('is_admin')){
            Alert::error('403 - Unauthorized', 'Halaman tersebut hanya bisa diakses oleh Admin!')->width(600);
            return back();
        }elseif(Gate::allows('is_admin')){
            $user = Auth::user();
            return view('masterData.leavetype.edit',['cuti' => $leavetype,
                'name'=>$user->name,
                'profile_photo'=>$user->profile_photo,
                'email'=>$user->email,
                'id'=>$user->id
            ]);
        }
    }

    public function update(Request $request, MasterLeaveType $leavetype)
    {
        $request->validate([
            'name'=>'required',
            'default_day'=>'required|numeric'
        ]);
        $past = MasterLeaveType::where('id',$leavetype->id)->get();
        MasterLeaveType::where('id',$leavetype->id)->update([
            'name'=>$request->name,
            'default_day'=>$request->default_day
        ]);
        $user = Auth::user()->name;
        activity()->log($user.' telah memperbarui tipe cuti '.'(' .$past[0]->name .')'.' ('.$past[0]->default_day.' hari)'. ' menjadi '.$request->name . ' ('.$request->default_day.' hari)');
        Alert::success('Berhasil!', 'Tipe Cuti '. $leavetype->name . ' berhasil diperbaharui');
        return redirect('admin/paid-leave-type');
    }

    public function destroyAll(Request $request){
        foreach ($request->selectid as $item) {
            MasterLeaveType::where('id','=',$item)->delete();
        }
        Alert::success('Berhasil!', 'Tipe Cuti yang dipilih berhasil dihapus!');
        return redirect('/admin/paid-leave-type');
    }

    public function toogle_status(Request $request){
        if ($request->status == 'Aktif') {$change = 'Non-Aktif';}
        else {$change = 'Aktif';}
        MasterLeaveType::where('id', $request->id)->update(['status' => $change]);
        return response()->json(['name'=> $request->name, 'status' => $change]);
    }
}
