@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
    <h1 class="page-header">Tin Tức 
        <small>Sửa tin tức {{$tintuc->TieuDe}}</small>
    </h1>
</div>
<!-- /.col-lg-12 -->
<div class="col-lg-9" style="padding-bottom:120px">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Thông báo!</strong> 
                    @foreach ($errors->all() as $err)
                        {{$err}} <br>
                    @endforeach
                </div>
            @endif
            @if (session('thongbao'))
                <div class="alert alert-success">
                    <strong>Thông báo!</strong>{{session('thongbao')}}
                </div>
            @endif
    <form action="admin/tintuc/sua/{{$tintuc->id}}" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <div class="form-group">
            <label>The Loai</label>
            <select class="form-control" id="TheLoai" name="TheLoai">
                @foreach ($theloai as $tl)
                    <option 
                    @if ($tintuc->loaitin->theloai->id == $tl->id)
                        {{"selected"}}
                    @endif
                    value="{{$tl->id}}">{{$tl->Ten}}</option>
                @endforeach
                
            </select>
        </div>
        <div class="form-group">
            <label>Loai Tin</label>
            <select class="form-control" id="LoaiTin" name="LoaiTin">
                 @foreach ($loaitin as $lt)
                    <option 
                    @if ($tintuc->loaitin->id == $lt->id)
                        {{"selected"}}
                    @endif
                    value="{{$lt->id}}">{{$lt->Ten}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Tieu de</label>
            <input class="form-control" name="TieuDe" placeholder="Ten tieu de" value="{{$tintuc->TieuDe}}" />
        </div>
        <div class="form-group">
            <label>Tom tat</label>
            <div class="form-group">
            <textarea name="TomTat" id="textarea" class="form-control" rows="3" required="required" value="{{$tintuc->TomTat}}"></textarea>

              
            </div>
        </div>
        <div class="form-group">
            <label>Noi dung</label>
            <textarea name="NoiDung" id="demo" class="ckeditor" value="{{$tintuc->NoiDung}}"></textarea>
        </div>

        <div class="form-group">
            <label>Anh dai dien</label>
            <p>
               <img width="400px" type="images" src="upload/tintuc/{{$tintuc->Hinh}}">   
            </p>
            <input type="file" name="Hinh" id="Hinh">
        </div>
       
        <div class="form-group">
            <label>Noi bat</label>
            <label class="radio-inline">
                <input name="NoiBat" value="0" type="radio"
                    @if ($tintuc->NoiBat == 1)
                        {{"checked"}}
                    @endif
                >Co
            </label>
            <label class="radio-inline">
                <input name="NoiBat" value="1" type="radio"
                    @if ($tintuc->NoiBat == 0)
                        {{"checked"}}
                    @endif
                >Khong
            </label>
        </div>
        <button type="submit" class="btn btn-default">Them noi dung</button>
        <button type="reset" class="btn btn-default">Lam moi</button>
    <form>
</div>
</div>
<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Comment
                <small>Danh sách</small>
            </h1>
        </div>
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr align="center">
                    <th>ID</th>
                    <th>Nội dung</th>
                    <th>Tên user</th>
                    <th>Ngay tao</th>
                    <th>Delete</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($tintuc->comment as $cm)
                <tr class="odd gradeX" align="center">
                    <td>{{$cm->id}}</td>
                    <td>{{$cm->NoiDung}}</td>
                    <td>{{$cm->user->name}}</td>
                    <td>{{$cm->created_at}}</td>
                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{$cm->id}}/{{$tintuc->id}}"> Delete</a></td>  
                </tr>
                @endforeach
                   
               
              
            </tbody>
        </table>
    </div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>

@endsection
@section('script')
    <script>
        $(document).ready(function() {
           $("#TheLoai").change(function() {
               var idTheLoai = $(this).val();
               $.get("admin/ajax/loaitin/"+idTheLoai,function(data){
                    $("#LoaiTin").html(data);
               });
           }); 
        });
    </script>
@stop
