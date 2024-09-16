<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('pages.home');
    }

    public function song(){
        return view('pages.song');
    }

    public function playlist(){
        return view('pages.playlist');
    }

    public function script(){
        return view('pages.script');
    }

    public function editscript($id){
        return view("pages.editscriptpages",['id' => $id]);
    }

    public function player(){
        return view("pages.player");
    }
    
}
