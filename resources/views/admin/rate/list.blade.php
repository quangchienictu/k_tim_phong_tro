@extends('admin.layout.master')
@section('content2')
<!-- Main content -->
<div class="content-wrapper">
	<!-- Page header -->
				<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Danh sách các bình luận</h4>
						</div>
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="admin"><i class="icon-home2 position-left"></i> Trang chủ</a></li>
							<li class="active">Trang Quản Lý</li>
						</ul>
					</div>
				</div>
				<!-- /page header -->
	<div class="content">
		<div class="row">
			<div class="col-12">
				<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Danh sách các bình luận <span class="badge badge-primary">{{$rating->count()}}</span></h5>
						</div>

						<div class="panel-body">
							Các <code>bình luận </code> được liệt kê tại đây. <strong>Dữ liệu đang cập nhật.</strong>
						</div>
                        @if(session('thongbao'))
                        <div class="alert bg-success">
							<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
							<span class="text-semibold">Well done!</span>  {{session('thongbao')}}
						</div>
                        @endif
						<table class="table datatable-show-all">
							<thead>
								<tr class="bg-blue">
									<th>ID</th>
									<th>Tiêu đề</th>
									<th>Người đánh giá</th>
									<th>Nội dung</th>
									<th>Vote</th>
									<th>Trạng thái</th>
									<th class="text-center">Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($rating as $rate)
								<tr>
									<td>{{$rate->id}}</td>
									
									<td><a href="phongtro/{{$rate->motel->slug}}" target="_blank">{{$rate->motel->title}}</a></td>
									<td>{{$rate->user->name}}</td>
									
									<td>{{$rate->comment}}</td>
									<td>@php
										for($i=1;$i<=$rate->rate;$i++){
											echo '<i class="fas fa-star" style="color:#ffc40b;margin-right: 2px;"></i>';
										}
									@endphp</td>
									<td>
										@if($rate->status == 1)
											<span class="label label-success">Đã kiểm duyệt</span>
										@elseif($rate->status == 0)
											<span class="label label-danger">Chờ Phê Duyệt</span>
										@endif
									</td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													@if($rate->status == 1)
														<li><a href="admin/rating/check/{{$rate->id}}"><i class="icon-file-pdf"></i> Bỏ kiểm duyệt</a></li>
													@elseif($rate->status == 0)
														<li><a href="admin/rating/check/{{$rate->id}}"><i class="icon-file-pdf"></i> Kiểm duyệt</a></li>
													@endif
													
													<li><a href="admin/rating/delete/{{$rate->id}}"><i class="icon-file-excel"></i> Xóa</a></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
			</div>
		</div>
		<!-- Footer -->
		<div class="footer text-muted">
			&copy; 20. <a href="#">Project Phòng trọ Hà Nội</a> by <a href="" target="_blank">Ngọc Lan</a>
		</div>
		<!-- /footer -->
	</div>
</div>
@endsection