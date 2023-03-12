<?php

namespace App\Http\Controllers;

use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserGroupController extends Controller
{
    public function index(): Response|bool
    {
        return false;
    }

    public function create(): Response|bool
    {
        return false;
    }

    public function store(Request $request): Response|bool
    {
        return false;
    }

    public function show(UserGroup $userGroup): Response|bool
    {
        return false;
    }

    public function edit(UserGroup $userGroup): Response|bool
    {
        return false;
    }

    public function update(Request $request, UserGroup $userGroup): Response|bool
    {
        return false;
    }

    public function destroy(UserGroup $userGroup): Response|bool
    {
        return false;
    }
}
