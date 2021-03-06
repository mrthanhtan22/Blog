@extends('layout.index')

@section('content')

  <!-- Page Content -->
    <div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{$tintuc->TieuDe}}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">admin</a>
                </p>

                <!-- Preview Image -->
                <img class="img-responsive" src="upload/tintuc/{{$tintuc->Hinh}}" alt="">

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span>{{$tintuc->created_at}}</p>
                <hr>

                <!-- Post Content -->
                <p class="lead">{!!$tintuc->NoiDung!!}</p>
                

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                @if (Auth::check())
                <div class="well">
                    <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
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
                    <form role="form" action="comment/{{$tintuc->id}}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="NoiDung"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi</button>
                    </form>
                </div>
                @else
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Ban phai dang nhap moi co the Binh luan</h3>
                        </div>
                        <div class="panel-body">
                            
                        </div>
                    </div>
                @endif
                

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                @foreach ($tintuc->comment as $cm)
                   <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$cm->user->name}}
                            <small>{{$cm->created_at}}</small>
                        </h4>
                        {!!$cm->NoiDung!!}
                    </div>
                </div>
                @endforeach
                

                

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin liên quan</b></div>
                    <div class="panel-body">

                    @foreach ($tinlienquan as $lq)
                         <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="tintuc/{{$lq->id}}/{{$lq->TieuDeKhongDau}}.html">
                                    <img class="img-responsive" src="upload/tintuc/{{$lq->Hinh}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="tintuc/{{$lq->id}}/{{$lq->TieuDeKhongDau}}.html"><b>{{$lq->TieuDe}}</b></a>
                            </div>
                            <p>{{$lq->TomTat}}</p>
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                    @endforeach
                       

                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">
                    @foreach ($tinnoibat as $nb)
                         <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="tintuc/{{$nb->id}}/{{$nb->TieuDeKhongDau}}.html">
                                    <img class="img-responsive" src="upload/tintuc/{{$nb->Hinh}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="tintuc/{{$nb->id}}/{{$nb->TieuDeKhongDau}}.html"><b>{{$nb->TieuDe}}</b></a>
                            </div>
                            <p>{{$nb->TomTat}}</p>
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                    @endforeach
                       
                    </div>
                </div>
                
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
@stop