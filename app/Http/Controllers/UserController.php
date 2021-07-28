<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Auth;
use DataTables;
use Illuminate\Support\Facades\Hash;
//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

//Enables us to output flash messaging
use Session;

class UserController extends Controller {

    // public function __construct() {
    //     $this->middleware(['auth', 'isAdmin']);  //isAdmin middleware lets only users with a //specific permission permission to access these resources
    // }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    function index()
    {
     return view('admin.users.index');
     //http://127.0.0:8000/ajaxdata
    }

    public function getdata() {
    //Get all users and pass it to the view
       try {

        $data = User::select('*'); 
        return Datatables::of($data)->make(true);

       } catch (\Exception $e) {
          
            return back()->with('msg', $e->getMessage());
       }catch (\Throwable $ex) {
       
        return back()->with('msg', $ex->getMessage());
     }
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create() {
    //Get all roles and pass it to the view
       try {
        $roles = Role::get();
        return view('admin.users.create', ['roles'=>$roles]);
       } catch (\Exception $e) {
           //throw $th;
            // return $e->getMessage();
            return back()->with('msg', $e->getMessage());
       }catch (\Throwable $ex) {
        //return $ex->getMessage();
        return back()->with('msg', $ex->getMessage());
     }

    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request) {
    //Validate name, email and password fields
        try {
           //dd($request->all());
            $this->validate($request, [
                'email'=>'required|unique:users',
                'password'=>'required|min:4|confirmed'
            ]);
    
            $user = User::create($request->only('email', 'first_name','last_name','address','city_name','province','postal_code','phone_num', 'password')); //Retrieving only the email and password data
    
            $roles = $request['roles']; //Retrieving the roles field
        //Checking if a role was selected
            if (isset($roles)) {
    
                foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();            
                $user->assignRole($role_r); //Assigning role to user
                }
            }   
            return redirect()->route('users.index')
         ->with('flash_message',
          'User successfully added.');     
        //Redirect to the users.index view and display message
           
        } catch (\Exception $e) {
            //throw $th;
            //  return $e->getMessage();
            return back()->withInput()->with(['msg' , $e->getMessage()]);
        }catch (\Throwable $ex) {
            // return $ex->getMessage();
            return back()->withInput()->with(['msg' , $ex->getMessage()]);
         }
         
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id) {
       try {
        return redirect('users'); 
       } catch (\Exception $e) {
           //throw $th;
            // return $e->getMessage();
            return view('errors.401')->with('msg', $e->getMessage());
       }catch (\Throwable $ex) {
        // return $ex->getMessage();
        return view('errors.401')->with('msg', $ex->getMessage());
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
        $user = User::findOrFail($id); //Get user with specified id
        $roles = Role::get(); //Get all roles
      } catch (\Exception $e) {
          //throw $th;
        //    return $e->getMessage();
        return view('errors.401')->with('msg', $e->getMessage());
      }catch (\Throwable $ex) {
        // return $ex->getMessage();
        return view('errors.401')->with('msg', $ex->getMessage());
     }
     return view('admin.users.edit', compact('user', 'roles')); //pass user and roles data to view

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
        $user = User::findOrFail($id); //Get role specified by id

        //Validate name, email and password fields    
            $this->validate($request, [
                'email'=>'required|unique:users,email,'.$id,
                'password'=>'required|min:6|confirmed'
            ]);
            $input = $request->only(['email', 'first_name','last_name','address','city_name','province','postal_code','phone_num', 'password']); //Retreive the name, email and password fields
            $roles = $request['roles']; //Retreive all roles
           // $user->fill($input)->save();
           if ($request->password == null) {
           
            User::where('id','=',$id)->update([
                'email' => $request->email,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'city_name' => $request->city_name,
                'province' => $request->province,
                'postal_code' => $request->postal_code,
                'phone_num' => $request->phone_num,

            ]);
        }else{
            //dd('true');
            //dd($request->password);
            User::where('id','=',$id)->update([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'city_name' => $request->city_name,
                'province' => $request->province,
                'postal_code' => $request->postal_code,
                'phone_num' => $request->phone_num,

            ]);
        }
            if (isset($roles)) {        
                $user->roles()->sync($roles);  //If one or more role is selected associate user to roles          
            }        
            else {
                $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
            }
           
       } catch (\Exception $e) {
           //throw $th;
            // return $e->getMessage();
                return view('errors.401')->with('msg', $e->getMessage());
        }catch (\Throwable $ex) {
            // return $ex->getMessage();
            return view('errors.401')->with('msg', $ex->getMessage());
        }
     return redirect()->route('users.index')
     ->with('flash_message',
      'User successfully edited.');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id) {
    //Find a user with a given id and delete
       try {
        $user = User::findOrFail($id); 
        $user->delete();
       } catch (\Exception $e) {
           //throw $th;
            // return $e->getMessage();
            return view('errors.401')->with('msg', $e->getMessage());
       }catch (\Throwable $ex) {
        // return $ex->getMessage();
        return view('errors.401')->with('msg', $ex->getMessage());
     }
     return redirect()->route('users.index')
     ->with('flash_message',
      'User successfully deleted.');
    }
    public function userEmailCheck(Request $request)
    {
       
        $email = $request->email; // This will get all the request data.
        $userCount = User::where('email', $email);
        if ($userCount->count()) {
            return \Response::json(array('msg' => 'true'));
        } else {
            return \Response::json(array('msg' => 'false'));
        }
    }
    public function editEmailCheck(Request $request)
    {
        $email = $request->email; 
        $id = $request->id;
        $userCount = User::where('id','!=',$id)->where('email', $email);
        if ($userCount->count()) {
            return \Response::json(array('msg' => 'true'));
        } else {
            return \Response::json(array('msg' => 'false'));
        }
    }
}
