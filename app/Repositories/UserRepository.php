<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAll()
    {
        return $this->user->all();
    }

    public function findById($id)
    {
        return $this->user->find($id);
    }

    public function create(array $data)
    {
        return $this->user->create($data);
    }

    public function update($id, array $data)
    {
        $user = $this->findById($id);

        if (!isset($data['role_id'])) {
            $data['role_id'] = $user->role_id;
        }
    
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
    
        return $user->update($data);
    }

    public function delete($id)
    {
        $user = $this->findById($id);
        return $user->delete();
    }
}
