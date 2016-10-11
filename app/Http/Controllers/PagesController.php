<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\TheLoai;
use App\Slide;
use App\LoaiTin;
use App\TinTuc;

class PagesController extends Controller
{
    function __construct()
    {
    	$theloai = TheLoai::all();
    	view()->share('theloai', $theloai);

        $slide = Slide::all();
        view()->share('slide', $slide);

        if (Auth::check()) 
        {
           view()->share('nguoidung', Auth::user());
        }
    }

    public function trangchu()
    {
    	return view('pages.trangchu');
    }

    public function lienhe()
    {
        return view('pages.lienhe');
    }

    public function loaitin($id)
    {
        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);
        return view('pages.loaitin',['loaitin'=>$loaitin],['tintuc'=>$tintuc]);
    }

    public function tintuc($id)
    {
        $tintuc =           TinTuc::find($id);
        $tinlienquan =      TinTuc::where('idLoaiTin', $tintuc->idLoaiTin)->take(4)->get();
        $tinnoibat   =    TinTuc::where('NoiBat', 1)->take(4)->get();
         

    	return view('pages.tintuc',['tinlienquan'=>$tinlienquan,'tinnoibat'=> $tinnoibat,'tintuc'=>$tintuc]);
    }

    public function getdangnhap()
    {
        return view('pages/dangnhap');
    }

    public function postdangnhap(Request $request)
    {
        $this->validate($request, 
            [
                'email'      =>'required',
                'password'    =>'required|min:3|max:32',
               
            ],
            [ 

                'email.required' => 'Ten khong duoc bo trong',
                'password.required'  => 'pass ko dc bo trong',
                'password.min' => 'pass it nhat 3 va nhieu nhat 32 ki tu',
                'password.max' => 'pass it nhat 3 va nhieu nhat 32 ki tu',
                
            ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            
            return redirect('trangchu');
        }
        else
        {
             return redirect('dangnhap')->with('thongbao', 'Dang nhap khong thành công');
        }
    }
    public function getdangxuat()
    {
        Auth::logout();
        return redirect('trangchu')->with('thongbao', 'Dang xuat thành công');
    }

}
