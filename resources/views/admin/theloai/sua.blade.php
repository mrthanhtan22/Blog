@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
    <h1 class="page-header">Thể loại
        <small>{{$theloai->Ten}}</small>
    </h1>
</div>
<!-- /.col-lg-12 -->
<div class="col-lg-7" style="padding-bottom:120px">
    <form action="admin/theloai/sua/{{$theloai->id}}" method="POST">
        @if (count($errors)>0)
            <div class="alert alert-danger">
                <strong>Thong bao!</strong> 
                @foreach ($errors as $err)
                    {{$err}} <br>
                @endforeach
            </div>
        @endif
        @if (session('thongbao'))
            <div class="alert alert-success">
                <strong>Thongbao</strong> {{session('thongbao')}}
            </div>
        @endif
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="form-group">
            <label>Tên thể loại</label>
            <input class="form-control" name="Ten" placeholder="Nhập tên thể loại cần sửa" value="{{$theloai->Ten}}" />
        </div>
        
        <button type="submit" class="btn btn-default">Chỉnh sửa</button>
        <button type="reset" class="btn btn-default">Reset</button>
    <form>
</div>
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
@endsection