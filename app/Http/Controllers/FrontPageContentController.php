<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FrontPageContent;
use App\Models\Location;
use Illuminate\Http\Request;

class FrontPageContentController extends Controller
{
    //
    public function index()
    {
        
        return view('welcome' , [
            'frontPage' => FrontPageContent::first() , 
            'locations' => Location::all() , 
            'categories' => Category::all()]);
    }
}
