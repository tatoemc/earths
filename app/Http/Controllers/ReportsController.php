<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Square;
use App\Models\Earth;

class ReportsController extends Controller
{
    
    public function index(Request $request)
    {

        if ($request->enumber) {

            try {
                 $enumber = $request->enumber;
     
                 $enumbers = Earth::where('enumber',$enumber)->get();
                 return view ('reports.Earth',compact('enumbers'));
             }
       
            
           catch (\Exception $e){
             return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }

          

        } //end of if 

 
     return view ('reports.index');
        

    }

   
    public function create(Request $request)
    {
       
    
    }

    
    public function store(Request $request)
    {
        
     
    }

   
    public function square(Request $request)
    {
        
        if ($request->square_id) {

            try {
                 $square_id = $request->square_id;
     
                 $square = Square::where('id',$square_id)
                 ->with('earths')
                 ->first();

                 //dd($square);
                 return view ('reports.edit',compact('square'));
             }
       
            
           catch (\Exception $e){
             return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }

          

        } //end of if 

 
     return view ('reports.square');

    }

   
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
