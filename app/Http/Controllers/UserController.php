<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DB;
use Hash;


class UserController extends Controller
{
    function __construct()
    {

      $this->middleware('permission:user-list', ['only' => ['index']]);
      $this->middleware('permission:user-create', ['only' => ['create','store']]);
      $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:user-delete', ['only' => ['destroy']]);

    }
    
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
         return view('users.index',compact('data'))
         ->with('i', ($request->input('page', 1) - 1) * 5);
    }

   
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }

    
    public function store(Request $request)
    {
        //
        
            $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'gender' => 'required',
            'add' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'ssn' => 'required|max:11',
            'roles_name' => 'required'
            ],[
    
                'name.required' =>'يرجي ادخال اسم ',
                'email.required' =>'يرجي ادخال البريد الالكتروني ',
                'password.required' =>'يرجي ادخال كلمة المرور ',
                'gender.required' =>'يرجي ادخال النوع ',
                'add.required' =>'يرجي ادخال العنوان ',
                'phone.required' =>'يرجي ادخال رقم الهاتف ',
                'phone.min' =>' رقم الهاتف اطول من الازم يجب ان يكون 10 خانة ',
                'ssn.required' =>'يرجي ادخال الرقم الوطني ',
                'ssn.max' =>' رقم الهاتف اطول من الازم يجب ان يكون 11 خانة ',
                'roles_name.required' =>'يرجي ادخال الصلاحية ',
    
    
            ]); 

            $input = $request->except(['confirm-password']);
            
            $input['password'] = Hash::make($input['password']);
            
            $user = User::create($input);
            $user->assignRole($request->input('roles_name'));

            session()->flash('user_add');

            return redirect('/users');
            
           
    }

    
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('users.edit',compact('user','roles','userRole'));
    }

    
    public function update(Request $request, $id)
    {
        //dd($request->all());
        
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'roles_name' => 'required'
            ]);
            $input = $request->all();
            
            $user = User::find($id);
            $user->update($input);
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $user->assignRole($request->input('roles_name'));
           
            session()->flash('user_update');
            return redirect('/users');
            
    }

    public function destroy(Request $request, $id)
    {
        User::find($request->user_id)->delete();
        session()->flash('user_delete');
        return redirect('/users');
    } 

    public function showChangePasswordForm(){
        return view('auth.changepassword');
    }


    public function changePassword(Request $request){
 
        //dd($request->all());
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->withErrors("كلمة المرور الحالية غير صحيحة. فضلا حاول مجددا.");
           
        }
 
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->withErrors("لا يمكن تغير كلمة المرور بكلمة المرور الحالية.");
        }
 
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
 
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
 
        session()->flash('user_update');
        return redirect('/home');
 
    }




}
