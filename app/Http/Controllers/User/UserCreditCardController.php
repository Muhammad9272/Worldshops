<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\UserCreditCard;
use Auth;
use Illuminate\Support\Facades\Input;
use Validator;
class UserCreditCardController extends Controller
{
    /**


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        $user_id=Auth::user()->id;
        $usercreditcards=UserCreditCard::where('user_id',$user_id)->get();
        return view('user.savedcard.index',compact('usercreditcards'));

    }

    public function create()
    {
        $countries=Country::all();
        return view('user.savedcard.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
     

                $usercreditcard = new UserCreditCard;
                $input=$request->all();
                $input['user_id']=Auth::user()->id;
                $usercreditcard->fill($input)->save();

                $msg = 'Your Card Added Successfully.';
                return response()->json($msg);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries=Country::all();
        $user_id=Auth::user()->id;
        $usercreditcard=UserCreditCard::where('id',$id)->where('user_id',$user_id)->first();
        return view('user.savedcard.edit',compact('countries','usercreditcard'));
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
         //--- Validation Section      
                $usercreditcard = UserCreditCard::where([ ['id',$id],['user_id',Auth::id()] ])->first();
                $input=$request->all();
                $usercreditcard->update($input);

                $msg = 'Data Updated Successfully.';
                return response()->json($msg);
    }

    public function primary($id)
    {
        $affect =UserCreditCard::where('user_id',Auth::id())->update(array('primary' => 0));

        $data = UserCreditCard::where([ ['id',$id],['user_id',Auth::id()] ])->first();

        $data->primary=1;
        $data->update();
        return redirect()->back()->with('message', 'Data updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = UserCreditCard::where([ ['id',$id],['user_id',Auth::id()] ])->first();
        $data->delete();   
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);      
    }
}
