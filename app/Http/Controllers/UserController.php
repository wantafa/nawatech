<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function dataJson()
    {
        return DataTables::of(User::orderByDesc('id')->get())
            ->addColumn('action', function ($row) {
                // <a href="'.route("user.show", $row->id).'" class="btn btn-info shadow btn-md me-1"><i class="fa fa-eye text-white"></i></a>

                $action = '<a href="javascript:void(0);" class="btn btn-md btn-edit" data-id="' . $row->id . '" data-name="' . $row->name . '" data-email="' . $row->email . '" data-role="' . $row->role . '"><i class="bx bxs-edit"></i></a> <a href="javascript:void(0);" data-id="' . $row->id . '" class="btn btn-md btn-delete"><i class="bx bxs-trash"></i></a>';
                return $action;
            })
            ->addIndexColumn()
            ->make(true);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('user.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'email' => 'required',
        ]);

        $req_user = $request->all();

        if ($request->id) {

            $user = User::find($request->id);

            $image = $user->image;

        if ($request->hasFile('image')) {
            File::delete($user->image);
            
            $image = 'uploads/images/profile/'. time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move('uploads/images/profile', $image);

        }
            $req_user['image'] = $image;

            $user->update($req_user);
            $message = "Data User Berhasil diupdate";


        } else {

            if ($request->hasFile('image')) {
                $image = 'uploads/images/profile/'. time() . '_' . $request->file('image')->getClientOriginalName(); 
                $request->file('image')->move('uploads/images/profile', $image);
                
                $req_user['image'] = $image;
            }
            $user = User::create($req_user);
            $message = "Data User Berhasil Disimpan";

        }

        return back()->with('success', $message);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function ubah_pass(Request $request)
    {
        $user = User::find($request->id);

        User::where('id', $user->id)
        ->update([
            'password' => Hash::make($request->password),
        ]);
        return back()->with('success', 'Password telah diubah');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function profil()
    {
        $profil = auth()->user();

        return view('user.profile', compact('profil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return back()->with('success', 'Data User Berhasil Dihapus');

    }
}
