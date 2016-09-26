@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Loại tin
            <small>Danh sach</small>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
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
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        
        <thead>
            <tr align="center">
                <th>ID</th>
                <th>Ten Loại tin</th>
                <th>Ten khong dau</th>
                <th>Tên Thể loại</th>
                <th>Delete</th>
                <th>Edit</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($loaitin as $row)
                <tr class="odd gradeX" align="center">
                <td>{{$row->id}}</td>
                <td>{{$row->Ten}}</td>
                <td>{{$row->TenKhongDau}}</td>
                <td>{{$row->theloai->Ten}}</td>
 
                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/loaitin/xoa/{{$row->id}}"> Delete</a></td>
                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/loaitin/sua/{{$row->id}}">Edit</a></td>
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