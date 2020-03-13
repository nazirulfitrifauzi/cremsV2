<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index(Role $roles)
    {
        return view('roles.index', ['roles' => $roles->paginate(15)]);
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            'role' => ['required', 'string', 'max:50']
        ]);

        if (!empty($request->get('p_attendance'))) {
            $c_attendance = $request->get('p_attendance');
        }
        else {
            $c_attendance = '0';
        }

        if (!empty($request->get('p_leave'))) {
            $c_leave = $request->get('p_leave');
        }
        else {
            $c_leave = '0';
        }

        if (!empty($request->get('p_claim'))) {
            $c_claim = $request->get('p_claim');
        }
        else {
            $c_claim = '0';
        }

        if (!empty($request->get('p_advance'))) {
            $c_advance = $request->get('p_advance');
        }
        else {
            $c_advance = '0';
        }

        if (!empty($request->get('p_roles'))) {
            $c_roles = $request->get('p_roles');
        }
        else {
            $c_roles = '0';
        }

        if (!empty($request->get('p_staff'))) {
            $c_staff = $request->get('p_staff');
        }
        else {
            $c_staff = '0';
        }

        if (!empty($request->get('p_client_company'))) {
            $c_client_company = $request->get('p_client_company');
        }
        else {
            $c_client_company = '0';
        }

        if (!empty($request->get('p_client_user'))) {
            $c_client_user = $request->get('p_client_user');
        }
        else {
            $c_client_user = '0';
        }

        $role = new Role([
            'role'              => $request->get('role'),
            'p_attendance'      => $c_attendance,
            'p_leave'           => $c_leave,
            'p_claim'           => $c_claim,
            'p_advance'         => $c_advance,
            'p_roles'           => $c_roles,
            'p_staff'           => $c_staff,
            'p_client_company'  => $c_client_company,
            'p_client_user'     => $c_client_user
        ]);

        $role->save();

        return redirect()->route('roles.index')->withStatus('Role successfully created.');
    }

    public function show(Role $role)
    {
        //
    }

    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $id = $role->id;

        Role::whereId($id)->update([
            'p_attendance'      => '0',
            'p_leave'           => '0',
            'p_claim'           => '0',
            'p_advance'         => '0',
            'p_roles'           => '0',
            'p_staff'           => '0',
            'p_client_company'  => '0',
            'p_client_user'     => '0'
        ]);

        $data = request([
            'role',
            'p_attendance',
            'p_leave',
            'p_claim',
            'p_advance',
            'p_roles',
            'p_staff',
            'p_client_company',
            'p_client_user'
        ]);

        Role::whereId($id)->update($data);

        return redirect()->route('roles.index')->withStatus('Role successfully updated');
    }

    public function destroy($id)
    {
        $role = Role::where('id',$id)->value('role');

        Role::destroy($id);

        //  Return response
        return response()->json([
            'success' => true,
            'message' => "Role ". $role ." has been deleted.",
        ]);
    }
}
