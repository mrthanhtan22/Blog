@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
    <h1 class="page-header">user
        <small>Thêm user</small>
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
    <form action="admin/user/them" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <div class="form-group">
            <label>Ten user</label>
            <input class="form-control" name="Ten" placeholder="Ten userr" />
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Nhap email">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Nhap password">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="re_password" id="inputPassword" class="form-control" placeholder="Nhap lai password">
        </div>
        <div class="form-group">
            <label>Quyen nguoi dung</label>
            <label class="radio-inline">
                <input name="quyen" value="0" checked="check" type="radio">thuong
            </label>
            <label class="radio-inline">
                <input name="quyen" value="1" type="radio">Admin
            </label>
        </div>
        <button type="submit" class="btn btn-default">Them moi user</button>
        <button type="reset" class="btn btn-default">Lam moi</button>
    <form>
</div>
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>

@endsection

