<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;

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
        ],[
            'name.required' => 'Name is required.',
            'username.required' => 'Username is required.',
            'username.unique' => 'Username already exists.',
            'email.required' => 'Email is required.',
            'email.unique' => 'Email already exists.',
        ]);
    
        if ($validator->fails()) {
            $errors = $validator->errors();

            foreach ($errors->messages() as $field => $messages) {
                foreach ($messages as $message) {
                    Alert::toast(ucfirst($field) . ': ' . $message, 'error', ['timer' => 3000]);
                }
            }
            
            return ['success' => false, 'errors' => $errors];
        }
    
        $data['password'] = bcrypt($data['password']);
        $user = $this->userRepository->create($data);
    
        $message = $user ? 'User created successfully!' : 'Failed to create user.';
        $type = $user ? 'success' : 'error';
        Alert::toast($message, $type, ['timer' => 3000]);
    
        return ['success' => (bool) $user, 'user' => $user];
    }

    // public function updateUser($id, array $data)
    // {
    //     // Validate input
    //     $validator = Validator::make($data, [
    //         'name' => 'required|string|max:255',
    //         'username' => 'required|string|max:255',
    //         'email' => 'required|email|max:255|unique:users,email',
    //         'password' => 'required|string|min:8|confirmed',
    //         'role_id' => 'required|exists:roles,id',
    //     ],[
    //         'name.required' => 'Name is required.',
    //         'username.required' => 'Username is required.',
    //         'username.unique' => 'Username already exists.',
    //         'email.required' => 'Email is required.',
    //         'email.unique' => 'Email already exists.',
    //     ]);

    //     if ($validator->fails()) {
    //         foreach ($validator->errors()->messages() as $field => $messages) {
    //             foreach ($messages as $message) {
    //                 Alert::toast(ucfirst($field) . ': ' . $message, 'error', ['timer' => 3000]);
    //             }
    //         }
    //         return ['success' => false, 'errors' => $validator->errors()];
    //     }

    //     // Hash password if present
    //     if (isset($data['password']) && !empty($data['password'])) {
    //         $data['password'] = Hash::make($data['password']);
    //     } else {
    //         unset($data['password']);
    //     }

    //     // Update user
    //     $updated = $this->userRepository->update($id, $data);

    //     $message = $updated ? 'User updated successfully!' : 'Failed to update user.';
    //     $type = $updated ? 'success' : 'error';
    //     Alert::toast($message, $type, ['timer' => 3000]);

    //     return ['success' => $updated];
    // }
    public function updateUser($id, array $data)
    {
        // Log request data untuk debugging
        Log::info('Updating user with ID: ' . $id, $data);

        // Validasi input
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'username' => "required|string|max:255|unique:users,username,{$id}",
            'email' => "required|email|max:255|unique:users,email,{$id}",
            'password' => 'nullable|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', $validator->errors()->toArray());
        
            // Ambil semua error
            $errors = $validator->errors()->all(); 
        
            // Pastikan pesan error muncul di Toast
            foreach ($errors as $message) {
                Alert::toast($message, 'error', ['timer' => 3000]);
            }
        
            return ['success' => false, 'errors' => $validator->errors()];
        }

        // Hash password jika ada perubahan
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        // Coba update user
        $updated = $this->userRepository->update($id, $data);
        
        // Log hasil update
        if ($updated) {
            Log::info('User updated successfully');
            Alert::toast('User updated successfully!', 'success', ['timer' => 3000]);
        } else {
            Log::error('User update failed');
            Alert::toast('Failed to update user.', 'error', ['timer' => 3000]);
        }

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
