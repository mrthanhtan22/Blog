@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Slide
                <small>Danh sách</small>
            </h1>
        </div>
        <!-- /.col-lg-12 -->
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
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr align="center">
                    <th>ID</th>
                    <th>Ten slide</th>
                    <th>Hinh anh</th>
                    <th>Noi dung</th>
                    <th>link</th>
                    <th>ngay tao</th>
                    <th>Delete</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($slide as $sl)
                   <tr class="odd gradeX" align="center">
                    <td>{{$sl->id}}</td>
                    <td>{{$sl->Ten}}</td>
                    <td>{{$sl->Hinh}}
                        <p><img width="500px" src="upload/slide/{{$sl->Hinh}}"></p>
                    </td>
                    <td>{{$sl->NoiDung}}</td>
                    <td>{{$sl->link}}</td>
                    <td>{{$sl->created_at}}</td>
                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/slide/xoa/{{$sl->id}}"> Delete</a></td>
                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/slide/sua/{{$sl->id}}">Edit</a></td>
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