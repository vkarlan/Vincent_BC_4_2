<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Student_Controller extends Controller
{
    //
    function newstudent(Request $req, $name, $age, $phone){
        
        DB::beginTransaction();
        try{
            $this->validate($req, [
                'name' => 'required',
                'age' => 'required',
                'phone' => 'required']);
    
            DB::table('student')->insert([
                'name' => $name,
                'age' => $age,
                'phone' => $phone]);
    
            $s = DB::table('student')->where('student.name', '=', $name)
                                    ->select('student.name', 'student.age', 'student.phone')
                                    ->get();
            DB::commit();
            return response()->json($s, 201);
            }
        catch(\Exception $e){
            DB::rollback();
            return response()->json(['message'=>'Failed to add, exception:' + $e], 500);
        }
    }
        
    
        function updatestudent(Request $req, $id, $name, $age, $phone){
    
        DB::beginTransaction();
        try{
            $this->validate($req, [
                'id' => 'required',
                'name' => 'required',
                'age' => 'required',
                'phone' => 'required']);
    
            DB::table('student')->where('student.id', '=', $id)
                                ->update(['name' => $name, 'age' => $age, 'phone' => $phone]);
    
            $s = DB::table('student')->where('student.id', '=', $id)
                                    ->select('student.name', 'student.age', 'student.phone')
                                    ->get();
            DB::commit();
            return response()->json($s, 201);
        }
        catch(\Exception $e){
            DB::rollback();
            return response()->json(['error'=>'exception:' + $e], 500);}
        }
}
