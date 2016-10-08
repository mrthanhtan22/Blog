<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TheLoai;

class PagesController extends Controller
{
    function __construct()
    {
    	$theloai = TheLoai::all();
    	view()->share('theloai', $theloai);
    }

    public function trangchu()
    {
    	return view('pages.trangchu');
    }

    public function lienhe()
    {
    	return view('pages.lienhe');
    }
}
