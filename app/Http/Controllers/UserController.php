<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        //
        $user_id = Auth::id();
        $users = new User();
        $users = $users::find($user_id);
        return view("admin.users")->with("users",$users);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('admin.addUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        //

        $user = new User();
        $user->name = $request->input('userName');
        $user->email = $request->input('userEmail');
        $user->password = Hash::make($request->input('password'));

        if($user->save()){
            return redirect("admin/users")->with(['success'=>'تم أضافة المشرف بنجاح']);
        }else{
            return redirect("admin/users")->with(['error'=>'حدث خطأ الرجاء المحاولة لاحقاً']);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = new User();
        $user = $user::find($id);
        $user->name = $request->input('userName');
        $user->email = $request->input('userEmail');
        if($request->input('password')){
            // here put password update
            $user->password = Hash::make($request->input('password'));

        }
        if($user->update()){
            return redirect("admin/users")->with(['success'=>'تم تحديث بيانات المشرف بنجاح']);
        }else{
            return redirect("admin/users")->with(['error'=>'حدث خطأ الرجاء المحاولة لاحقاً']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $user = new User();
        $delete = $user::find($id)->forceDelete();

        if($delete){
            return redirect('admin/users')->with(['success'=>'تم حذف المشرف بنجاح']);
        }else{
            return redirect('admin/users')->with(['error'=>'لم تم عملية الحذف. حاول مره أخرى']);
        }
    }
}
