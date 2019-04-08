<!DOCTYPE html>
<html>
<head>
	<title>Nhật minh logtics</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/blog2/public/css/stylesheet.css">

  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="/blog2/public/js/jquery.dataTables.min.js" ></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div id="hcontent">
		<div id="header">
		<table width="100%">
			<tr width="50%">
				<td><div id="hlogo">
					<img src="/blog2/public/img/logo.png">

				</div></td>
				<td width="50%">
					<div id="hsearch">
						<form method="get" action="/blog2/pubic/search/0">
							{{csrf_field()}}
							<input type="text" name="" placeholder="Từ khóa..." style="height: 22px">
						
							<button id="btn_search" type="submit">Tìm Kiếm</button>
						</form>
					</div>
					<div style="text-align: right;">
						<form method="post" action="/blog2/public/cart">
					         {{ csrf_field()}}
					        <input type="text" name="listNews" id="listNews" hidden="true">
					        <button type="submit" onclick="getOnclick()"><img src="/blog2/public/img/icon-cart.png" height="30px"></button>
					    </form>
					    @if(Session::has('sessionLoginClient'))
			                 <div>
			                 	<p class="btn btn-warning" style="display: inline-block;">{{Session::get('sessionLoginClient')->user_name}}</p>
			                 	<a href="/blog2/public/client/logout"><button class="btn btn-danger" style="display: inline-block;">Đăng xuất</button></a>
			                 </div>
			            @else
						    <div style="float: right;">
						    	<a href="/blog2/public/client/register"><button class="btn btn-info">Đăng ký</button></a>
						    	<a href="/blog2/public/client/login"><button class="btn btn-primary">Đăng nhập</button></a>
						    </div>
						@endif
					</div>
				</td>
			</tr>
		</table>
		
		<br style="clear: both;">
		<div id="h_menu">
			<a href="/blog2/public/home"><li id="htchome" style="margin: 0">Trang chủ</li></a>
			@foreach($categories as $category)
	            <a href="/blog2/public/news/catid/{{$category->cat_id}}"><li class="hmcell">{{substr( $category->cat_name,  0, 12)  }}</li></a>
	        @endforeach
			<br style="clear: both;">
		</div>
		<div id="hbanner" >
		</div>
		</div>
	</div>
	<div id="bcontent">
	
	<div id="body2">
		<div id="bodyl">
			<div>
				<li class="bmcell_l">Post mới nhất</td></li>
				@foreach($newspost as $post)
		            <li class="bmcell_sub"><a href="/blog2/public/news/newsid/{{$post->news_id}}">{{substr( $post->news_name,  0, 34)}}</a></li>
		        @endforeach
				
			</div>
			<div>
				<li class="bmcell_l">Hỗ trợ trực tuyến</td></li>
				<div id="sup_ol">
					<p class="sup_p">Nhat Minh 01</p>
					<img src="/blog2/public/img/online.png">
					<p class="sup_p">Nhat Minh 02</p>
					<img src="/blog2/public/img/online.png">
					<p class="sup_p">Nhat Minh 03</p>
					<img src="/blog2/public/img/online.png">
				</div>
			</div>
			<div>
				<li class="bmcell_l">Post xem nhiều nhất</td></li>
				@foreach($viewpost as $views)
		            <li class="bmcell_sub"><a href="/blog2/public/news/newsid/{{$views->news_id}}">{{substr( $views->news_name,  0, 30)}}</a>
		            	<span style="color: #000">{{$views->news_seen}}</span>
		            </li>
		        @endforeach
				
			</div>
		</div>
		<div id="bodyr">
			@section('content')
	            
	        @show
			
			
		</div>

	<br style="clear: both;">
	<div id="footer">
		<a href=""><li class ="fcell">Trang chủ</li></a>
		<a href=""><li class="fcell">Giới thiệu</li></a>
		<a href=""><li class="fcell">Dịch vụ</li></a>
		<a href=""><li class="fcell">Thư ngỏ</li></a>
		<a href=""><li class="fcell">Kế hoạch</li></a>
		<a href=""><li class="fcell">Tuyển dụng</li></a>
		<a href=""><li class="fcell">Sitemap</li></a>
		<a href=""><li class="fcell">Liên hệ</li></a>
		<br style="clear: both;">
	</div>
	<div id="contact">
		<div class="float_left"><img src="/blog2/public/img/logo.png"></div>
		<div id="contact_r">
			<p id="contact_tit">Nhat minh logitcs</p>
			<p >Đại chỉ: phòng 109 khách sạn dầu khí 441 đường đà nẵng hải an hải phòng</p>
			<p >Tel: 8431-1231231 Fax:1234-4564564 Email:infor@nhatminh-hgg.com</p>
		</div>
	</div>
	</div>
	</div>
	<button onclick="addCart('a','a','1')"></button>
<script type="text/javascript">
    function addCart(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + "; " + expires+";path=/";
        document.getElementById("add"+cname).style.display = "none";
    }
    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length,c.length);
            }
        }
        return "";
    }
    function delCart(cname) {
        var d = new Date();
        d.setTime(d.getTime() );
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + "" + "; " + expires+";path=/";
        document.getElementById(cname).style.display = "none";
    }
    function getOnclick(){
        var listNews ='';
        var ca = document.cookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') {
                c = c.substring(1);
            }
            if (c.indexOf('news') == 0) {
                var name = c.split('=')[0];
                var value = c.substring(name.length+1,c.length);
                listNews += ' '+value;
            }

        }
        var element = document.getElementById('listNews').value = listNews;
        //getCookie('name_cookie');

    }
    function onclickRate(ele){
    	var rate= ele.getAttribute('value');
    	document.getElementById("rateStar").value =rate;
    	document.getElementById("danhgia").innerHTML ='Đánh giá '+rate+'/5';
    }
</script>
</body>
</html>