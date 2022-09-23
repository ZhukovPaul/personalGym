<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserImage;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Storage};
use Thumbnail;

class UserController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(): ?string
    {
        $curUser = Auth::user();
        $img = Thumbnail::src(env('APP_URL') . $curUser->image->path)->smartcrop(220, 220)->url(true);

        return view('personal.index', ['user' => $curUser, 'smallImage' => $img]);
    }

    public function edit(): ?string
    {
        return view('personal.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $postParams = $request->only('id', 'name', 'lastname', 'birthday', 'email');
        $validationRules = [
            'name' => 'required|max:255',
            'birthday' => 'date',
            'file' => 'image',
            'email' => 'email'
        ];

        $request->validate($validationRules);

        $user = User::find($postParams['id']);
        $user->fill($postParams);
        $user->birthday = $postParams['birthday'];

        if ($request->hasFile('user_image_id')) {
            $uploadPicture = $request->file('user_image_id');
            $picturePath = Storage::putFile(
                'public',
                $uploadPicture,
                ['visibility' => Filesystem::VISIBILITY_PUBLIC]
            );

            $userPicture = new UserImage();
            $userPicture->path = $picturePath;
            $userPicture->save();

            $user->user_image_id = $userPicture->id;
        }
        $user->save();

        return redirect()->route('personalindex');
    }

    public function destroy($id)
    {
        //
    }
}
