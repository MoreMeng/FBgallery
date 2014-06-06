<!DOCTYPE html>
<html lang="th">
	<head>
		<title>MoreMeng - Make my own gallery from facebook album with PHP</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<style type="text/css">
			.grid li {height: 240px;}
		</style>
	</head>
	<body>
		<h1 class="text-center">Facebook Gallery 1.x</h1>

		<div id="activities" class="container">
		<ul class="container-fluid grid cs-style-5">
		<?php
		/**
		 * [$url เปลี่ยนเฉพาะตัวเลข เป็นเลข id บน facebook ของ user หรือ page ที่ต้องการนำอัลบั้มมาแสดงผล]
		 * [$obj ดังข้อมูลมาจาก graphAPI ของ facebook รูปแบบข้อมูลจะเป็น JSON]
		 * [$ng ตัวแปรนับจำนวนอัลบั้ม เริ่มต้นจาก 0]
		 * [$limit กำหนดให้แสดงกี่อัลบั้ม]
		 */
			$url = "http://graph.facebook.com/208646139152581/albums";
			$obj = json_decode(file_get_contents($url));
			$ng = 0;
			$limit = 12;

			foreach($obj->data as $item) {

				if ($item->type == 'normal' && $item->name != 'Cover Photos' && $ng <= $limit)
					echo '
					<li class="col-xs-6 col-sm-4">
						<figure>
							<div><img src="http://graph.facebook.com/'.$item->cover_photo.'/picture"></div>
							<figcaption>
								<h5>'.$item->name.'</h5>
								<a href="'.fix_album_link($item->link).'" rel="external">ดูอัลบั้มเต็ม</a>
							</figcaption>
						</figure>
					</li>';
				$ng++;
			}
		/**
		 * [fix_album_link เพิ่มเข้ามาเพื่อแก้ link ของ อัลบั้มบน facebook ที่มันแก้ไขใหม่ ซึ่งไม่ตรงกับ graphc API ที่มันให้บริการอยู่ อนาคตอาจมีการเปลี่ยนแปลงอีก]
		 * @param  [type] $link [ url ของอัลบั้มจาก graphAPI]
		 * @return [type]       [url ที่แก้ link แล้ว]
		 */
			function fix_album_link($link) {
				$url_parsed = parse_url($link);
				parse_str($url_parsed['query'], $fix);
				return '//www.facebook.com/media/set/?set=a.'.$fix['fbid'].'.'.$fix['aid'].'.'.$fix['id'].'&type=3';;
			}
		?>
		</ul>
		</div>
		</div>
		<hr>
		<div class="container">
			<p class="muted small">Code by <a href="http://moremeng.in.th" target="_blank"><strong>MoreMeng</strong></a> | <a href="https://plus.google.com/+ThanikulSriuthis" target="_blank">Google+</a> | Thank <a href="http://tympanus.net/codrops/2013/06/18/caption-hover-effects/" target="_blank">Codrops</a> for CAPTION HOVER EFFECTS</p>
		</div>
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
		<script src="js/modernizr.custom.js"></script>
		<script src="js/toucheffects.js"></script>
	</body>
	</body>
</html>