@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<h1 class="page-header">Category
    <small>List</small>
</h1>
</div>
<!-- /.col-lg-12 -->
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    @if (session('thongbao'))
       <div class="alert alert-success">
           <strong>Thongbao!</strong> {{session('thongbao')}}
       </div>
    @endif
<thead>
    <tr align="center">
        <th>ID</th>
        <th>Ten</th>
        <th>Ten Khong dau</th>
       
        <th>Delete</th>
        <th>Edit</th>
    </tr>
</thead>
<tbody>
    @foreach ($danhsach as $row)
        <tr class="odd gradeX" align="center">
        <td>{{$row->id}}</td>
        <td>{{$row->Ten}}</td>
        <td>{{$row->TenKhongDau}}</td>
        
        
        <td class="center xoa"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/theloai/xoa/{{$row->id}}" class="xoa"> Delete</a></td>
        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/theloai/sua/{{$row->id}}">Edit</a></td>
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