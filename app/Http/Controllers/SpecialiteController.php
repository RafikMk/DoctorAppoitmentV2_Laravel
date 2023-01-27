<?php

namespace App\Http\Controllers;

use App\Specialite;
use Illuminate\Http\Request;

class SpecialiteController extends Controller
{
    public function index()
    {
        $specialites = Specialite::all();       
        return view('admin.specialite.index', compact('specialites'));
    }
    public function getSpec(){
        $specialites = Specialite::all();  
        return $specialites;
    } 

  
    public function create()
    {
        
        return view('admin.specialite.create');
    }

    public function store(Request $request)
    {
        $specialite=new Specialite;
        $specialite->specialite=$request->specialite;
        $specialite->color=$request->color;
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,jpg,png,svg',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destination = public_path('/icons');
            $image->move($destination, $name);
            $specialite->image=$name;
        } 
        $specialite->save();   
        return redirect()->back()->with('message', 'specialite added successfully!');
    }

    public function edit($id)
    {
        $specialite = Specialite::find($id);
        return view('admin.specialite.edit', compact('specialite'));
    }

    public function update(Request $request, $id)
    {
        $specialite = Specialite::find($id);
        $specialite->specialite = $request->specialite;
        $specialite->color=$request->color;
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,jpg,png,svg',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destination = public_path('/icons');
            $image->move($destination, $name);
            $specialite->image=$name;
        } 
        $specialite->save();

        return redirect()->route('specialite.index')->with('message', 'specialite updated successfully!');
    }

    

    public function destroy($id)
    {
        $specialite = Specialite::find($id);
        $specialite->delete();

        return redirect()->route('specialite.index')->with('message', 'specialite deleted successfully!');
    }
}


