<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\TheLoai;

class TheLoaiController extends Controller
{
    public function getDanhSach()
    {
    	$danhsach = TheLoai::all();
    	return view('admin.theloai.danhsach')->with('danhsach', $danhsach);
    }

    public function getThem()
    {
    	return view('admin.theloai.them');
    }

    public function postThem(Request $request)
    {
    	$this->validate($request, 
    		[
    			'txtCateName'=>'required|min:3|max:100'
    		],

    		[
    			'txtCateName.required'=>'Ban chua nhap ten',
    			'txtCateName.min'=>'Ten nho nhat 1 ki tu va lon nhat 100 ki tu',
    			'txtCateName.max'=>'Ten nho nhat 1 ki tu va lon nhat 100 ki tu',
    		]);

    	$theloai = new TheLoai;
    	$theloai->Ten = $request->txtCateName;
    	$theloai->TenKhongDau = changeTitle($request->txtCateName);
    	$theloai->save();
    	return redirect('admin/theloai/them')->with('thongbao', 'Thêm thành công');
    }

    public function getSua($id)
    {
        $theloai = TheLoai::find($id);
        return view('admin.theloai.sua',['theloai'=>$theloai]);
    }

    public function postSua(Request $request, $id)
    {
        $theloai = TheLoai::find($id);
        $this->validate($request,
            [
                'Ten'=> 'required|min:3|max:100'
            ],

            [
                'Ten.required' => 'Ban chua nhap ten',
                'Ten.min' => 'Ten nho nhat 1 ki tu va lon nhat 100 ki tu',
                'Ten.max' =>'Ten nho nhat 1 ki tu va lon nhat 100 ki tu',
            ]
        );

        
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/sua/'.$id)->with('thongbao','Sua thanh cong');
    }

    public function getXoa($id)
    {
        $theloai = TheLoai::find($id);
        $theloai->delete($id);
        return redirect('admin/theloai/danhsach')->with('thongbao', 'Xoa thành công');
    }





}
