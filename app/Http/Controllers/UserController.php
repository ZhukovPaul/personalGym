<?php

namespace App\Http\Controllers;

use App\Models\UserImage;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,Storage};

class UserController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {   

        $curUser = Auth::user();
        

        
        //$curUser->image->path =  \Thumbnail::src( env( 'APP_URL' ) . $curUser->image->path )->url( true );    
        $img =  \Thumbnail::src( env( 'APP_URL' ) . $curUser->image->path )->smartcrop(220, 220)->url( true );    
           
        return view('personal.index',["user"=>$curUser,'smallImage'=>$img]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( )
    {
        return view('personal.edit',["user"=>Auth::user()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request /*, $id*/)
    {
                  
        $postParams = $request->only("id","name","lastname","birthday","email");

        $validationRules = [
                "name"=>"required|max:255",
               // "lastname"=>"required|max:255",
                "birthday"=>"date",
                "file" => "image",
                "email"=>"email"
            ];
        $request->validate($validationRules);

   
        $user = \App\Models\User::find($postParams['id']);
        //dd($postParams);
        $user->fill($postParams);
        $user->birthday = $postParams["birthday"];

        if($request->hasFile("user_image_id")){
            $uploadPicture = $request->file("user_image_id"); 
            $picturePath = Storage::putFile("public",$uploadPicture,["visibility"=>Filesystem::VISIBILITY_PUBLIC]);

            $userPicture = new \App\Models\UserImage();
            $userPicture->path = $picturePath;
            $userPicture->save();

            $user->user_image_id = $userPicture->id; 
        }
        $user->save();
        
         return redirect()->route("personalindex");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
