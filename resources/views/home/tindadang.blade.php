@extends('layouts.master')
@section('content')
    <div class="gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="entry-title entry-prop">Danh Sách Tin Đã Đăng</h1>
                <hr>
                <div class="panel panel-default">
                    {{--                    <div class="panel-heading">Thông tin bắt buộc*</div>--}}
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="bg-blue">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tiêu Đề</th>
                                    <th scope="col">Danh Mục</th>
                                    <th scope="col" width="100">Giá Phòng</th>
                                    <th scope="col" width="100">Diện Tích</th>
{{--                                    <th scope="col">Số Điện Thoại</th>--}}
                                    <th scope="col">Tiện Ích</th>
                                    <th scope="col">Trạng Thái</th>
                                    <th>Tình trạng</th>
                                    <td style="min-width: 200px">Action</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tinDangs as $key => $item)
                                    <tr>
                                        <th scope="row">{{$item->id}}</th>
                                        <td><a href="phongtro/{{$item->slug}}" target="_blank">{{$item->title}}</a></td>
                                        <td>{{$item->name}}</td>
                                        <td>{{number_format($item->price)}}</td>
                                        <td>{{$item->area}}</td>
{{--                                        <td>{{$item->phone}}</td>--}}
                                        <td>
                                            @if(json_decode($item->utilities,true))
                                                @foreach(json_decode($item->utilities,true) as $key2 => $utiliti)
                                                    {{$utiliti}} ,
                                                @endforeach
                                            @endif

                                        </td>
                                        <td>
                                            @if($item->approve == 1)
                                                <span class=" label label-success"> Đã Kiểm Duyệt</span>
                                            @else
                                                <span class=" label label-danger"> Chờ Phê Duyệt</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->status == 0)
                                                <a href="{{route('user.edittindadang', $item->id)}}"><span class=" btn btn-success">Còn phòng</span></a>
                                            @else
                                                <a href="{{route('user.edittindadang', $item->id)}}"><span class=" btn btn-danger"> Đã cho thuê </span></a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('user.editdangtin', $item->id)}}" class="btn btn-info">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            <a href="{{route('user.deleteMotel', $item->id)}}" class="btn btn-danger">
                                                <i class="fa fa-trash"></i> Xóa
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
    
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            {{--            <div class="col-md-4">--}}
            {{--                <div class="contactpanel">--}}
            {{--                    <div class="row">--}}
            {{--                        <div class="col-md-4 text-center">--}}
            {{--                            <img src="assets/images/noavt.png" class="img-circle" alt="Cinque Terre" width="100"--}}
            {{--                                 height="100">--}}
            {{--                        </div>--}}
            {{--                        <div class="col-md-8">--}}
            {{--                            <h4>Thông tin người đăng</h4>--}}
            {{--                            <strong> {{ Auth::user()->name }}</strong><br>--}}
            {{--                            <i class="far fa-clock"></i> Ngày tham gia: {{ Auth::user()->created_at }}--}}

            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}

            {{--                <div class="gap"></div>--}}
            {{--                <img src="images/banner-1.png" width="100%">--}}
            {{--            </div>--}}
        </div>
    </div>

@endsection