@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Tin Tức
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
                    <th>Tiêu Đề</th>
                    <th>Tóm tắt</th>
                    <th>Thể loại</th>
                    <th>Loại tin</th>
                    <th>Nổi bật</th>
                    <th>Xem</th>
                    <th>Delete</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tintuc as $tt)
                   <tr class="odd gradeX" align="center">
                    <td>{{$tt->id}}</td>
                    <td>{{$tt->TieuDe}}
                    <p><img width="100px" src="upload/tintuc/{{$tt->Hinh}}"></p>
                    </td>

                    <td>{{$tt->TomTat}}</td>
                    <td>{{$tt->loaitin->theloai->Ten}}</td>
                    <td>{{$tt->loaitin->Ten}}</td>
                    <td>
                        @if ($tt->NoiBat == 0)
                            {{'Không'}}
                        @endif
                            {{'Có'}}
                    </td>
                    <td>{{$tt->LuotXem}}</td>
                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/tintuc/xoa/{{$tt->id}}"> Delete</a></td>
                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/tintuc/sua/{{$tt->id}}">Edit</a></td>
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