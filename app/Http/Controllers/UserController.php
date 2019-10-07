<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next){
            app()->setLocale(Auth::user()->language);
            return $next($request); 
        });
    }
    public function index()
    {
        $data['users'] = DB::table('users')
            ->join('roles', 'users.role_id', 'roles.id')
            ->orderBy('users.id', 'desc')
            ->select('users.*', 'roles.name as rname')
            ->paginate(config('app.row'));
        return view('users.index', $data);
    }
    // Create user function
    public function create()
    {
        $data['roles'] = DB::table('roles')
            ->where('active', 1)
            ->get();
        return view('users.create', $data);
    }
    // Save user function
    public function save(Request $r)
    {
        $data = array(
            'name' => $r->name,
            'email' => $r->email,
            'username' => $r->username,
            'role_id' => $r->role,
            'language' =>$r->language,
            'password' => bcrypt($r->password)
        );
        if($r->photo)
        {
            $data['photo'] = $r->file('photo')->store('uploads/users','custom');
        }
        $i = DB::table('users')
            ->insert($data);
        
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
    //Delete user function
    public function delete($id, Request $r)
    {
        DB::table('users')
            ->where('id', $id)
            ->delete();

        $r->session()->flash('success', 'Data has been removed!');
        return redirect('user');
    }
    //Edit user function
    public function edit($id)
    {
        $data['roles'] = DB::table('roles')
            ->where('active', 1)
            ->get();
        $data['user'] = DB::table('users')
            ->where('id', $id)
            ->first();
        return view('users.edit', $data);
    }
    //Update user function
    public function update(Request $r)
    {
        $data = array(
            'name' => $r->name,
            'email' => $r->email,
            'username' => $r->username,
            'language' =>$r->language,
            'role_id' => $r->role
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
    //User logout
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
