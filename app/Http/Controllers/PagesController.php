<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\TheLoai;
use App\Slide;
use App\LoaiTin;
use App\TinTuc;
use App\User;

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

    public function getNguoiDung()
    {
        return view('pages.nguoidung');
    }

    public function postNguoiDung(Request $request)
    {
        $this->validate($request, 
            [
                'name'      =>'required|min:3',
            ],
            [
                'name.min' => 'Ten it nhat ba ki tu',
                'name.required' => 'Ten khong duoc bo trong',
            
                
            ]);

        $user = Auth::user();
        $user->name = $request->name;
        
       
        if ($request->changePassword == "on") {
            $this->validate($request, 
            [
                'password' =>'required|min:3|max:32',
                're_password' =>'required|same:password',
            ],
            [
                'password.required'  => 'pass ko dc bo trong',
                'password.min' => 'pass it nhat 3 va nhieu nhat 32 ki tu',
                'password.max' => 'pass it nhat 3 va nhieu nhat 32 ki tu',
                're_password.required' => 'ban chua nhap xac nhan mat khau',
                're_password.same' => 'xac nhan mat khau khong trung voi mat khau',
            
                
            ]);

             $user->password = bcrypt($request->password);
        }
        
        
        
        $user->save();
        return redirect('nguoidung')->with('thongbao', 'Sua thành công');
    }

    public function getDangKi()
    {
        return view('pages.dangki');
    }

    public function postDangKi(Request $request)
    {
       $this->validate($request, 
            [
                'name'      =>'required|min:3',
                'email'    =>'required|unique:users,email',
                'password' =>'required|min:3|max:32',
                're_password' =>'required|same:password',
            ],
            [
                'name.min' => 'Ten it nhat ba ki tu',
                'name.required' => 'Ten khong duoc bo trong',
                'email.required' => 'Email khong duoc bo trong',
                'email.unique' => 'email nay da ton tai',
                'password.required'  => 'pass ko dc bo trong',
                'password.min' => 'pass it nhat 3 va nhieu nhat 32 ki tu',
                'password.max' => 'pass it nhat 3 va nhieu nhat 32 ki tu',
                're_password.required' => 'ban chua nhap xac nhan mat khau',
                're_password.same' => 'xac nhan mat khau khong trung voi mat khau',
            
                
            ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        
        $user->quyen = 0;
        
        $user->save();
        return redirect('dangnhap')->with('thongbao', 'Dang ki nguoi dung thanh cong');

    }

    public function timkiem(Request $request)
    {
        $tukhoa = $request->tukhoa;
        $tintuc = TinTuc::where('TieuDe','like',"%$tukhoa%")->orwhere('TomTat','like',"$tukhoa")->orwhere('NoiDung', 'like',"%$tukhoa%")->take(30)->paginate(5);

        return view('pages.timkiem',['tintuc'=>$tintuc, 'tukhoa'=>$tukhoa]);


    }

}
