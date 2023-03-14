<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Users\UpdateUserProfileAction;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct()
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

    public function show(): View
    {
        return view('personal.index', ['user' => Auth::user()]);
    }

    public function edit(): View
    {
        return view('personal.edit', ['user' => Auth::user()]);
    }

    public function update(UserUpdateRequest $request, UpdateUserProfileAction $updateUserAction): RedirectResponse
    {
        $userUpdateData = $request->getDTO();

        $updateUserAction($userUpdateData);

        return redirect()->route('personal.index');
    }

    public function destroy($id)
    {
        //
    }
}
