@extends('layouts.master')
@section('content')
<?php 
function limit_description($string){
	$string = strip_tags($string);
	if (strlen($string) > 100) {

	    // truncate string
	    $stringCut = substr($string, 0, 100);
	    $endPoint = strrpos($stringCut, ' ');

	    //if the string doesn't contain any space then it will cut without word basis.
	    $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
	    $string .= '...';
	}
	return $string;
}
function time_elapsed_string($datetime, $full = false) {
	$now = new DateTime;
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);

	$diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;

	$string = array(
		'y' => 'năm',
		'm' => 'tháng',
		'w' => 'tuần',
		'd' => 'ngày',
		'h' => 'giờ',
		'i' => 'phút',
		's' => 'giây',
	);
	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
		} else {
			unset($string[$k]);
		}
	}

	if (!$full) $string = array_slice($string, 0, 1);
	return $string ? implode(', ', $string) . ' trước' : 'Vừa xong';
}
?>
<div class="container-fluid" style="padding-left: 0px;padding-right: 0px;">
	<div class="search-map hidden-xs" >
		<div id="map"></div>
		<div class="box-search">
				<!-- <div id="flat"></div>
					<div id="lng"></div> -->
					<form onsubmit="return false">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group row">
							<div class="col-xs-6">
								<select class="selectpicker" data-live-search="true" id="selectdistrict">
									@foreach($district as $quan)
									<option data-tokens="{{$quan->slug}}" value="{{ $quan->id }}">{{ $quan->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-xs-6">
								<select class="selectpicker" data-live-search="true" id="selectcategory">
									@foreach($categories as $category)
									<option data-tokens="{{ $category->slug }}" value="{{ $category->id }}">{{ $category->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-xs-6">
								<select class="selectpicker" id="selectprice" data-live-search="true">
									<option data-tokens="khoang gia" min="1" max="10000000">Khoảng giá</option>
									<option data-tokens="Tu 500.000 VNĐ - 700.000 VNĐ" min="500000" max ="700000">Từ 500.000 VNĐ - 700.000 VNĐ</option>
									<option data-tokens="Tu 700.000 VNĐ - 1.000.000 VNĐ" min="700000" max ="1000000">Từ 700.000 VNĐ - 1.000.000 VNĐ</option>
									<option data-tokens="Tu 1.000.000 VNĐ - 1.500.000 VNĐ" min="1000000" max ="1500000">Từ 1.000.000 VNĐ - 1.500.000 VNĐ</option>
									<option data-tokens="Tu 1.500.000 VNĐ - 3.000.000 VNĐ" min="1500000" max ="3000000">Từ 1.500.000 VNĐ - 3.000.000 VNĐ</option>
									<option data-tokens="Tren 3.000.000 VNĐ" min="3000000" max="10000000">Trên 3.000.000 VNĐ</option>
								</select>
							</div>
							<div class="col-xs-6">
								<button class="btn btn-success" onclick="searchMotelajax()">Tìm kiếm ngay</button>
							</div>
						</div>
						
						<form>
						</div>
					</div>


				</div>
				<div class="container">
					<div class="row" style="margin-top: 10px; margin-bottom: 10px">
						<div class="col-md-6">
							<div class="asks-first">
					            <div class="asks-first-circle">
					              <span class="fa fa-search"></span>
					            </div>
					            <div class="asks-first-info">
					              <h2>Giải pháp tìm kiếm mới</h2>
					              <p>Tiết kiệm nhiều thời gian cho bạn với giải pháp và công nghệ mới</p>
					            </div>
				          	</div>
						</div>
						<div class="col-md-6">
							<div class="asks-first2">
					            <div class="asks-first-circle">
					              <span class="fas fa-hourglass-start"></span>

					            </div>
					            <div class="asks-first-info">
					              <h2>An Toàn - Nhanh chóng</h2>
					              <p>Với đội ngũ Quản trị viên kiểm duyệt hiệu quả, Chất Lượng đem lại sự tin tưởng.</p>
					            </div>
				          	</div>
						</div>
					</div>
					<h3 class="title-comm"><span class="title-holder">PHÒNG TRỌ XEM NHIỀU NHẤT</span></h3>
					<div class="row room-hot">
						@foreach($hot_motelroom as $room)
						<?php 
							$img_thumb = json_decode($room->images,true);
							
						 ?>
						<div class="col-md-4 col-sm-6">
							<div class="room-item">
								<div class="wrap-img" style="background: url(uploads/images/<?php echo $img_thumb[0]; ?>) center;     background-size: cover;">
									<img src="" class="lazyload img-responsive">
									<div class="category">
										<a href="category/{{ $room->category->id }}">{{ $room->category->name }}</a>
									</div>
								</div>
								<div class="room-detail">
									<h4><a href="phongtro/{{ $room->slug }}">{{ $room->title }}</a></h4>
									<div class="room-meta">
										<span><i class="fas fa-user-circle"></i> Người đăng: <a href="/"> {{ $room->user->name }}</a></span>
										<span class="pull-right"><i class="far fa-clock"></i>
											<?php 
											echo time_elapsed_string($room->created_at);
											?>
										</span>
									</div>
									<div class="room-description"><i class="fas fa-audio-description"></i>
										{{ limit_description($room->description) }}</div>
									<div class="room-info">
										<span><i class="far fa-stop-circle"></i> Diện tích: <b>{{ $room->area }} m<sup>2</sup></b></span>
										<span class="pull-right"><i class="fas fa-eye"></i> Lượt xem: <b>{{ $room->count_view }}</b></span>
										<div><i class="fas fa-map-marker"></i> Địa chỉ: {{ $room->address }}</div>
										<div style="color: #e74c3c"><i class="far fa-money-bill-alt"></i> Giá thuê: 
											<b>{{ number_format($room->price) }} VNĐ</b></div>
										</div>
									</div>

								</div>
							</div>
							@endforeach
							
								
								</div>
							</div>
							<div class="container">
								<h3 class="title-comm"><span class="title-holder">PHÒNG TRỌ HÀ NỘI</span></h3>
								<div class="row">
									<div class="col-md-8">
										@foreach($listmotelroom as $room)
										<?php 
											$img_thumb = json_decode($room->images,true);
										 ?>
										<div class="room-item-vertical">
											<div class="row">
												<div class="col-md-4">
													<div class="wrap-img-vertical" style="background: url(uploads/images/<?php echo $img_thumb[0]; ?>) center;     background-size: cover;">
														
														<div class="category">
															<a href="category/{{ $room->category->id }}">{{ $room->category->name }}</a>
														</div>
													</div>
												</div>
												<div class="col-md-8">
													<div class="room-detail">
														<h4><a href="phongtro/{{ $room->slug }}">{{ $room->title }}</a></h4>
														<div class="room-meta">
															<span><i class="fas fa-user-circle"></i> Người đăng: {{ $room->user->name }}</span>
															<span class="pull-right"><i class="far fa-clock"></i> <?php 
											echo time_elapsed_string($room->created_at);
											?></span>
														</div>
														
														<div class="room-info">
															<span><i class="far fa-stop-circle"></i> Diện tích: <b>{{ $room->area }} m<sup>2</sup></b></span>
															<span class="pull-right"><i class="fas fa-eye"></i> Lượt xem: <b>{{ $room->count_view }}</b></span>
															<div><i class="fas fa-map-marker"></i> Địa chỉ: {{ $room->address }}</div>
															<div style="color: #e74c3c"><i class="far fa-money-bill-alt"></i> Giá thuê: <b>{{ number_format($room->price) }}</b></div>
														</div>
													</div>
												</div>
											</div>
										</div>
										@endforeach
										
									<center>
									@if ($listmotelroom->hasPages())
										<ul class="pagination" role="navigation">
										    {{-- Previous Page Link --}}
										    @if ($listmotelroom->onFirstPage())
										        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
										            <span class="page-link" aria-hidden="true">&lsaquo;</span>
										        </li>
										    @else
										        <li class="page-item">
										            <a class="page-link" href="{{ $listmotelroom->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
										        </li>
										    @endif

										    <?php
										        $start = $listmotelroom->currentPage() - 2; // show 3 pagination links before current
										        $end = $listmotelroom->currentPage() + 2; // show 3 pagination links after current
										        if($start < 1) {
										            $start = 1; // reset start to 1
										            $end += 1;
										        } 
										        if($end >= $listmotelroom->lastPage() ) $end = $listmotelroom->lastPage(); // reset end to last page
										    ?>

										    @if($start > 1)
										        <li class="page-item">
										            <a class="page-link" href="{{ $listmotelroom->url(1) }}">{{1}}</a>
										        </li>
										        @if($listmotelroom->currentPage() != 4)
										            {{-- "Three Dots" Separator --}}
										            <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
										        @endif
										    @endif
										        @for ($i = $start; $i <= $end; $i++)
										            <li class="page-item {{ ($listmotelroom->currentPage() == $i) ? ' active' : '' }}">
										                <a class="page-link" href="{{ $listmotelroom->url($i) }}">{{$i}}</a>
										            </li>
										        @endfor
										    @if($end < $listmotelroom->lastPage())
										        @if($listmotelroom->currentPage() + 3 != $listmotelroom->lastPage())
										            {{-- "Three Dots" Separator --}}
										            <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
										        @endif
										        <li class="page-item">
										            <a class="page-link" href="{{ $listmotelroom->url($listmotelroom->lastPage()) }}">{{$listmotelroom->lastPage()}}</a>
										        </li>
										    @endif

										    {{-- Next Page Link --}}
										    @if ($listmotelroom->hasMorePages())
										        <li class="page-item">
										            <a class="page-link" href="{{ $listmotelroom->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
										        </li>
										    @else
										        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('listmotelroom.next')">
										            <span class="page-link" aria-hidden="true">&rsaquo;</span>
										        </li>
										    @endif
										</ul>
										@endif
									</center>


									</div>
									<div class="col-md-4">
										<img src="images/banner-1.png" width="100%">
									</div>
								</div>
							</div>
							
							<script>
								
								var map;
								function initMap() {
									map = new google.maps.Map(document.getElementById('map'), {
										center: {lat: 21.018088280337526, lng: 105.76606556054688},
										zoom: 15,
										draggable: true
									});
									/* Get latlng list phòng trọ */
									<?php
									$arrmergeLatln = array();
									foreach ($map_motelroom as $room) {
										$arrlatlng = json_decode($room->latlng,true);
										$arrImg = json_decode($room->images,true);
										$arrmergeLatln[] = ["slug"=> $room->slug ,"lat"=> $arrlatlng[0],"lng"=> $arrlatlng[1],"title"=>$room->title,"address"=> $room->address,"image"=>$arrImg[0],"phone"=>$room->phone];
										
									}

									$js_array = json_encode($arrmergeLatln);
									echo "var javascript_array = ". $js_array . ";\n";

									?>
									/* ---------------  */
									console.log(javascript_array);
/*
									var listphongtro = [
									{
										lat: 21.032963,  
										lng: 105.808608,
										title: 'Đào Tấn',
										content: 'bbbb'
									},
									{
										lat: 21.032963, 
										lng: 105.808608,
										title: 'Đào Tấn',
										content: 'bbbb'
									}
									];*/
									console.log(javascript_array);

									for (i in javascript_array){
										var data = javascript_array[i];
										var latlng =  new google.maps.LatLng(data.lat,data.lng);
										var phongtro = new google.maps.Marker({
											position:  latlng,
											map: map,
											title: data.title,
											icon: "images/gps.png",
											content: 'dgfdgfdg'
										});
										var infowindow = new google.maps.InfoWindow();
										(function(phongtro, data){
											var content = '<div id="iw-container">' +
											'<img height="200px" width="300" src="uploads/images/'+data.image+'">'+
											'<a href="phongtro/'+data.slug+'"><div class="iw-title">' + data.title +'</div></a>' +
											'<p><i class="fas fa-map-marker" style="color:#003352"></i> '+ data.address +'<br>'+
											'<br>Phone. ' +data.phone +'</div>';

											google.maps.event.addListener(phongtro, "click", function(e){

												infowindow.setContent(content);
												infowindow.open(map, phongtro);
                  // alert(data.title);
          					    });
										})(phongtro,data);

									}
			// google.maps.event.addListener(map, 'mousemove', function (e) {
			// 	document.getElementById("flat").innerHTML = e.latLng.lat().toFixed(6);
			// 	document.getElementById("lng").innerHTML = e.latLng.lng().toFixed(6);

			// });


		}

	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzlVX517mZWArHv4Dt3_JVG0aPmbSE5mE&callback=initMap"
	async defer></script>
	<script type="text/javascript">
		
	</script>
	@endsection