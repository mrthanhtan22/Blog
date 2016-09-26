@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Loai tin
            <small>Sửa loại tin {{$loaitin->Ten}}</small>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-lg-7" style="padding-bottom:120px">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Thong bao!</strong>
                @foreach ($errors->all() as $err)
                    {{$err}}<br>
                @endforeach     
            </div>
        @endif
        @if (session('thongbao'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Thon bao!</strong>{{session('thongbao')}}
            </div>
        @endif

        
           
            <form action="admin/loaitin/sua/{{$loaitin->id}}" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-group">
                    <label>Thể Loại</label>
                    <select class="form-control" name="TheLoai">
                    @foreach ($theloai as $tl)
                      <option 
                        @if ($loaitin->idTheLoai == $tl->id)
                            {{"selected"}}
                        @endif
                       value="{{$tl->id}}">
                       {{$tl->Ten}}
                       </option>
                    @endforeach   
                    </select>
                </div>
                <div class="form-group">
                    <label>Loại Tin</label>
                    <input class="form-control" name="Ten" placeholder="Hay nhap ten loai tin" value="{{$loaitin->Ten}}" />
                </div>
               
                <button type="submit" class="btn btn-default">Sua loại tin</button>
                <button type="reset" class="btn btn-default">Reset</button>
            <form>
        </div>
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
@endsection