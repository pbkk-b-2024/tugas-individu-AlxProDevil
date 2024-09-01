<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Number extends Model
{
    use HasFactory;

    public static function getGanjilGenap($n)
    {
        $details = [];

        for($i = 1; $i <= $n; $i++){
            $details[] = [
                'number' => $i,
                'type' => $i % 2 === 0 ? 'Genap' : 'Ganjil', 
            ];
        }

        return $details;
    }

    public static function getFibonacci($n)
    {
        $details = [];

        for($i = 1; $i <= $n; $i++){
            if($i === 1 || $i === 2){
                $details[] = [
                    'number' => $i,
                    'type' => 1, 
                ];
            }
            else {
                $details[] = [
                    'number' => $i,
                    'type' => $details[$i-2]['type'] + $details[$i-3]['type'], 
                ];
            }
        }

        return $details;
    }

    public static function getPrima($n)
    {
        $details = [];

        for($i = 1; $i <= $n; $i++){
            if($i === 1){
                $details[] = [
                    'number' => $i,
                    'type' => 'Bukan Prima', 
                ];
            }
            else if($i === 2){
                $details[] = [
                    'number' => $i,
                    'type' => 'Prima', 
                ];
            }
            else if($i % 2 === 0 && $i > 2){
                $details[] = [
                    'number' => $i,
                    'type' => 'Bukan Prima',  
                ];
            }
            else {
                if (self::isPrima($i)){
                    $details[] = [
                        'number' => $i,
                        'type' => 'Prima',
                    ];
                }
                else{
                    $details[] = [
                        'number' => $i,
                        'type' => 'Bukan Prima',
                    ];
                }
            }
        }

        return $details;
    }

    public static function isPrima($n){
        for ($i = 3; $i <= sqrt($n); $i += 2) {
            if ($n % $i == 0) {
                return false;
            }
        }
        return true;
    }
}
