<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll()
    {
        $users = $this->userRepository->getAll();
        $roles = Role::select('id', 'name')->get();
        
        $data = compact('users', 'roles');

        $roleName = Auth::user()->role->name;
        $view = $roleName == 'admin' ? 'admins.pages.users' : 'staff.pages.users';

        return ['view' => $view, 'items' => $data];
    }

    public function getUserById($id)
    {
        return $this->userRepository->findById($id);
    }

    public function create(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);
    
        if ($validator->fails()) {
            Alert::toast('Validation failed!', 'error', ['timer' => 3000]);
            return ['success' => false, 'errors' => $validator->errors()];
        }
    
        $data['password'] = bcrypt($data['password']);
        $user = $this->userRepository->create($data);
    
        $message = $user ? 'User created successfully!' : 'Failed to create user.';
        $type = $user ? 'success' : 'error';
        Alert::toast($message, $type, ['timer' => 3000]);
    
        return ['success' => (bool) $user, 'user' => $user];
    }

    public function updateUser($id, array $data)
    {
        // Validate input
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        if ($validator->fails()) {
            Alert::toast('Validation failed!', 'error', ['timer' => 3000]);
            return ['success' => false, 'errors' => $validator->errors()];
        }

        // Hash password if present
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        // Update user
        $updated = $this->userRepository->update($id, $data);

        $message = $updated ? 'User updated successfully!' : 'Failed to update user.';
        $type = $updated ? 'success' : 'error';
        Alert::toast($message, $type, ['timer' => 3000]);

        return ['success' => $updated];
    }

    public function delete($id)
    {
        $deleted = $this->userRepository->delete($id);

        $message = $deleted ? 'User deleted successfully!' : 'Failed to delete user.';
        $type = $deleted ? 'success' : 'error';
        Alert::toast($message, $type, ['timer' => 3000]);

        return $deleted;
    }
}
