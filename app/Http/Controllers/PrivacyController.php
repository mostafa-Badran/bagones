<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class PrivacyController extends Controller
{
    protected $namespace = null;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
 

        $page_title = 'Privacy Plolicy';
        $page_description = '';

        return view('privacy.index', compact('page_title', 'page_description'));
    }


 
}
