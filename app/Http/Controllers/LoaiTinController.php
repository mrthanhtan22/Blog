<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\LoaiTin;
use App\TheLoai;

class LoaiTinController extends Controller
{
   	public function getDanhSach()
    {
    	$loaitin = LoaiTin::all();
    	return view('admin.loaitin.danhsach')->with('loaitin', $loaitin);
    }

    public function getThem()
    {
    	$theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
    	return view('admin.loaitin.them',['loaitin'=>$loaitin, 'theloai'=>$theloai]);
    }

    public function postThem(Request $request)
    {
    	$this->validate($request, 
    		[
    			'Ten'=>'required|min:3|max:100',
    			'TheLoai'=>'required',

    		],

    		[
    			'Ten.required'=>'Ban chua nhap ten',
    			'Ten.min'=>'Ten nho nhat 1 ki tu va lon nhat 100 ki tu',
    			'Ten.max'=>'Ten nho nhat 1 ki tu va lon nhat 100 ki tu',
    		]);

    	
    	$loaitin = new LoaiTin;
    	$loaitin->Ten = $request->Ten;
    	$loaitin->TenKhongDau = changeTitle($request->Ten);
    	$loaitin->idTheLoai = $request->TheLoai;
    	$loaitin->save();
    	return redirect('admin/loaitin/them')->with('thongbao', 'Thêm thành công');
    }

    public function getSua($id)
    {
        $loaitin = LoaiTin::find($id);
        $theloai = TheLoai::all();
        return view('admin/loaitin/sua',['loaitin'=>$loaitin],['theloai'=>$theloai]);
    }

    public function postSua(Request $request, $id)
    {
    	$this->validate($request, 
    		[
    			'Ten'=>'required|min:3|max:100',
    			'TheLoai'=>'required',

    		],

    		[
    			'Ten.required'=>'Ban chua nhap ten',
    			'Ten.min'=>'Ten nho nhat 1 ki tu va lon nhat 100 ki tu',
    			'Ten.max'=>'Ten nho nhat 1 ki tu va lon nhat 100 ki tu',
    		]);
    	$loaitin = LoaiTin::find($id);
    	$loaitin->Ten = $request->Ten;
    	$loaitin->TenKhongDau = changeTitle($request->Ten);
    	$loaitin->idTheLoai = $request->TheLoai;
    	$loaitin->save();
    	return redirect('admin/loaitin/them')->with('thongbao', 'Thêm thành công');
    }

    public function getXoa($id)
    {
        $LoaiTin = LoaiTin::find($id);
        $LoaiTin->delete($id);
        return redirect('admin/loaitin/danhsach')->with('thongbao', 'Xoa thành công');
    }

}
