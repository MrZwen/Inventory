<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function users()
    {
        $usersData = $this->userService->getAll();
        return view($usersData['view'], $usersData['items']);
    }

    public function store(Request $request)
    {
        $result = $this->userService->create($request->all());

        // dd($result);

        if (!$result['success']) {
            return redirect()->back()->withErrors($result['errors'])->withInput();
        }

        return redirect()->back()->with('success', 'User created successfully!');
    }

    public function update(Request $request, $id)
    {
        $result = $this->userService->updateUser($id, $request->all());

        if ($result['success']) {
            Alert::toast('User updated successfully!', 'success', ['timer' => 3000]);
        } else {
            Alert::toast('Failed to update user.', 'error', ['timer' => 3000]);
        }

        return redirect()->back();
    }

    public function delete($id)
    {
        $result = $this->userService->delete($id);

        if (!$result) {
            Alert::toast('Failed to delete user.', 'error', ['timer' => 3000]);
            return redirect()->back();
        }

        Alert::toast('User deleted successfully!', 'success', ['timer' => 3000]);
        return redirect()->back();
    }
}
