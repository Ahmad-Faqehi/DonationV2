<?php

namespace App\Http\Controllers;

use App\Donation;
use App\Donor;
use Illuminate\Http\Request;

class DonorConroller extends Controller
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
        $this->middleware('auth')->except("store");
    }

    public function index()
    {
        //
    }

    public function checkUserOnDonation($donaorName, $donationId){

        $donor = new Donor();
        $xdonor =  Donor::where(['name' => $donaorName, 'donation_id' => $donationId])->get();
        return ($xdonor->first()) ? true : false;

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
    public function updateDonor(Request $request, $id)
    {
        //
        dd($request->input());
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
            'donorName' => 'required',
            'donorMoney' => 'required',
        ],
            [
                'donateName.required'=>'يجب أدخال الاسم الثلاثي ',
                'donorMoney.required'=>'يجب أدخال المبلغ'
            ]);

        $donor = new Donor();

        if( $this->checkUserOnDonation($request->input('donorName'),$request->input('donation_id'))){

            return redirect("/")->with(['error'=>'أنت مسجل مسبقاً في هذه الحملة. الرجاء التواصل مع المسؤال للمزيد من المساعدة.']);

        }else {
            $token = $request->input('donation_tok');
            $donor->name = $request->input('donorName');
            $donor->money = $request->input('donorMoney');
            $donor->donation_id = $request->input('donation_id');
            $donor->paid = 0;
            if ($donor->save()) {
                return redirect("/set/$token")->with(['success' => 'تم تسجيل المشاركة بنجاح. شكرا لك']);
            } else {
                return redirect("/set/$token")->with(['error' => 'حدث خطأ ما حاول مره أخرى في وقت لاحق']);

            }
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
    public function update(Request $request, int $id)
    {
        //
        $donation_id = $request->input('donation_id');
        $donor =  Donor::find($id);
        $donor->name = $request->input('donorName');
        $donor->money = $request->input('donorMoney');
        $donor->paid = $request->input('statues');
        if($donor->update()){
          return  redirect("admin/show/$donation_id")->with(['success'=>'تم تحديث بيانات المتبرع بنجاح']);
        }else{
            return redirect("admin/show/$donation_id")->with(['error'=>'حدث خطا ما. لم تتم علمية التحديث بنجاح']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( int $donation_id, int $donor_id)
    {
        //
        $matchThese = ['donors_Id' => $donor_id, 'donation_id' => $donation_id];
        $donor =  Donor::where($matchThese)->forceDelete();
        if($donor){
            return redirect("admin/show/$donation_id")->with(['success'=>'تم حذف المتبرع بنجاح']);
        }else{
            return redirect("admin/show/$donation_id")->with(['error'=>'لم تم عملية الحذف. حاول مره أخرى']);
        }

    }


}
