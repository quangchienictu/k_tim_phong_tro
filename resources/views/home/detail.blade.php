@extends('layouts.master')
@section('content')
<?php 
function limit_description($string){
	$string = strip_tags($string);
	if (strlen($string) > 150) {

	    // truncate string
		$stringCut = substr($string, 0, 150);
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
<div class="gap"></div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="#">Trang Chủ</a></li>
				<li><a href="#">{{ $motelroom->category->name }}</a></li>
				<li class="active">{{ $motelroom->title }}</li>
			</ul>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h1 class="entry-title entry-prop">{{ $motelroom->title }}</h1>

			<hr>
			<div class="row">
				<div class="col-md-6">
					<span class="price_area">{{ number_format($motelroom->price) }} <span class="price_label">VND</span></span>
				</div>
				<div class="col-md-6">
					<span class="pull-right">Lượt xem: {{ $motelroom->count_view }} - <span>Ngày đăng: </span> <span style="color: red; font-weight: bold;">
						<?php echo time_elapsed_string($motelroom->created_at); ?>
					</span></span>
				</div>
			</div>
			<div id="map-detail"></div>
			
			<hr>
			<div class="detail">
				<p><strong>Địa chỉ: {{ $motelroom->address }}</strong><br></p>
				<p>
					<strong>Giá phòng: </strong><span class="price_area"><?php echo number_format($motelroom->price); ?>  <span class="price_label">VND</span></span>
					<strong><i class="fas fa-street-view"></i> Diện tích: </strong><span> {{$motelroom->area}} m <sup>2</sup> </span>
				</p>
				<!-- Tiện ích -->
				<?php $arrtienich = json_decode($motelroom->utilities,true); ?>
				<div id="km-detail">
					<div class="fs-dtslt">Tiện ích Phòng Trọ</div>
					<div style="padding: 5px;">
						@foreach($arrtienich as $tienich)
						<span><i class="fas fa-check"></i> {{ $tienich }}</span> 
						@endforeach
					</div>
				</div>
				<h4>Mô tả:</h4>
				<pre>
					<p class="pre">{{ $motelroom->description }}</p>
				</pre>
			</div>
			
			<?php 
			$arrimg =  json_decode($motelroom->images,true);
			?>
			<center>
			<!-- Slider Hình Ảnh -->
			@foreach($arrimg as $img)
				<img src="uploads/images/<?php echo $img; ?>" width="50%">
			@endforeach
			
			</center>
			<div style="clear: both;margin-top: 100px;" class="mt-5"></div>
			<div>
							<h5 class="mb-3">Đánh giá về phòng </h5>
							@if (count($rating)<1)
							<p>*** Chưa có đánh giá nào ***</p>
							@else
							@foreach ($rating as $element)
							<div class="comment mt-5" style="margin-top: 20px;">
								<div class="row">
									<div class="col-md-2">
										<div class="img">
											<img src="uploads/avatars/{{$element->user->avatar}}">
										</div>
									</div>
									<div class="col-md-10 chitiet">
										<div class="row">
											<div class="col-md-6">
												<h5>{{$element->user->name}}</h5>
												<p class="time">{{$element->created_at}}</p>
											</div>
											<div class="col-md-6 text-right">
												@php
												for($i=0;$i<$element->rate;$i++){
													echo '<i class="fas fa-star"></i>';
												}
												@endphp
												
												
											</div>
										</div>
										
										<div class="row">
											<div class="col-md-12 content">	
												<p class="">{{$element->comment}} </p>

											</div>
										</div>
									</div>
								</div>
							</div>

							@endforeach
							@endif
						
							
							
							
						</div>

			@if (Auth::check())

			<div style="clear: both;margin-top: 100px;" class="mt-5"></div>
			<div class="form-group mt-5">
								<label for="comment" style="display: inline;" class="label_danhgia">Đánh giá của bạn :</label>
								<div class="stars" style="display: inline;float: right;">
										<form action="">
											<input value="5" class="star star-5" id="star-5" type="radio" name="star"/>
											<label class="star star-5" for="star-5"></label>
											<input value="4" class="star star-4" id="star-4" type="radio" name="star"/>
											<label class="star star-4" for="star-4"></label>
											<input value="3" class="star star-3" id="star-3" type="radio" name="star"/>
											<label class="star star-3" for="star-3"></label>
											<input value="2" class="star star-2" id="star-2" type="radio" name="star"/>
											<label class="star star-2" for="star-2"></label>
											<input  value="1" class="star star-1" id="star-1" type="radio" name="star"/>
											<label class="star star-1" for="star-1"></label>
										</form>
							</div>
								<textarea class="form-control" rows="5" id="comment"></textarea>
								<div class=" mt-2" id="alert-comment">
									
								</div>
								<button id="btn_comment" class="btn btn-success mt-2" style="margin-top: 20px;">Gửi đánh giá</button>

							</div>
			<!-- END Slider Hình Ảnh -->		
			<div class="gap"></div>
			
			@endif
		</div>
		<div class="col-md-4">
			<div class="contactpanel">
				<div class="row">
					<div class="col-md-4 text-center">
						@if($motelroom->user->avatar == 'no-avatar.jpg')
							<img src="images/no-avatar.jpg" class="img-circle" alt="Cinque Terre" width="100" height="100"> 
						@else
							<img src="uploads/avatars/<?php echo $motelroom->user->avatar; ?>" class="img-circle" alt="Cinque Terre" width="100" height="100"> 
						@endif
					</div>
					<div class="col-md-8">
						<h4>Thông tin người đăng</h4>
						<strong>{{ $motelroom->user->name }}</strong><br>
						<i class="far fa-clock"></i> Ngày tham gia: 17-05-2020	

					</div>
				</div>
			</div>
			<div class="phone_btn">
				<a id="show_phone_bnt" href="callto:{{ $motelroom->phone }}" class="btn btn-primary btn-block" style="font-weight: bold !important;
				font-size: 14px;">
				<i class="fas fa-phone-square" style="font-size: 20px"></i>
				<span>SĐT: {{ $motelroom->phone }}</span></a>
			</div>
			
			<div class="gap"></div>
			
			
			@if(session('thongbao'))
			<div class="alert bg-success">
				<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
				<span class="text-semibold">Well done!</span>  {{session('thongbao')}}
			</div>
			@else	
			<div class="report">
				<h4>BÁO CÁO</h4>
				<form action="{{ route('user.report',['id'=> $motelroom->id]) }}" >
					
					<label class="radio"> Sai thông tin
						<input type="radio" name="baocao" value="2">
						<span class="checkround"></span>
					</label>
					
				</form>
				<button class="btn btn-danger">Gửi báo cáo</button>
			</div>
			@endif
			<img src="images/banner-1.png" width="100%" style="margin-top: 20px">
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		var slider = $('.pgwSlider').pgwSlider();
		slider.previousSlide();
	});
</script>


<script>

	var map;
	function initMap() {
		map = new google.maps.Map(document.getElementById('map-detail'), {
			center: {lat: 21.072821,  lng: 105.774122},
			zoom: 15,
			draggable: true
		});
		/* Get latlng vị trí phòng trọ */
		<?php
		$arrmergeLatln = array();

		$arrlatlng = json_decode($motelroom->latlng,true);

		$arrmergeLatln[] = ["lat"=> $arrlatlng[0],"lng"=> $arrlatlng[1],"title"=>$motelroom->title,"address"=> $motelroom->address,"phone"=> $motelroom->phone,"slug"=>$motelroom->slug];
		$js_array = json_encode($arrmergeLatln);
		echo "var javascript_array = ". $js_array . ";\n";

		?>
		/* ---------------  */
		
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
				'<a href="phongtro/'+data.slug+'"><div class="iw-title">' + data.title +'</div></a>' +
				'<p><i class="fas fa-map-marker" style="color:#003352"></i> '+ data.address +'<br>'+
				'<br>Phone. ' +data.phone +'</div>';
				infowindow.setContent(content);
				infowindow.open(map, phongtro);
				google.maps.event.addListener(phongtro, "click", function(e){

					infowindow.setContent(content);
					infowindow.open(map, phongtro);
                  // alert(data.title);
              });
			})(phongtro,data);

		}
		google.maps.event.addListener(map, 'mousemove', function (e) {
			document.getElementById("flat").innerHTML = e.latLng.lat().toFixed(6);
			document.getElementById("lng").innerHTML = e.latLng.lng().toFixed(6);

		});


	}

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzlVX517mZWArHv4Dt3_JVG0aPmbSE5mE&callback=initMap"
async defer></script>


@if (Auth::check())
<script type="text/javascript">
	
$(document).ready(function(){
	$('#btn_comment').on('click',function(){
		var data = $("#comment").val();
		var user = {{Auth::user()->id}};
		var id_post ={{$motelroom->id}};
		if(data ==""){
			$("#alert-comment").html('<p class="text-danger">Không để trống phần nhận xét </p>');
		}else{
			var value = $("input[name='star']:checked"). val();
		if (typeof value == 'undefined'){
			value = 0;
		}
		$.ajax({
			url : "user/comment",
			method:"post",
			 headers: {
   				 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 			 },
			data :{value:value,data:data,user:user,id_post:id_post}
		}).done(function(data){
			$("#comment").val('');
			$("#alert-comment").html('<p class="text-success">Nhận xét đang chờ duyệt </p>');
		});
		}
	})

});
@endif

</script>
@endsection