<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Session;

class PermissionController extends Controller {

    // public function __construct() {
    //     $this->middleware(['auth', 'isAdmin']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    // }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index() {
        try {
            
        $permissions = Permission::all(); //Get all permissions
        } catch (\Exception $e) {
            //throw $th;
             return $e->getMessage();
        }catch (\Throwable $ex) {
            return $ex->getMessage();
         }
         return view('admin.permissions.index')->with('permissions', $permissions);

    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create() {
        try {
            $roles = Role::get(); //Get all roles

        } catch (\Exception $e) {
            //throw $th;
             return $e->getMessage();
        }catch (\Throwable $ex) {
            return $ex->getMessage();
         }
         return view('admin.permissions.create')->with('roles', $roles);

    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request) {
        try {
            $this->validate($request, [
                'name'=>'required|max:40',
            ]);
    
            $name = $request['name'];
            $permission = new Permission();
            $permission->name = $name;
    
            $roles = $request['roles'];
    
            $permission->save();
    
            if (!empty($request['roles'])) { //If one or more role is selected
                foreach ($roles as $role) {
                    $r = Role::where('id', '=', $role)->firstOrFail(); //Match input role to db record
    
                    $permission = Permission::where('name', '=', $name)->first(); //Match input //permission to db record
                    $r->givePermissionTo($permission);
                }
            }
    
           
        } catch (\Exception $e) {
            //throw $th;
             return $e->getMessage();
        }catch (\Throwable $ex) {
            return $ex->getMessage();
         }
         return redirect()->route('permissions.index')
         ->with('flash_message',
          'Permission'. $permission->name.' added!');

    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id) {
        try {
            return redirect('permissions');

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
        $permission = Permission::findOrFail($id);

       } catch (\Exception $e) {
           //throw $th;
            return $e->getMessage();
       }catch (\Throwable $ex) {
        return $ex->getMessage();
     }
     return view('admin.permissions.edit', compact('permission'));

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
        $permission = Permission::findOrFail($id);
        $this->validate($request, [
            'name'=>'required|max:40',
        ]);
        $input = $request->all();
        $permission->fill($input)->save();

   
       } catch (\Exception $e) {
           //throw $th;
            return $e->getMessage();
       }catch (\Throwable $ex) {
        return $ex->getMessage();
     }
     return redirect()->route('permissions.index')
     ->with('flash_message',
      'Permission'. $permission->name.' updated!');

    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id) {
       try {
        $permission = Permission::findOrFail($id);

        //Make it impossible to delete this specific permission    
        if ($permission->name == "Administer roles & permissions") {
                return redirect()->route('permissions.index')
                ->with('flash_message',
                 'Cannot delete this Permission!');
            }
    
            $permission->delete();
    
           
       } catch (\Exception $e) {
           //throw $th;
            return $e->getMessage();
       }catch (\Throwable $ex) {
        return $ex->getMessage();
     }
     return redirect()->route('permissions.index')
     ->with('flash_message',
      'Permission deleted!');

    }
}
