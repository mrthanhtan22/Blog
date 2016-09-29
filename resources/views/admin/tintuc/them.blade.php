@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
    <h1 class="page-header">Tin Tức 
        <small>Thêm</small>
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
    <form action="admin/tintuc/them" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <div class="form-group">
            <label>The Loai</label>
            <select class="form-control" id="TheLoai" name="TheLoai">
                @foreach ($theloai as $tl)
                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                @endforeach
                
            </select>
        </div>
        <div class="form-group">
            <label>Loai Tin</label>
            <select class="form-control" id="LoaiTin" name="LoaiTin">
                 @foreach ($loaitin as $lt)
                    <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Tieu de</label>
            <input class="form-control" name="TieuDe" placeholder="Ten tieu de" />
        </div>
        <div class="form-group">
            <label>Tom tat</label>
            <div class="form-group">
            <textarea name="TomTat" id="textarea" class="form-control" rows="3" required="required"></textarea>

              
            </div>
        </div>
        <div class="form-group">
            <label>Noi dung</label>
            <textarea name="NoiDung" id="demo" class="ckeditor"></textarea>
        </div>

        <div class="form-group">
            <label>Anh dai dien</label>
            <input type="file" name="Hinh" id="Hinh">
        </div>
       
        <div class="form-group">
            <label>Noi bat</label>
            <label class="radio-inline">
                <input name="NoiBat" value="0" checked="check" type="radio">Co
            </label>
            <label class="radio-inline">
                <input name="NoiBat" value="1" type="radio">Khong
            </label>
        </div>
        <button type="submit" class="btn btn-default">Them noi dung</button>
        <button type="reset" class="btn btn-default">Lam moi</button>
    <form>
</div>
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
