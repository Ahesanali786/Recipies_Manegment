<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Models\Units;


class UnitsController extends Controller
{
    public function showUnits(){
        $units = Units::all();
        return view('unit-list', compact('units'));
    }
    public function addUnit(Request $request){
        $existunit = Units::where('unitname', $request->unitname)->first();
        if($existunit){
            return redirect('units-add')->with('error', 'Unit already exists.');
        }

        $unit = new Units();
        $unit->unitname = $request->unitname;
        $unit->save();


        return redirect('unit-list')->with('success', 'New unit added successfully');
    }
    public function editUnit($id, Request $request){
        $unit = Units::find($id);
        return view('unit-edit' ,compact('unit'));
    }
    public function updateUnit($id, Request $request){
        $unit = Units::find($id);
        $unit->unitname = $request->unitname;
        $unit->save();

        return redirect('unit-list')->with('success', 'Unit updated successfully');
    }
    public function deleteUnit($id){
        $unit = Units::find($id);
        $unit->delete();

        return redirect('unit-list')->with('success', 'Unit deleted successfully');
    }
}
