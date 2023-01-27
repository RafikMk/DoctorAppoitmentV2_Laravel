<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.doctor.index', compact('users'));
    }
    public function GetAllDoctors()
    {
        $doctors = User::where('role_id', 1)->get();
return  $doctors ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.doctor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDoctorRequest $request)
    {
        $data = $request->validated();
        $name = (new User)->userAvatar($request);
        $data['status'] = "offline";
        $data['image'] = $name;
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->back()->with('message', 'Doctor has been added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.doctor.confirmDelete', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findorFail($id);
        return view('admin.doctor.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDoctorRequest $request, $id)
    {
        $data = $request->validated();

        $user = User::findOrFail($id);
        $userImage = $user->image;
        $userPassword = $user->password;

        if ($request->hasFile('image')) {
            $userImage = (new User)->userAvatar($request);
            unlink(public_path('profile/' . $user->image));
        }

        $data['image'] = $userImage;

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        } else {
            $data['password'] = $userPassword;
        }

        $user->update($data);

        return redirect()->route('doctor.index')->with('message', 'Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->id == $id) {
            abort(401);
        }

        $user = User::findOrFail($id);
        $deleted = $user->delete();

        if ($deleted) {
            unlink(public_path('profile/' . $user->image));

        }

        return redirect()->route('doctor.index')->with('message', 'Successfully Deleted!');
    }
}
