<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class UserController extends Controller
{
    public function getdanhsach()
    {
    	$user = User::all();
    	return view('admin/user/danhsach')->with('user', $user);
    }

    public function getThem()
    {
    	return view('admin/user/them');
    }

    public function postThem(Request $request)
    {
    	$this->validate($request, 
    		[
    			'Ten'=>'required|min:3|max:100'
    		],

    		[
    			'txtCateName.required'=>'Ban chua nhap ten',
    			'txtCateName.min'=>'Ten nho nhat 1 ki tu va lon nhat 100 ki tu',
    			'txtCateName.max'=>'Ten nho nhat 1 ki tu va lon nhat 100 ki tu',
    		]);

    	$user = new user;
    	$user->Ten = $request->txtCateName;
    	$user->TenKhongDau = changeTitle($request->txtCateName);
    	$user->save();
    	return redirect('admin/user/them')->with('thongbao', 'Thêm thành công');
    }

    public function getSua($id)
    {
        $user = user::find($id);
        return view('admin.user.sua',['user'=>$user]);
    }

    public function postSua(Request $request, $id)
    {
        $user = user::find($id);
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

        
        $user->Ten = $request->Ten;
        $user->TenKhongDau = changeTitle($request->Ten);
        $user->save();
        return redirect('admin/user/sua/'.$id)->with('thongbao','Sua thanh cong');
    }

    public function getXoa($id)
    {
        $user = user::find($id);
        $user->delete($id);
        return redirect('admin/user/user')->with('thongbao', 'Xoa thành công');
    }

}
