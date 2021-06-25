<?php

namespace App\Http\Controllers\Admin;

use Datatables;
use App\Models\Category;
use App\Models\StoreCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;

class StoreCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = StoreCategory::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->addColumn('status', function(StoreCategory $data) {
                                $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="process select droplinks '.$class.'"><option data-val="1" value="'. route('admin-storecat-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Activated</option><option data-val="0" value="'. route('admin-storecat-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Deactivated</option>/select></div>';
                            })

                            ->addColumn('action', function(StoreCategory $data) {
                                return '<div class="action-list"><a data-href="' . route('admin-storecat-edit',$data->id) . '" class="edit" data-toggle="modal" data-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('admin-storecat-delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            })
                            ->rawColumns(['status','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        return view('admin.storecategory.index');
    }

    //*** GET Request
    public function create()
    {   
        $storecats=StoreCategory::where('status',1)->get();
        return view('admin.storecategory.create',compact('storecats'));
    }

    //*** POST Request
    public function store(Request $request)
    {



//--- Validation Section
        $rules = [
            'photo' => 'required|mimes:jpeg,jpg,png,svg',
                 ];
        $customs = [
            'photo.mimes' => 'Icon Type is Invalid.',
                   ];
        $validator = Validator::make(Input::all(), $rules, $customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        //--- Validation Section Ends

        //--- Logic Section
        $data = new StoreCategory();
        $input = $request->all();
        if ($file = $request->file('photo'))
        {
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/storecategories',$name);
            $input['photo'] = $name;
        }
       
        $data->fill($input)->save();
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = 'New Data Added Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    //*** GET Request
    public function edit($id)
    {
        $data = StoreCategory::findOrFail($id);
        return view('admin.storecategory.edit',compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        
        $data = StoreCategory::findOrFail($id);
        $input = $request->all();

        if ($file = $request->file('photo'))
                {
                        $name = time().$file->getClientOriginalName();
                        $file->move('assets/images/storecategories',$name);
                        if($data->photo != null)
                        {
                            if (file_exists(public_path().'/assets/images/storecategories/'.$data->photo)) {
                                unlink(public_path().'/assets/images/storecategories/'.$data->photo);
                            }
                        }
                    $input['photo'] = $name;
                }            

        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

      //*** GET Request Status
      public function status($id1,$id2)
      {
          $data = StoreCategory::findOrFail($id1);
          $data->status = $id2;
          $data->update();
      }


    //*** GET Request Delete
    public function destroy($id)
    {
        $data = StoreCategory::findOrFail($id);


        $data->delete();
        //--- Redirect Section
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
    }
}
