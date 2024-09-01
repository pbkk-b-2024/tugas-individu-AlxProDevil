<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Number;

class Pertemuan1Controller extends Controller 
{
    public function ganjilGenap(Request $request){
        $numberDetails = [];
        if ($request->has('n')){
            $validatedData = $request->validate([
                    'n' => 'required|integer|min:1',
                ]);

                $n = $validatedData['n'];
                $numberDetails = Number::getGanjilGenap($n);
        }
        return view('pertemuan1.ganjil-genap', compact('numberDetails'));
    }

    public function fibonacci(Request $request){
        $numberDetails = [];
        if ($request->has('n')){
            $validatedData = $request->validate([
                    'n' => 'required|integer|min:1',
                ]);

                $n = $validatedData['n'];
                $numberDetails = Number::getFibonacci($n);
        }
        return view('pertemuan1.fibonacci', compact('numberDetails'));
    }

    public function prima(Request $request){
        $numberDetails = [];
        if ($request->has('n')){
            $validatedData = $request->validate([
                    'n' => 'required|integer|min:1',
                ]);

                $n = $validatedData['n'];
                $numberDetails = Number::getPrima($n);
        }
        return view('pertemuan1.prima', compact('numberDetails'));
    }

    public function routing(){
        return view('pertemuan1.routing');
    }

    public function param1($param1 = ''){
        $data['param1'] = $param1;
        return view('pertemuan1.route.param1',compact('data'));
    }

    public function param2($param1 ='', $param2 =''){
        $data['param1'] = $param1;
        $data['param2'] = $param2;
        return view('pertemuan1.route.param2',compact('data'));
    }
}