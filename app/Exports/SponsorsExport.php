<?php

namespace App\Exports;

use App\Models\Sponsor;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class SponsorsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $Sponsor = User::select('name','email','phone','add','ssn','bank_account','gender')
        ->where('user_type', 'sponsor')->get();
        return $Sponsor;
    }
}
