<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class RoleController extends Controller
{
    public function index()
    {
        $data['roles'] = DB::table('roles')
            ->orderBy('id', 'desc')
            ->paginate(config('app.row'));
        return view('roles.index', $data);
    }
    public function detail($id)
    {
        $data['role'] = DB::table('roles')
            ->where('id', $id)
            ->first();
        $sql = "select permissions.alias, tbl.* from permissions
            left join (select * from role_permissions where role_id=$id) as tbl 
            on permissions.id = tbl.permission_id"; 

        $data['permissions'] = DB::select($sql);       
        return view('roles.detail', $data);
    }
    //Create Role Function
    public function create()
    {
        return view('roles.create');
    }
    // Save Role Function
    public function save(Request $r)
    {
        $data = array(
            'name' => $r->name
        );
        $i = DB::table('roles')->insert($data);
        
        if($i)
        {
            $r->session()->flash('success', 'Data has been save!');
            return redirect('role/create');
        }
        else{
            $r->session()->flash('error', 'Fail to save data!');
            return redirect('role/create')->withInput();
        }
    }
    //Delete Role Function
    public function delete($id, Request $r)
    {
        DB::table('roles')
            ->where('id', $id)
            ->delete();

        $r->session()->flash('success', 'Data has been removed!');
        return redirect('role');
    }
    // Edit Role Function
    public function edit($id)
    {
        $data['role'] = DB::table('roles')
            ->where('id', $id)
            ->first();
        return view('roles.edit', $data);    
    }
    //Update Role Function
    public function update(Request $r)
    {
        $data = array(
            'name' => $r->name
        );
        $i = DB::table('roles')
            ->where('id',$r->id)
            ->update($data);
        
        if($i)
        {
            $r->session()->flash('success', 'Data has been save!');
            return redirect('role/create');
        }
        else{
            $r->session()->flash('error', 'Fail to save data!');
            return redirect('role/create')->withInput();
        }
    }
}
