<style> .video-container3{position:relative;padding-bottom:56.25%;margin-top:15px;padding-top:30px;height:0;overflow:hidden}.video-container3 embed,.video-container3 iframe,.video-container3 object{position:absolute;top:0;left:0;width:100%;height:100%} </style>
<?php
preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $model->video, $match);
$youtube_id = @$match[1];
echo '<div class="clearfix"></div> ';
echo '<div class="video-container3"><iframe width="853" height="480"   src="https://www.youtube.com/embed/'.@$youtube_id.'" frameborder="0" allowfullscreen></iframe></div>';
echo '<div class="clearfix"></div> ';
						   
