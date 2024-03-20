<?php
$fotter_links = FooterLinks::model()->generateFooterLinksView();
if(!empty($fotter_links)){
	?>
	<div class="container home_container">
		<div class="col-md-12"><h3 class="headline  margin-bottom-15  col-md-12 no-margin-left  ">Popular Searches in Pakistan  </h3>  </div>
				
    <div class="_035521cc d09dd5dc">
	<?
	foreach($fotter_links as $k=>$v){
				?>
				<div class="d4bfbcac _056fe257">
				<div class="aff8f8ff" onclick="$(this).closest('.d4bfbcac').toggleClass('mbopen')"><?php echo $k;?></div>
									<div class="_617311a2">
										<?php foreach($v as $k2=>$v2){ ?> 
												<div class="<?php echo sizeOf($v)<=2 ? 'e934bb07 _3699df03' : '';?>  _9b01d0a7 abc-<?php echo $k2;?>">
												<div class="_1fc27392 d5f01f25"><?php echo $v2['title'];?></div>
												<?php
												 if(!empty($v2['links'])){
												 echo '<ul class="_22762832 _6a0b9f31">'; 
													  foreach($v2['links'] as $url){
														  echo ' <li class="_76ddbf32 _6d0ca3cd"><a href="'.$url['url'].'" title="'.$url['title'].'">'.$url['title'].'</a></li>';
													   }
													 
												 echo '</ul>'; 
												 }  
												 echo '</div>'; 
										}  
									echo '</div>';
						  
				echo '</div>'; 
	}
	 
		echo '</div>'; 
		echo '</div>'; 
}
?>



      
     
   

