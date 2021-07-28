<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Session;

class RoleController extends Controller {

    // public function __construct() {
    //     $this->middleware(['auth', 'isAdmin']);//isAdmin middleware lets only users with a //specific permission permission to access these resources
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
       try {
        $roles = Role::all();//Get all roles

       
       } catch (\Exception $e) {
           //throw $th;
            return $e->getMessage();
       }
       catch (\Throwable $ex) {
        return $ex->getMessage();
     }
     return view('/admin.Roles.index')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        try {
            $permissions = Permission::all();//Get all permissions
       
        } catch (\Exception $e) {
            //throw $th;
             return $e->getMessage();
        }catch (\Throwable $ex) {
            return $ex->getMessage();
         }
         return view('/admin.Roles.create', ['permissions'=>$permissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
    //Validate name and permissions field
        try {
            $this->validate($request, [
                'name'=>'required|unique:roles|max:10',
                'permissions' =>'required',
                ]
            );
    
            $name = $request['name'];
            $role = new Role();
            $role->name = $name;
    
            $permissions = $request['permissions'];
    
            $role->save();
        //Looping thru selected permissions
            foreach ($permissions as $permission) {
                $p = Permission::where('id', '=', $permission)->firstOrFail(); 
             //Fetch the newly created role and assign permission
                $role = Role::where('name', '=', $name)->first(); 
                $role->givePermissionTo($p);
            }
    
           
        } catch (\Exception $e) {
            //throw $th;
             return $e->getMessage();
        }
        catch (\Throwable $ex) {
            return $ex->getMessage();
         }
         return redirect()->route('roles.index')
         ->with('flash_message',
          'Role'. $role->name.' added!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        try {
            return redirect('roles');
        } catch (\Exception $e) {
            //throw $th;
             return $e->getMessage();
        }catch (\Throwable $ex) {
            return $ex->getMessage();
         }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
       try {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
       } catch (\Exception $e) {
           //throw $th;
            return $e->getMessage();
       }catch (\Throwable $ex) {
        return $ex->getMessage();
     }
     return view('admin.Roles.edit', compact('role', 'permissions'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        try {
            $role = Role::findOrFail($id);//Get role with the given id
    //Validate name and permission fields
        $this->validate($request, [
            'name'=>'required|max:10|unique:roles,name,'.$id,
            'permissions' =>'required',
        ]);

        $input = $request->except(['permissions']);
        $permissions = $request['permissions'];
        $role->fill($input)->save();

        $p_all = Permission::all();//Get all permissions

        foreach ($p_all as $p) {
            $role->revokePermissionTo($p); //Remove all permissions associated with role
        }

        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail(); //Get corresponding form //permission in db
            $role->givePermissionTo($p);  //Assign permission to role
        }
        } catch (\Exception $e) {
            //throw $th;
             return $e->getMessage();
        }catch (\Throwable $ex) {
            return $ex->getMessage();
         }
         return redirect()->route('roles.index')
            ->with('flash_message',
             'Role'. $role->name.' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);
        $role->delete();
        } catch (\Exception $e) {
            //throw $th;
             return $e->getMessage();
        }catch (\Throwable $ex) {
            return $ex->getMessage();
         }
         return redirect()->route('roles.index')
         ->with('flash_message',
          'Role deleted!');

    }
}