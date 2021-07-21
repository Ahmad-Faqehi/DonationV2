<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Donation;
use App\Donor;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
        $user_id =  Auth::id();
        $donation = new Donation();
        #$donation = $donation::where('statues',1)->take(1)->get();
        $donation = $donation::where(['statues' => 1, 'user_id' => $user_id])->take(1)->get();

        if($donation->first()){
            $donor = new Donor();
            $donor = $donor::where('donation_id',$donation[0]->id)->get();

            return view('admin.home')->with(['donation'=>$donation,'donor'=>$donor]);
        }else{
            return view('admin.homeNo');
        }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'donateName' => 'required',
        ],
            [
                'donateName.required'=>'يجب أدخال اسم الحملة'
            ]);

        $user_id =  Auth::id();
        $donation = new Donation();
        $check = $donation::where(['statues' => 1, 'user_id' => $user_id])->get();

        if($check->first()){
            return  redirect('/admin/add')->with('error', 'لا يمكنك أضافة حملة جديدة, يوجد حملة تبرع فعالة حالياً');
        }else{

            $donation->title = $request->input('donateName');
            $donation->target = $request->input('donateTarget');
            $donation->statues = 1;
            $donation->user_id = Auth::id();
            $donation->token_url = bin2hex(random_bytes(3));
            $donation->save();
            return  redirect('/admin/home')->with('success', 'تم الاضافة بنجاح.');

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
        $user_id =  Auth::id();
        $donation = new Donation();
        $donation = $donation::findOrFail((int)$id);
        #$donation = $donation::where('user_id', $user_id)->get();

        if($donation->first()){

            if($donation->user_id != $user_id){
                return  redirect('admin/home');
            }

            $donor = new Donor();
            $donor = $donor::where('donation_id',$donation->id)->get();

            return view('admin.show')->with(['donation'=>$donation,'donor'=>$donor]);
        }else{
            return  redirect('admin.donations');
        }

    }



    public function showAll()
    {
        //
        $donation = new Donation();
        $donation =  $donation::all()->where('user_id',Auth::id());
        $donor = new Donor();

       return view('admin.donations')->with(['donation'=>$donation,'donor'=>$donor]);
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

    public function editDonr(int $id_donation , int $id_donor)
    {
     $donation = new Donation();
     $donation = $donation::find($id_donation);
     $donor = new Donor();
     $donor = $donor::find($id_donor);

     if($donation && $donor){
         return view('admin.editDonor')->with(['donation'=>$donation,'donor'=>$donor]);
     }else{
         return redirect('admin/donations')->with(['error'=>'لم يتم عثور على البيانات المعطاه']);
     }

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

        // Check if there is any donation is on
        $user_id =  Auth::id();
        $archeved = Donation::where(['statues' => 1, 'user_id' => $user_id])->get();
        $donation =  Donation::find($id);


        if ($donation->user_id != $user_id){
            return redirect("admin/donations")->with(['error' => 'ليس لديك صلاحية لتحديث']);
        }
        $donation->title = $request->input('donationName');
        $donation->target = $request->input('target');

        if ($donation->update()) {
            return redirect("admin/donations")->with(['success' => 'تم تحديث بيانات الحملة بنجاح']);
        } else {
            return redirect("admin/donations")->with(['error' => 'حدث خطا ما. لم تتم علمية التحديث بنجاح']);
        }



    }

    public function arched(Request $request, int $id){

        header('Content-Type: application/json');

        $user_id = Auth::id();
        $type = $request->input('type');
        $donation = new Donation();
        $the_donation = $donation::find($id);

        // if user  has no permeation
        if($the_donation->user_id !=  $user_id  ){   return redirect("admin/home")->with(['error' => 'حدث خطا. ليس لديك صلاحية لتعديل']); }

        if($type == 'on'){
            $donations = $donation::where(['statues' => 1, 'user_id' => $user_id])->get();

            if(count($donations) >= 1){
                // You can't run on
                $data = [ 'type' => false, 'msg' => 'لا يمكنك تفعيل حملة جديدة أخرى. هنالك حملة فعالة مسبقاً' ];
                return json_encode($data);
            }else{

                $the_donation->statues  = !$the_donation->statues;
                if ($the_donation->update()) {
                    $data = [ 'type' => true, 'msg' => 'تم تنشيط الحملة بنجاح' , 'is' => 'on'];
                    return json_encode($data);
                } else {
                    $data = [ 'type' => false, 'msg' => 'حدث خطا ما. لم تتم علمية التحديث' ];
                    return json_encode($data);
                }

            }

        }elseif($type == 'off'){
            $the_donation->statues  = !$the_donation->statues;
            if ($the_donation->update()) {
                $data = [ 'type' => true, 'msg' => 'تم أرشفة الحملة بنجاح' , 'is' => 'off'];
                return json_encode($data);
            } else {
                $data = [ 'type' => false, 'msg' => 'حدث خطا ما. لم تتم علمية التحديث' ];
                return json_encode($data);
            }
        }else{
            $data = [ 'type' => false, 'msg' => 'حدث خطا ما. لم تتم علمية التحديث' ];
            return json_encode($data);
        }

    }

    public function stopit( int $id){
        $user_id = Auth::id();
        $donation = new Donation();
        $check = $donation::find($id);
        if($check->user_id != $user_id){
            // Does not has permtion
            return redirect("admin/home")->with(['error' => 'ليس لديك صلاحية للايقاف']);
        }else{
            $check->statues = 0;
            if($check->update()){
                return redirect("admin/home")->with(['success' => 'تم ارشفة الحملة بنجاح']);
            }else{
                return redirect("admin/donations")->with(['error' => 'حدث خطا ما. لم تتم علمية التحديث بنجاح']);
            }

        }
    }



    public function setPage($token){
        $donation = new Donation();
        $donation = $donation::where('token_url',$token)->take(1)->get();
        return view('index')->with('donation',$donation);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $user_id = Auth::id();
        $donation = new Donation();
      $delete =  $donation::find($id);

      if($user_id != $delete->user_id){
          return redirect("admin/home")->with(['error' => 'ليس لديك صلاحية للحذف']);
      }

      if($delete->forceDelete()){
          return redirect('admin/donations')->with(['success'=>'تم حذف الحملة بنجاح']);
      }else{
          return redirect('admin/donations')->with(['error'=>'لم تم عملية الحذف. حاول مره أخرى']);
      }
    }

    public function addDonation(){
        $user_id =  Auth::id();
        $donation = new Donation();
        $donation = $donation::where(['statues' => 1, 'user_id' => $user_id])->take(1)->get();
        return view('admin.add')->with('donation',$donation);
    }

    public function updatePaid(int $id){
        $donor = new Donor();
        $donor = $donor::find($id);
        if(!$donor->paid){
            $donor->paid = 1;
        }else{
            $donor->paid = 0;
        }

        if($donor->update()){

            return true;
        }else{
            return false;
        }
    }

//    public function deleteIt( int $id){
//        $user_id = Auth::id();
//        $donation = new Donation();
//        $check = $donation::find($id);
//        if($check->user_id != $user_id){
//            // Does not has permtion
//            return redirect("admin/home")->with(['error' => 'ليس لديك صلاحية للايقاف']);
//        }else{
//            $check->statues = 0;
//            if($check->delete()){
//                return redirect("admin/home")->with(['success' => 'تم ارشفة الحملة بنجاح']);
//            }else{
//                return redirect("admin/donations")->with(['error' => 'حدث خطا ما. لم تتم علمية التحديث بنجاح']);
//            }
//
//        }
//    }

}
