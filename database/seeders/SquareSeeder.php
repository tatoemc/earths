<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Square;
use Illuminate\Support\Facades\DB;

class SquareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('squares')->delete();

        $squares = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15'];

        foreach($squares as  $square){
            Square::create(['name' => $square]);
        }

    }



}

