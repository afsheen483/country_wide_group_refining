<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\UserItemModel;
use Auth;
use DataTables;
use DB;
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

        $user = DB::select("SELECT * FROM users  ORDER BY id DESC"); 
        return Datatables::of($user)->editColumn('created_at', function ($contact){
            return date('F d, Y h:ia', strtotime($contact->created_at) );
        })->addColumn('action', function ($id) {
            return ' <a  style="color: green;cursor: pointer;" id="'.$id->id.'" data-check="'.$id->id.'" class="check_btn"><i class="fa fa-check"></i></a> | <a href="users_edit/ '. $id->id.'" style="color: blue;cursor: pointer;"><i class="fa fa-edit"></i></a> |
                <a  style="color: red;cursor: pointer;" id="'.$id->id.'" data-delete="'.$id->id.'" class="delete_btn"><i class="fa fa-trash"></i></a>
              '; })->addColumn('status', function ($user) {
                if ($user->is_activate == 0) return '<span class="btn btn-sm bg-success-light">Activate</span>';
                if ($user->is_activate == 1) return '<span class="btn btn-sm bg-danger-light">Deactivated</span>';
                return 'Cancel';
            })->rawColumns(['action','status'])->make(true);

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
            $user_id = Auth::user()->id;
            $date = date("Y-m-d");
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
          $data =  DB::table('users')->orderBy('id','desc')->first();
          $items = DB::select("SELECT * FROM items");
           //dd($data->id);
           foreach ($items as $item) {
            UserItemModel::create([
                'item_id' => $item->id,
                'user_id' => $data->id,
                'date' => $date,
                'created_by' => $user_id
            ]);
           }
          
            return redirect()->route('users.index')
         ->with('flash_message',
          'User successfully added.');     
        //Redirect to the users.index view and display message
           
        } catch (\Exception $e) {
            //throw $th;
            dd($e);
            //  return $e->getMessage();
            return back()->withInput()->with(['msg' , $e->getMessage()]);
        }catch (\Throwable $ex) {
            dd($ex);
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
    public function StatusUpdate($id)
    {
       $is_active = User::where('id','=',$id)->get();
       //dd($is_active);
       if($is_active[0]->is_activate == 0){
           $update = User::where('id','=',$id)->update([
                'is_activate' => '1'
           ]);
           if ($update) {
               return 1;
           }
       } 
       if ($is_active[0]->is_activate == 1) {
        $update = User::where('id','=',$id)->update([
            'is_activate' => '0'
       ]);
       if ($update) {
           return 0;
       }
    }
}
}