<?php

namespace App\Repositories;

use App\Traits\StorageImage;
use Illuminate\Support\Str;
use App\Repositories\BaseRepository;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    use StorageImage;

    public function getModel()
    {
        return User::class;
    }

    public function getAll($searchTerm)
    {
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $searchTerm = str_replace($reservedSymbols, ' ', $searchTerm);

        if ($searchTerm != "") {
            $users =  $this->model::where('name', 'like', "%{$searchTerm}%")->orderByDesc('id')->paginate(5);
        }
        if ($searchTerm == "") {
            $users = $this->model->orderByDesc('id')->paginate(5);
        }
        return $users;
    }

    public function getSingle($slug)
    {
        $users = $this->model->where('slug', $slug)->first();
        return $users;
    }

    public function create($req)
    {
        $role = Role::where('name', $req->role)->first();
        $user = new $this->model;

        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->title = $req->title;
        $user->gender = $req->gender;
        $user->avatar_url = $req->avatar_url;
        $user->education = $req->education;
        $user->location = $req->location;
        $user->skills = $req->skills;
        $user->note = $req->note;
        $user->phone = $req->phone;
        $user->birthday = $req->birthday;
        $user->is_active = $req->is_active;
        $user->slug = Str::slug($req->name);

        $dataUploadImage = $this->storageImage($req, 'avatar_url', 'avatar_user');
        if (!empty($dataUploadImage)) {
            $user->avatar_name = $dataUploadImage['file_name'];
            $user->avatar_url = $dataUploadImage['file_path'];
        }

        $user->save();
        $user->roles()->attach($role);

        return $user->fresh();
    }

    public function update($id, $req)
    {

        $role = Role::where('name', $req->role)->first();

        $user = $this->model->find($id);
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->title = $req->title;
        $user->gender = $req->gender;
        $user->avatar_url = $req->avatar_url;
        $user->education = $req->education;
        $user->location = $req->location;
        $user->skills = $req->skills;
        $user->note = $req->note;
        $user->birthday = $req->birthday;
        $user->is_active = $req->is_active;
        $user->slug = Str::slug($req->name);
        $user->phone = $req->phone;


        $dataUploadImage = $this->storageImage($req, 'avatar_url', 'avatar_user');
        if (!empty($dataUploadImage)) {
            $user->avatar_name = $dataUploadImage['file_name'];
            $user->avatar_url = $dataUploadImage['file_path'];
        }

        $user->save();
        $user->roles()->attach($role);

        return $user;
    }

    public function delete($id)
    {
        $user = $this->model->findOrFail($id);
        $user->roles()->detach();
        $user->delete();

        return $user;
    }

    public function editProfile($id)
    {
        return $this->model::find($id);
    }

    public function updateProfile($req, $id)
    {

        $user = $this->model->find($id);
        $user->name = $req->name;
        $user->email = $req->email;
        $user->title = $req->title;
        $user->gender = $req->gender;
        $user->avatar_url = $req->avatar_url;
        $user->education = $req->education;
        $user->location = $req->location;
        $user->skills = $req->skills;
        $user->note = $req->note;
        $user->birthday = $req->birthday;
        $user->is_active = User::ACTIVE;
        $user->slug = Str::slug($req->name);
        $user->phone = $req->phone;

        $dataUploadImage = $this->storageImage($req, 'avatar_url', 'avatar_user');
        if (!empty($dataUploadImage)) {
            $user->avatar_name = $dataUploadImage['file_name'];
            $user->avatar_url = $dataUploadImage['file_path'];
        }

        $user->save();

        return $user;
    }
}
