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
    	
        $user->quyen = $request->quyen;
    	
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
        $this->validate($request, 
            [
                'name'      =>'required|min:3',
            ],
            [
                'name.min' => 'Ten it nhat ba ki tu',
                'name.required' => 'Ten khong duoc bo trong',
            
                
            ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->quyen = $request->quyen;
       
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
        return redirect('admin/user/sua/'.$id)->with('thongbao', 'Sua thành công');
    }

    public function getXoa($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('admin/user/danhsach')->with('thongbao', 'Xoa thành công');
    }

}
