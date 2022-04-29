<?php

namespace App\Http\Controllers;

use App\Models\Earth;
use App\Http\Requests\StoreEarthRequest;
use App\Http\Requests\UpdateEarthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Square;


class EarthController extends Controller
{

    function __construct()
     {

      $this->middleware('permission:عرض ارض', ['only' => ['index']]);
      $this->middleware('permission:اضافة ارض', ['only' => ['create','store']]);
      $this->middleware('permission:تعديل ارض', ['only' => ['edit','update']]);
      $this->middleware('permission:حذف ارض', ['only' => ['destroy']]);

     }
    public function index()
    {
        
        $earths =  Earth::all();
        return view ('earths.index',compact('earths'));
    }

   
    public function create()
    {
        $squares =  Square::all();
        return view ('earths.create',compact('squares'));
    }

    
    public function store(StoreEarthRequest $request)
    {
        //dd($request->all());

      
       if(Earth::where('square_id',$request->square_id)->Where('enumber',$request->enumber)->exists())
       {
          return redirect()->back()->withErrors('قطعة الارض مسجلة بالفعل في المربع الذي تم اختيارهُ');
       }

      try {
        $validated = $request->validated();
            Earth::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'SSN' => $request->SSN,
            'phone' => $request->phone,
            'enumber' => $request->enumber,
            'space' => $request->space,
            'square_id' => $request->square_id,
            'created_by' => (Auth::user()->name)
            ]);

            session()->flash('Add_earths');
            return redirect('/earths');
           }

        catch (\Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }

       
    }

    
    public function show(Earth $earth)
    {
      
        return view ('earths.show',compact('earth'));
    }

   
    public function edit(Earth $earth)
    {
       
        return view('earths.edit',compact('earth'));
    }

   
    public function update(UpdateEarthRequest $request, Earth $earth)
    {
       //dd($request->all());
      
        try 
        {
            $validated = $request->validated();
            $earth->update([
                'name' => $request->name,
                'gender' => $request->gender,
                'SSN' => $request->SSN,
                'phone' => $request->phone,
                'enumber' => $request->enumber,
                'space' => $request->space,
                'square_id' => $request->square_id,
                'created_by' => (Auth::user()->name)
            ]);
        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }



        session()->flash('earth_edit');
        return redirect('/earths');

    }

    public function Print_earth($id)
    {
        $earth = Earth::where('id', $id)->first();
        return view('earths.print',compact('earth'));
    }


    public function destroy(Request $request)
    {
        //
      //dd($request->all());
       $earth = Earth::where('id', $request->earth_id)->first();
       $earth->delete();

        
        session()->flash('delete_earth');
        return redirect('/earths');
    }
}
