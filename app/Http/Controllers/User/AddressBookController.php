<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\AddressBook;
use Auth;
use Illuminate\Support\Facades\Input;
use Validator;
class AddressBookController extends Controller
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
        $user_id=Auth::user()->id;
        $addressbooks=AddressBook::where('user_id',$user_id)->get();
        return view('user.addressbook.index',compact('addressbooks'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries=Country::all();
        return view('user.addressbook.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
               //--- Validation Section
                $rules = [
                       'latitude'      => 'required',
                        ];
                $customs = [
                        'latitude.required' => 'Street address is not valid !',
                    ];
                $validator = Validator::make(Input::all(), $rules, $customs);
                
                if ($validator->fails()) {
                  return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
                }        

                $addressbook = new AddressBook;
                $input=$request->all();
                $input['user_id']=Auth::user()->id;
                $addressbook->fill($input)->save();

                $msg = 'Your AddressBook Added Successfully.';
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
        $addressbookdata=AddressBook::where('id',$id)->where('user_id',$user_id)->first();
        return view('user.addressbook.edit',compact('countries','addressbookdata'));
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
                $rules = [
                       'latitude'      => 'required',
                        ];
                $customs = [
                        'latitude.required' => 'Street address is not valid !',
                    ];
                $validator = Validator::make(Input::all(), $rules, $customs);
                
                if ($validator->fails()) {
                  return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
                }       

                $addressbook =AddressBook::findOrFail($id);
                $input=$request->all();
                $addressbook->update($input);

                $msg = 'Your AddressBook Updated Successfully.';
                return response()->json($msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = AddressBook::findOrFail($id);
        $data->delete();   
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);      
    }
}
