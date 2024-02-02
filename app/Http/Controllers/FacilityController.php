<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    //
    public function show(Request $request)
    {
        $facility = Facility::where('slug', $request['facility'])->firstOrFail();
        return $facility;
    }
}
