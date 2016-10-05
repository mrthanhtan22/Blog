<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Slide;

class SlideController extends Controller
{
   	public function getDanhSach()
    {
    	$slide = Slide::all();
    	return view('admin.slide.danhsach',['slide'=>$slide]);
    }

    public function getThem()
    {
    	$slide = slide::all();
       
    	return view('admin.slide.them',['slide'=>$slide]);
    }

    public function postThem(Request $request)
    {
    	$this->validate($request, 
    		[
    			
    			'Ten'=>'required',   
    		],

    		[
    			'Ten.required'=>'Ban chua nhap ten slide',	
    		]);
    	$slide = new Slide;
    	$slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        $slide->Link = $request->Link;
        
    	
        if ($request->hasFile('Hinh')) {
            
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') {
                return redirect('admin/slide/them')->with('thongbao', 'Them that bai ban chi dc chon file co duoi jpg, png, jpeg');
                }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            
            while (file_exists("upload/slide/".$Hinh)) {
                $Hinh = str_random(4)."_".$name;
            }

            $file->move("upload/slide/", $Hinh);
            $slide->Hinh = $Hinh;
        }
        else
        {
            $slide->Hinh = "";
        }
      
    	$slide->save();
    	return redirect('admin/slide/them')->with('thongbao', 'Thêm thành công');
    }

    public function getSua($id)
    {
        $slide = Slide::find($id);
        return view('admin/slide/sua',['slide'=>$slide]);
    }

    public function postSua(Request $request, $id)
    {
        $slide = Slide::find($id);
    	$this->validate($request, 
    		[
    			
    			'Ten'=>'required',   
    		],

    		[
    			'Ten.required'=>'Ban chua nhap ten slide',	
    		]);
    	
    	$slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        $slide->Link = $request->Link;
        
    	
        if ($request->hasFile('Hinh')) {
            
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') {
                return redirect('admin/slide/them')->with('thongbao', 'Them that bai ban chi dc chon file co duoi jpg, png, jpeg');
                }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            
            while (file_exists("upload/slide/".$Hinh)) {
                $Hinh = str_random(4)."_".$name;
            }

            $file->move("upload/slide/", $Hinh);
            unlink("upload/slide/".$slide->Hinh);
            $slide->Hinh = $Hinh;
        }
        
      
    	$slide->save();
    	return redirect('admin/slide/sua/'.$id)->with('thongbao', 'Sua thành công');
    }

    public function getXoa($id)
    {
        $slide = Slide::find($id);
        $slide->delete($id);
        return redirect('admin/slide/danhsach')->with('thongbao', 'Xoa thành công');
    }
}
