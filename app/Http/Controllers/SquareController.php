<?php

namespace App\Http\Controllers;

use App\Models\Square;
use App\Http\Requests\StoreSquareRequest;
use App\Http\Requests\UpdateSquareRequest;
use Illuminate\Http\Request;
use App\Models\Earth;

class SquareController extends Controller
{
    function __construct()
    {
    
    $this->middleware('permission:عرض مربع', ['only' => ['index']]);
    $this->middleware('permission:اضافة مربع', ['only' => ['create','store']]);
    $this->middleware('permission:تعديل مربع', ['only' => ['edit','update']]);
    $this->middleware('permission:حذف مربع', ['only' => ['destroy']]);
    
    }
   
    public function index()
    {
        $squares =  Square::all();
        return view ('squares.index',compact('squares'));
    }

    public function create()
    {
        //
    }

    
    public function store(StoreSquareRequest $request)
    {
        //dd($request->all());

      
       if(Square::where('name',$request->name)->exists())
       {
          return redirect()->back()->withErrors('المربع  مسجل بالفعل');
       }

      try {
        $validated = $request->validated();
        Square::create([
            'name' => $request->name,
            ]);

            session()->flash('Add_squares');
            return redirect('/squares');
           }

        catch (\Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

}

  
    public function show(Square $square)
    {
        //
    }

   
    public function edit(Square $square)
    {
        //
    }

   
    public function update(UpdateSquareRequest $request, Square $square)
    {
        //
    }

   
    public function destroy(Request $request)
    {
        
        //dd($request->all());
        $square_id =  $request->id;
        $earth = Earth::where('square_id',$square_id)->pluck('square_id');
        if($earth->count() == 0)
        {
            $square = Square::where('id', $square_id)->first();
            $square->delete();
            session()->flash('delete_square');
            return redirect('/squares');
        }
        else
        {

            return redirect()->back()->withErrors('لا يمكن مسح المربع ،، يحتوي على اراضي');
            //return redirect()->route('squares.index');
  
        }

       
    }//end of destroy
}//end of controller
