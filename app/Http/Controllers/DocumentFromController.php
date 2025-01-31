<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentFrom;

class DocumentFromController extends Controller
{
    public function index(){
        $w = DocumentFrom::all();
        return view("mainsreen", compact("w"));
        //dump($w);
    }
}
