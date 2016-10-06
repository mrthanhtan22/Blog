<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\TinTuc;
use App\TheLoai;
use App\LoaiTin;
use App\Comment;


class TinTucController extends Controller
{
    public function getDanhSach()
    {
    	/*$tintuc = TinTuc::orderBy('id','DESC')->get();*/
    	$tintuc = TinTuc::all();
    	return view('admin.tintuc.danhsach')->with('tintuc', $tintuc);
    }

    public function getThem()
    {
        $theloai = TheLoai::all();
    	$loaitin = LoaiTin::all();
       
    	return view('admin.tintuc.them',['theloai'=>$theloai],['loaitin'=>$loaitin]);
    }

    public function postThem(Request $request)
    {
    	$this->validate($request, 
    		[
    			
    			'LoaiTin'=>'required',
                'TieuDe' =>'required|min:3|max:100',
                'NoiDung' =>'required',

    		],

    		[
    			'LoaiTin.required'=>'Ban chua nhap loai tin',
    			
    			'TieuDe.max'=>'Ten nho nhat 1 ki tu va lon nhat 100 ki tu',
                'TieuDe.min' => 'Ten nho nhat 1 ki tu va lon nhat 100 ki tu',
                'NoiDung.required' => 'Ban chua nhap noi dung bai viet',
    		]);

    	
    	$tintuc = new TinTuc;
    	$tintuc->TieuDe = $request->TieuDe;
    	$tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->NoiBat = $request->NoiBat;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->SoLuotXem = 0;

    	
        if ($request->hasFile('Hinh')) {
            
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') {
                return redirect('admin/tintuc/them')->with('thongbao', 'Them that bai ban chi dc chon file co duoi jpg, png, jpeg');
                }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            
            while (file_exists("upload/tintuc/".$Hinh)) {
                $Hinh = str_random(4)."_".$name;
            }

            $file->move("upload/tintuc/", $Hinh);
            $tintuc->Hinh = $Hinh;
        }
        else
        {
            $tintuc->Hinh = "";
        }
      
    	$tintuc->save();
    	return redirect('admin/tintuc/them')->with('thongbao', 'Thêm thành công');
    }

    public function getSua($id)
    {
        $tintuc = TinTuc::find($id);
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin/tintuc/sua',['tintuc'=>$tintuc, 'loaitin'=>$loaitin,'theloai'=>$theloai]);
    }

    public function postSua(Request $request, $id)
    {
        $tintuc = TinTuc::find($id);
    	$this->validate($request, 
            [
                
                'LoaiTin'=>'required',
                'TieuDe' =>'required|min:3|max:100',
                'NoiDung' =>'required',

            ],

            [
                'LoaiTin.required'=>'Ban chua nhap loai tin',
                
                'TieuDe.max'=>'Ten nho nhat 1 ki tu va lon nhat 100 ki tu',
                'TieuDe.min' => 'Ten nho nhat 1 ki tu va lon nhat 100 ki tu',
                'NoiDung.required' => 'Ban chua nhap noi dung bai viet',
            ]);

        
       
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->NoiBat = $request->NoiBat;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->SoLuotXem = 0;

        
        if ($request->hasFile('Hinh')) {
            
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') {
                return redirect('admin/tintuc/them')->with('thongbao', 'Them that bai ban chi dc chon file co duoi jpg, png, jpeg');
                }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            
            while (file_exists("upload/tintuc/".$Hinh)) {
                $Hinh = str_random(4)."_".$name;
            }

            $file->move("upload/tintuc/", $Hinh);
            unlink("upload/tintuc/".$tintuc->Hinh);
            $tintuc->Hinh = $Hinh;
        }
      
        $tintuc->save();
        return redirect('admin/tintuc/sua'.$id)->with('thongbao', 'Sua thành công');
    }

    public function getXoa($id)
    {
        $tintuc = tintuc::find($id);
        $tintuc->delete();
        return redirect('admin/tintuc/danhsach')->with('thongbao', 'Xoa thành công');
    }
}
