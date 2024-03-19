<div id="language" >
	 <a href="#" style="display:none;"  class="english">English</a>  <a href="#" style="display:none;" class="arabic">العربية</a>
 </div>
<div id="wrapper">
  <div id="header"> <a href="<?php echo Yii::app()->createUrl();?>/" class="english"><img id="logo" src="<?php echo Yii::app()->theme->baseUrl;?>/images/rsclassifieds-logo.png" alt="rsclassifieds" /></a> <a href="#" class="arabic"><img id="logo" src="<?php echo Yii::app()->theme->baseUrl;?>/images/rsclassifieds-logo.png" alt="rsclassifieds" /></a>
    <div id="tag">
      <p class="english"><?php echo Yii::app()->name;?>  is your <b>free classifieds</b> website to <b>buy</b>, <b>sell</b> and <b>find anything</b> in your local community.</p>
      
      <p class="arabic">الأحمر العنكبوت.. موقع اعلانات مبوبة مجانية للبيع والشراء في دبي</p>
    </div>
  </div>
  <div id="hint">
    <p class="english">Pick a country</p>
    <p class="french">choisissez un pays</p>
    <p class="arabic">اختر بلدا</p>
    <span></span> </div>
  <div id="map"> <img src="<?php echo Yii::app()->theme->baseUrl;?>/images/transparentmap.gif" usemap="#map" class="map" alt="" />
    <map name="map" id="map-areas">
		<?php
		$image ="";
		if($model)
		{
			foreach($model as $k=>$v)
			{
				?>
				<area class="<?php echo $v->image;?>" shape="poly" title ="<?php echo $v->country_name; ;?>" coords="<?php echo $v->cords ;?>" href="" alt="<?php echo $v->country_name;?>" />
				<?
				 $image .= '<img src="'. Yii::app()->theme->baseUrl.'/images/'.$v->image.'.png" class="region '.$v->image.'" alt="" title="'.$v->country_name.'" />';
			}
		}
		?>
			</map>
   <?php  echo   $image;?>
    <img src="<?php echo Yii::app()->theme->baseUrl;?>/images/map.png" class="mapbg" alt="" /> 
      </div>
  <div class="countries english">
  
    <ul class="first-child">
	  <?php
	  function getCountries($country)
	  {
		   $con =  Countries::model()->getCountryByclass($country);
		   if($con)
	       {
		  ?>
		    <li class="<?php echo $con->image;?>"> <span>&nbsp;</span> <strong><a href="<?php echo Yii::app()->createUrl("country/addSession",array("country"=>$con->country_id ,"state"=>0));?>"  ><?php echo $con->country_name;?></a></strong> 
		    <?php
		    if($con->statelist)
		    {
				foreach($con->statelist as $k=>$v)
				{
					echo '<a href="'. Yii::app()->createUrl("country/addSession",array("country"=>$con->country_id ,"state"=>$v->state_id)).'">'.$v->state_name.'</a>';
				}
			}
			 
		   ?> 
		    </li>
		  <?
	  }
	  }
	  ?>
	  <?php 
	   
	   getCountries('algeria');
	   getCountries('bahrain');
	   getCountries('egypt');
	 
	  ?>
    
    </ul>
    <ul>
	  <?php
	   getCountries('jordan');
	   getCountries('kuwait');
	  ?>
    </ul>
    <ul>
	  <?php
	   getCountries('lebanon');
	   getCountries('oman');
	   getCountries('qatar');
	  ?>
    </ul>
    <ul>
		<?php
		getCountries('ksa');
		getCountries('tunisia');
		?>
    </ul>
    <ul>
		<?php 
		getCountries('uae');
		?>
    </ul>
    <span class="guy-sboard">&nbsp;</span><span class="guy-swing">&nbsp;</span><span class="guy-rclimb">&nbsp;</span><span class="guy-mclimb">&nbsp;</span> </div>
  <!-- end english -->
  
  <div class="countries arabic">
    <ul class="first-child">
      <li class="jordan"> <span>&nbsp;</span> <strong><a href="#">الأردن</a></strong> <a href="#">عمّان</a> </li>
      <li class="uae"> <span>&nbsp;</span> <strong><a href="#">الإمارات</a></strong> <a href="#">أبوظبي</a> <a href="#">أم القيوين</a> <a href="#">الشارقة</a> <a href="#">الفجيرة</a> <a href="#">دبي</a> <a href="#">رأس الخيمة</a> <a href="#">عجمان</a> <a href="#">العين</a> </li>
    </ul>
    <ul>
      <li class="bahrain"> <span>&nbsp;</span> <strong><a href="#">البحرين</a></strong> <a href="#">المنامة</a> </li>
      <li class="algeria"> <span>&nbsp;</span> <strong><a href="#">الجزائر</a></strong> <a href="#">الجزائر</a> </li>
      <li class="ksa"> <span>&nbsp;</span> <strong><a href="#">السعودية</a></strong> <a href="#">الدمام والخبر</a> <a href="#">جدة</a> <a href="#">رياض</a> </li>
    </ul>
    <ul>
      <li class="kuwait"> <span>&nbsp;</span> <strong><a href="#">الكويت</a></strong> <a href="#">مدينة الكويت</a> </li>
      <li class="tunisia"> <span>&nbsp;</span> <strong><a href="#">تونس</a></strong> <a href="#">تونس</a> </li>
    </ul>
    <ul>
      <li class="oman"> <span>&nbsp;</span> <strong><a href="#">عمان</a></strong> <a href="#">مسقط</a> </li>
      <li class="qatar"> <span>&nbsp;</span> <strong><a href="#">قطر</a></strong> <a href="#">الدوحة</a> </li>
      <li class="lebanon"> <span>&nbsp;</span> <strong><a href="#">لبنان</a></strong> <a href="#">بيروت</a> </li>
    </ul>
    <ul>
      <li class="egypt"> <span>&nbsp;</span> <strong><a href="#">مصر</a></strong> <a href="#">الإسكندرية</a> <a href="#">القاهرة</a> </li>
    </ul>
    </div>
  <!-- end arabic -->
  
  
  <!-- end french -->
  <div class="clear"></div>
</div>
<!-- end wrapper -->

<div class="modal">
  <div>
    <p>x</p>
    <ul>
      <li></li>
    </ul>
  </div>
</div>
<div id="footer"></div>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery.js"></script> 
<script type="text/javascript">
	//<![CDATA[
	$(document).ready(function() {
		/*
		map_region refers to an <area> on the <map>
		city_list refers to the <li> which holds the list of cities

		each <area> in <map> and <li> in <ul class='countries'> has a class of its country name

		area.algeria will get algeria on the map
		li.algeria will get the list of cities that algeria holds
		*/

		// set default lang
		var current_lang = $('body').attr('class');

		// when user hovers over a coutry in the country list
		$('.countries. li').hover(
		function() {
			var map_region = 'img.' + $(this).attr('class');
			$(map_region).fadeIn('fast');

		}, function() {
			var map_region = 'img.' + $(this).attr('class');
			$(map_region).fadeOut('fast');
		});

		// close button for modal
		function close_modal() {
			$('.modal').fadeOut('fast', function() {
				$('.modal li').removeClass();
				$('#map img.region').removeClass('selected').hide();
				$('.countries li').removeClass('selected');
			});
		}

		$('#language a').click(function() {
			current_lang = $(this).attr('class'); // update language
			$('body').removeClass().addClass(current_lang);
			return false;
		});

		// When user hovers over an area of the map
		$('#map area').mouseover(function() {
			var map_region 	= 'img.' + $(this).attr('class'),
				city_list 	= '.countries li.' + $(this).attr('class');
			$(map_region).fadeIn('fast');
			$(city_list).addClass('hover');


			// user hovers out of the area
		}).mouseout(function() {
			var map_region = 'img.' + $(this).attr('class'),
				city_list = '.countries li.' + $(this).attr('class');

			if (!$(map_region).hasClass('selected')) {
				$(map_region).fadeOut('fast');
			}
			$(city_list).removeClass('hover');
		});

		// when user clicks on an area of the map
		$('#map area').click(function() {
			//alert("QWE")
			var map_region = 'img.' + $(this).attr('class'),
				city_list = '.' + current_lang + '.countries li.' + $(this).attr('class'),
				current_region = $(this).attr('class');

			$(map_region).addClass('selected');
			$('.' + current_lang + '.countries li').removeClass('selected');
			$(city_list).addClass('selected');

			// poulates modal box with list of cities
			var city_list_html = $(city_list).html();
			$('.modal li').html(city_list_html).addClass(current_region);

			var current_region_title = $('.modal li a:first').text();
			$('.modal li span').after('<h2>' + current_region_title + '</h2>');

			var allcities;
			if 		(current_lang === 'english') 	{allcities = 'All cities (';}
			else if (current_lang === 'arabic') 	{allcities = 'كل المدن (';}
			else if (current_lang === 'french') 	{allcities = 'Toutes les villes (';}

			$('.modal li a:first-child').prepend(allcities).append(')');
			$('.modal li a').prepend('&#187; ');
			$('.modal').fadeIn('fast');

			return false;
		});

		// modal close button
		$('.modal p').bind('click', function() {
			close_modal();
		});

		// close modal when pressing 'ESC'
		document.onkeydown = function(e) {
			if (e === null) {keycode = event.keyCode;} // ie
			else {keycode = e.which;} // mozilla

			if (keycode === 27) {close_modal();} // escape, close box, esc
		};

		// disable map hovers for ie6
		if ($.browser.msie && $.browser.version < 7) {
			$('#map img.region').remove();
		}
	});
	//]]>
	 
	</script> 
 
 
 
