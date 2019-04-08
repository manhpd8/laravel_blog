<html>
<head>
	<title>Nhật minh logtics</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>
<body>
	<div id="hcontent">
		<div id="header">
		<table width="100%">
			<tr width="50%">
				<td><div id="hlogo">
			<img src="img/logo.png">

		</div></td>
				<td width="50%">
					<div id="hsearch">
						<input type="text" name="" placeholder="Từ khóa..." style="height: 22px">
						
						<button id="btn_search">Tìm Kiếm</button>
					</div>
				</td>
			</tr>
		</table>
		
		<br style="clear: both;">
		<div id="h_menu">
			<a href=""><li id="htchome" style="margin: 0">Trang chủ</li></a>
			@foreach($categories as $category)
	            <a href="./news/catid/{{$category->cat_id}}"><li class="hmcell">{{ $category->cat_name }}</li></a>
	        @endforeach
			<br style="clear: both;">
		</div>
		<div id="hbanner" >
		</div>
		</div>
	</div>
</body>
