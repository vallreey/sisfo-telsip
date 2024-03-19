<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperadminController extends Controller
{
    public function financialData()
    {
        $financialData = Financial::pluck('amount', 'month')->toArray();
        return $financialData;
    }
}
