<?php
$sectors = Dynamiclinks::model()->getlistParentBySection(1);
 
?>
<div class="nmc-footer-6 active fo-sale-inc">
<div>
<div>
<div class="nmc-footer-19 _6c5bbfd9 nmc-footer-8 lesconter">
<div>
<div class="nmc-footer-9">
<div class="nmc-footer-10"> </div>

<div class="nmc-footer-11">
<?php
 $more = $this->tag->getTag('more','More'); $less = $this->tag->getTag('less','Less');
$itnCount =0;$fullrow=17;
foreach($sectors as $main){
$itnCount++;

 $fullwidthrow =false; 
    if($itnCount==$fullrow){
        $fullwidthrow=true; 
    }
    
?>
<div class="nmc-footer-12 _9b01d0a7">
<div class="nmc-footer-13"><a class="_78d325fa " href="<?php echo $main['url'];?>"><?php echo  $main['name'];?></a></div>
<?php
if(!empty($main['sub'])){


?>
<ul class="_22762832">
    <?php 
  
    $count = 1;$opnd =false; $counti = 1;
    foreach($main['sub'] as $subitem){
         
    $ntcls = ($count>=6) ?'d-none hideles' : ''; 
    if(!empty($fullwidthrow) and empty($opnd)){
        echo '<ul class="col-sm-4 padding-left-0">';$opnd = true;
    }
     ?>
	<li class="nmc-footer-15 af2d23c9 <?php echo empty($fullwidthrow) ? $ntcls : 'full-widthlist';?>"><a class="_78d325fa " href="<?php echo  $subitem['url'];?>"><?php echo $subitem['name']; ?></a></li> 
	<?php
	$count++;
	
	if($counti%3=='0' and $counti!=1 and !empty($fullwidthrow)){
	    $opnd =false;
	    echo '</ul>';
	}
	$counti++;
	
	}
	if($opnd and !empty($fullwidthrow)){
	      echo '</ul>';
	}
	if($count>=6 and empty($fullwidthrow)){
	          echo '<a href="javascript:void(0)" id="v_moer" class=" btn-more-view" onclick="showAlllist(this)" >'.$more.'</a>';
        echo '<a href="javascript:void(0)" class="d-none btn-more-view" id="v_less" onclick="hideAlllist(this)" >'.$less.'</a>';
  
	}
	
	?>
 </ul>
 <?php } ?>
</div>
<?php } ?> 
 
</div>
</div>
</div>
</div>

 </div>

<div>
 </div>
</div>


</div>