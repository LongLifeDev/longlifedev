<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Userimage;
use DB;
class UserimagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userimages = Userimage::orderBy('created_at', 'desc')->paginate(9); 
        return view('userimages.index')->with('userimages', $userimages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Check for correct user
        if(!Auth::guest()){
            return view('userimages.create');
        }
        else {
            return redirect('/userimages')->with('error', 'Unauthorized');
        }
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|nullable|max:1999'
        ]);

        //Handle File Upload
        if($request->hasFile('image')){
            //Get the filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            //Get just the filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just the extension
            $extension = $request->file('image')->getClientOriginalExtension();
            //File name to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload image
            $path = $request->file('image')->storeAs('public/user_images', $fileNameToStore);
         } else { 
             $fileNameToStore = 'noimage.jpg';
        }

        //Create Post
        $image = new Userimage;
        $image->title = $request->input('title');
        $image->description = $request->input('description');
        $image->is_profile = $request->input('profile');
        $image->user_id = auth()->user()->id;
        $image->image = $fileNameToStore;
        $image->save();

        return redirect('/userimages')->with('success', 'Image Uploaded');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $image = Userimage::find($id);
        return view('userimages.show')->with('image', $image);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Userimage::find($id);

        //Check for correct user
        if(auth()->user()->id !== $image->user_id){
            return redirect('/dashboard')->with('error', 'Unauthorized');
        }

        //if($image->image != 'noimage.jpg'){
            //Delete Image.
            Storage::delete('public/user_images/'.$image->image);
        //}

        $image->delete();
        return redirect('/dashboard')->with('success', 'Image Removed');
    }
    
}
