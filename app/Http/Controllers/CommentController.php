<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comment;

class CommentController extends Controller
{
    function getXoa($id, $idTinTuc)
    {
    	$comment = Comment::find($id);
    	$comment->delete();
    	 return redirect('admin/tintuc/sua/'.$idTinTuc)->with('thongbao', 'Xoa thành công comment');
    }
}
