@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
    <h1 class="page-header">Slide
        <small>Sua slide {{$slide->Ten}}</small>
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
    <form action="admin/slide/sua/{{$slide->id}}" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <div class="form-group">
            <label>Ten Slide</label>
            <input class="form-control" name="Ten" placeholder="Ten Slider"  value="{{$slide->Ten}}" />
        </div>
        <div class="form-group">
            <label>Anh slide</label>
            <p>
                <img type="images" width="500px" src="upload/slide/{{$slide->Hinh}}">
            </p>
            <input type="file" name="Hinh" id="Hinh">
        </div>
        <div class="form-group">
            <label>Noi dung</label>
            <textarea name="NoiDung" id="demo" class="ckeditor"> {{$slide->link}}</textarea>
        </div>
        <div class="form-group">
            <label>Link Slide</label>
            <input class="form-control" name="Link" placeholder="link Slider" value="{{$slide->link}}"/>
        </div>
        
        <button type="submit" class="btn btn-default">Them moi slide</button>
        <button type="reset" class="btn btn-default">Lam moi</button>
    <form>
</div>
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>

@endsection

