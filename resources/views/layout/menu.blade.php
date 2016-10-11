
                <ul class="list-group" id="menu">
                    <li href="#" class="list-group-item menu1 active">
                    	Menu
                    </li>

                    @foreach ($theloai as $tl)
                        @if (count($tl->loaitin)>0)
                             <li href="#" class="list-group-item menu1">
                        <a href="#">{{$tl->Ten}}</a>
                        </li>
                        @endif
                        <ul>
                        @foreach ($tl->loaitin as $lt)
                                <li class="list-group-item">
                                    <a href="loaitin/{{$lt->id}}/{{$lt->TenKhongDau}}.html">{{$lt->Ten}}</a>
                                </li>
                        @endforeach
                        </ul>
                    @endforeach
                   
                </ul>
            