<?php

namespace App\Http\Controllers;

use App\User;
use App\Specialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {  
        $specialites=Specialite::all();
        return view('profile.index', compact('specialites'));
    }
    public function review($id,$review)

    {  
        $user = User::findOrFail($id);
$totalreview = $user->totalreview ;
$numeroOfreview = $user->numeroOfreview ;

        User::where('id', $id)->update([
        'totalreview' => $review+$totalreview,
        'numeroOfreview' => 1+$numeroOfreview

        
    ]);    return response()->json(['message' => 'review updated successfully!'], 200);

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'gender' => 'required',
            
        ]);

        User::where('id', auth()->id())
            ->update($request->except('_token'));

        return redirect()->back()->with('message', 'Profile updated successfully!');
    }
    public function updateAvatarapi(Request $request)
    {
      //  $request->user_id=2 ;
     //  dd($request->user_id);
    // dd($request) ;
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,jpg,png',
            'user_id' => 'required|exists:users,id',
        ]);
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destination = public_path('/profile');
            $image->move($destination, $name);
    
            User::where('id', $request->user_id)
                ->update(['image' => $name]);
    
            return response()->json(['message' => 'Avatar updated successfully!']);
        }
    }
    public function storeapi(Request $request, $id)
{

    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'gender' => 'required',
    ],[
        'name.required' => 'Name field is required',
        'gender.required' => 'Gender field is required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 400);
    }
    User::where('id', $id)->update([
        'name' => $request->name,
        'email' => $request->email,
        'status' => $request->status,
        'role_id' => $request->role_id,
        'address' => $request->address,
        'phone_number' => $request->phone_number,
        'specialite' => $request->specialite,
        'image' => $request->image,
        'education' => $request->education,
        'description' => $request->description,
        'gender' => $request->gender,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        
    ]);    return response()->json(['message' => 'Profile updated successfully!'], 200);
}

    public function updateAvatar(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,jpg,png',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destination = public_path('/profile');
            $image->move($destination, $name);

            User::where('id', auth()->id())
                ->update(['image' => $name]);

            return redirect()->back()->with('message', 'Avatar updated successfully!');
        }
    }
}
