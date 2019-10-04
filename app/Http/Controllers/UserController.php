<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class UserController extends Controller
{
    public function index()
    {
        $data['users'] = DB::table('users')
            ->orderBy('id', 'desc')
            ->paginate(config('app.row'));
        return view('users.index', $data);
    }

    public function create()
    {
        return view('users.create');
    }

    public function save(Request $r)
    {
        $data = array(
            'name' => $r->name,
            'email' => $r->email,
            'username' => $r->username,
            'password' => bcrypt($r->password)
        );
        if($r->photo)
        {
            $data['photo'] = $r->file('photo')->store('uploads/users','custom');
        }
        $i = DB::table('users')->insert($data);
        
        if($i)
        {
            $r->session()->flash('success', 'Data has been save!');
            return redirect('user/create');
        }
        else{
            $r->session()->flash('error', 'Fail to save data!');
            return redirect('user/create')->withInput();
        }
    }
    public function delete($id, Request $r)
    {
        DB::table('users')
            ->where('id', $id)
            ->delete();

        $r->session()->flash('success', 'Data has been removed!');
        return redirect('user');
    }

    public function edit($id)
    {
        $data['user'] = DB::table('users')->where('id', $id)->first();
        return view('users.edit', $data);
    }

    public function update(Request $r)
    {
        $data = array(
            'name' => $r->name,
            'email' => $r->email,
            'username' => $r->username,
        );

        if($r->password!="")
        {
            $data['password'] = bcrypt($r->password);
        }
        if ($r->photo) {
            $data['photo'] = $r->file('photo')->store('uploads/users', 'custom');
        }
        $i = DB::table('users')->where('id', $r->id)->update($data);

        if ($i) {
            $r->session()->flash('success', 'Data has been updated!');
            return redirect('user/edit/' .$r->id);
        } else {
            $r->session()->flash('error', 'Fail to update data!');
            return redirect('user/edit/' .$r->id);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
