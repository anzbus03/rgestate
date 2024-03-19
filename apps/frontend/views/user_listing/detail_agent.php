<div class="profile_detail_sec">
  <div class="container">
  <?php
	   $referer = $this->app->request->urlReferrer ;
	   
	   if( strpos( $referer, 'real-estate-agents' ) !== false ) {
			$return_title = 'Back to Agents';
			$return_url = $referer; 
		} 
		else{
			 $return_title = 'Back To Find Agents';
	          $return_url = Yii::app()->createUrl('user_listing/find');
		}
	  ?>
	    
    <div class="row ad-bg" style="padding-top: 10px; padding-left: 10px; padding-bottom: 10px;"><span><a href="<?php echo $return_url;?>"> &lt; <?php echo $return_title;?></a></span></div>
   
    <div class="row ad-bg margin-bottom-15">
      <div class="col-md-6 col-sm-6 margin-bottom-10">
        <div>
		<?php 
		$image = $this->app->apps->getBaseUrl('uploads/images/'.$model->image);
		?>
          <img src="<?php echo $this->app->apps->getBaseUrl('timthumb.php');?>?src=<?php   echo  $image   ;?>&h=555&w=555&zc=1" alt="agent-image" width="100%" height="100%">
        </div>
      </div>
      <div class="col-md-6 col-sm-6 margin-bottom-15 font-fam">
        <span class="ad-text"><?php echo strtoupper($this->options->get('system.common.site_name','Askaan'));?> LISTING AGENT</span>
        <h1 style="margin-left: 15px;"><?php echo $model->fullName;?><br /><small style="font-weight:normall"><?php echo $model->country_name;?></small></h1>
		<?php /* 
        <p class=" margin-left-15 ">4.8
          <i class="fas fa-star star-clr"></i>
          <i class="fas fa-star star-clr"></i> 
          <i class="fas fa-star star-clr"></i>
          <i class="fas fa-star star-clr"></i>
          <i class="fas fa-star-half star-clr"></i>
          <span style="color: #1a777c">101 Reviews</span> 
        </p>
        * */
        ?>
        <span class=" margin-left-15">With <?php echo $this->options->get('system.common.site_name','Askaan');?> since <?php echo date('Y',strtotime($model->date_added));?></span>
        <hr class=" margin-left-15 margin-right-15" width="100%">
        <span class=" margin-left-15">
        <div class="col-sm-6 col-md-6 "><span class=""><b>For Sale  :</b> <?php echo $model->sale_total;?></span><br /><b>Agent License #:</b> <?php echo $model->licence_no;?></span></div>
        <div class="col-sm-6 col-md-6"><span class=""><b>For Rent  :</b> <?php echo $model->rent_total;?></span><br /></div>
        <div class="clearfix"></div>
        
        <div class="col-sm-12 col-md-12"><span><b>Languages  Known:</b><?php echo $model->Userall_languages;?></span></div> 
        
        <p class=" margin-left-15 hidden  "><span><b>Service Areas:</b></span> Will Update</p>
        <div class="row btn-rspo margin-top-15">
        
          <div class="margin-left-15 col-sm-12">
            <h3><img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjMycHgiIGhlaWdodD0iMzJweCIgdmlld0JveD0iMCAwIDMyLjY2NiAzMi42NjYiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDMyLjY2NiAzMi42NjY7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPGc+Cgk8cGF0aCBkPSJNMjguMTg5LDE2LjUwNGgtMS42NjZjMC01LjQzNy00LjQyMi05Ljg1OC05Ljg1Ni05Ljg1OGwtMC4wMDEtMS42NjRDMjMuMDIxLDQuOTc5LDI4LjE4OSwxMC4xNDksMjguMTg5LDE2LjUwNHogICAgTTE2LjY2Niw3Ljg1NkwxNi42NjUsOS41MmMzLjg1MywwLDYuOTgzLDMuMTMzLDYuOTgxLDYuOTgzbDEuNjY2LTAuMDAxQzI1LjMxMiwxMS43MzUsMjEuNDM2LDcuODU2LDE2LjY2Niw3Ljg1NnogTTE2LjMzMywwICAgQzcuMzI2LDAsMCw3LjMyNiwwLDE2LjMzNGMwLDkuMDA2LDcuMzI2LDE2LjMzMiwxNi4zMzMsMTYuMzMyYzAuNTU3LDAsMS4wMDctMC40NSwxLjAwNy0xLjAwNmMwLTAuNTU5LTAuNDUtMS4wMS0xLjAwNy0xLjAxICAgYy03Ljg5NiwwLTE0LjMxOC02LjQyNC0xNC4zMTgtMTQuMzE2YzAtNy44OTYsNi40MjItMTQuMzE5LDE0LjMxOC0xNC4zMTljNy44OTYsMCwxNC4zMTcsNi40MjQsMTQuMzE3LDE0LjMxOSAgIGMwLDMuMjk5LTEuNzU2LDYuNTY4LTQuMjY5LDcuOTU0Yy0wLjkxMywwLjUwMi0xLjkwMywwLjc1MS0yLjk1OSwwLjc2MWMwLjYzNC0wLjM3NywxLjE4My0wLjg4NywxLjU5MS0xLjUyOSAgIGMwLjA4LTAuMTIxLDAuMTg2LTAuMjI4LDAuMjM4LTAuMzU5YzAuMzI4LTAuNzg5LDAuMzU3LTEuNjg0LDAuNTU1LTIuNTE4YzAuMjQzLTEuMDY0LTQuNjU4LTMuMTQzLTUuMDg0LTEuODE0ICAgYy0wLjE1NCwwLjQ5Mi0wLjM5LDIuMDQ4LTAuNjk5LDIuNDU4Yy0wLjI3NSwwLjM2Ni0wLjk1MywwLjE5Mi0xLjM3Ny0wLjE2OGMtMS4xMTctMC45NTItMi4zNjQtMi4zNTEtMy40NTgtMy40NTdsMC4wMDItMC4wMDEgICBjLTAuMDI4LTAuMDI5LTAuMDYyLTAuMDYxLTAuMDkyLTAuMDkyYy0wLjAzMS0wLjAyOS0wLjA2Mi0wLjA2Mi0wLjA5My0wLjA5MnYwLjAwMmMtMS4xMDYtMS4wOTYtMi41MDYtMi4zNC0zLjQ1Ny0zLjQ1OSAgIGMtMC4zNi0wLjQyNC0wLjUzNC0xLjEwMi0wLjE2OC0xLjM3N2MwLjQxLTAuMzExLDEuOTY2LTAuNTQzLDIuNDU4LTAuNjk5YzEuMzI2LTAuNDI0LTAuNzUtNS4zMjgtMS44MTYtNS4wODQgICBjLTAuODMyLDAuMTk1LTEuNzI3LDAuMjI3LTIuNTE2LDAuNTUzYy0wLjEzNCwwLjA1Ny0wLjIzOCwwLjE2LTAuMzU5LDAuMjRjLTIuNzk5LDEuNzc0LTMuMTYsNi4wODItMC40MjgsOS4yOTIgICBjMS4wNDEsMS4yMjgsMi4xMjcsMi40MTYsMy4yNDUsMy41NzZsLTAuMDA2LDAuMDA0YzAuMDMxLDAuMDMxLDAuMDYzLDAuMDYsMC4wOTUsMC4wOWMwLjAzLDAuMDMxLDAuMDU5LDAuMDYyLDAuMDg4LDAuMDk1ICAgbDAuMDA2LTAuMDA2YzEuMTYsMS4xMTgsMi41MzUsMi43NjUsNC43NjksNC4yNTVjNC43MDMsMy4xNDEsOC4zMTIsMi4yNjQsMTAuNDM4LDEuMDk4YzMuNjctMi4wMjEsNS4zMTItNi4zMzgsNS4zMTItOS43MTkgICBDMzIuNjY2LDcuMzI2LDI1LjMzOSwwLDE2LjMzMywweiIgZmlsbD0iI0Q4MDAyNyIvPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" /> 
<?php echo $model->phone;?></h3>
            <i class="fa fa-check hidden" style="color: green;"></i> <span class="margin-left-10 hidden">available for calls</span> 
          </div>
            <div class="col-sm-6 col-md-12 ask_btn" >
            <a  class="btn btn-danger btn-lg " href="#agent_details"> <i class="far fa-question-circle"></i> Ask A Question</a><br>
            <span class=" margin-left-15 hidden">replies within hour</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<style>.nav-tabs > li > a { background: #FF3855 !important; color: #FFF !important; }.nav-tabs > li.active > a { background: #FFF !important; color: #888 !important; }</style>

<div class="container">
	<form id="myForm_agents">
	<input type="hidden" name="user_id" value="<?php echo $model->user_id;?>" />
	<input type="hidden" name="_sec_id" id="sec_id" value="<?php echo PlaceAnAd::SALE_ID;?>" />
	</form>
	 <div id="agent_details"></div>
<div class="row" id="">
  <div class="col-sm-12">
    <h1>  A little  bit About  <?php echo $model->fullName;?></h1>
  </div>

  <div class="col-md-3 col-sm-3 about_profile_img" style="padding-left: 70px;">
    <img src="<?php echo $this->app->apps->getBaseUrl('timthumb.php');?>?src=<?php   echo  $image   ;?>&h=150&w=150&zc=1" class="img-responsive img-circle" width="150" height="150">
  </div>
  <div class="col-md-9 col-sm-9">
    <p><?php echo nl2br($model->description);?></p>
  </div>
</div>
<div class="row" style="text-align: center;">
</div>
  <div class="row padding-bottom-10" style="margin-top:50px">
    <ul class="nav nav-tabs" id="user_tab_filter">
      <li class="active tabs-des user_secC"><a data-toggle="tab" href="javascript:void(0)"  onclick="setChangeSession(this)" data-id="<?php echo PlaceAnAd::SALE_ID;?>" >For Sale</a></li>
      <li><a class="user_secC" data-toggle="tab" href="javascript:void(0)" onclick="setChangeSession(this)" data-id="<?php echo PlaceAnAd::RENT_ID;?>" >For Rent  </a></li>
    </ul>

  <!-- <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3>HOME</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3>About Agent </h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Buy Properties</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Recent Properties</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div>
  </div> -->
</div>  
<div class="row">
  <div class=""> 
	
	<div id="slideSheet"  >
	<ul class="list-group  no-margin no-padding" id="suggestionList">
	<li id="suggest_friends_last_id" style="display:none;"></li>
	</ul>

	<div style="clear:both"></div>
	<div class="bar-results bottom">
	<div class="paging-holder">
	<div class="paging"><div class="text-center loadingDiv marTop15 no-margin"> </div> </div>
	</div>
	</div>
	<div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>
 <?php $limit =  '4' ; ?> 
<style>.ak_lisitng_agents .item_ko .listing-item-content .ak_agent_content p{ text-overflow:ellipsis;overflow: hidden; }.chosen-container .chosen-results li.highlighted {color:#8898 !important; } </style>
<script type="text/javascript">
	var loadingHtml    	= '<a href="javascript:void(0)" class="btn  btn-primary   btn-more btn-lg btn-shadow btn-rounded btn-icon-right disabled"><i class="fa fa-spinner fa-pulse margin-right-10"></i></a>';
	var	loadMoreHtml 	= '<a href="javascript:void(0)" class="btn   btn-primary  btn-shadow btn-rounded btn-icon-right"   id="refresh_list" >Load More</a>';  
	var afterFinishHtml = '';   
	 var emptyResult = '<div class="txtC ajaxLoaded" style="padding: 20px 0px;"><div class="text-center"><div class="h1">No Result Found</div><img alt="No homes found" src="//static.trulia-cdn.com/images/search-web/no_results.svg" style="width: 100%; max-width: 300px; min-width: 240px;"> </div></div>';

	var elementId='slideSheet';
	var appendId='suggest_friends_last_id';
	var scroll=true;
	var limit='<?php echo $limit;?>';
	var offest='0';
	var formID  = 'myForm_agents';
	var checkFuture = true ;
	var scroll_Pagination5    ;
	var slug ='<?php echo Yii::app()->createUrl('listing/Fetch_work',array('count_future'=>1,'is_form'=>'1','hide_featured'=>'1'));?>';
	//scrollPaginationMain(limit='3',offest='0',elementId='slideSheet',appendId='suggest_friends_last_id',slug='<?php echo Yii::app()->createUrl('list/fetch_work');?>',scroll=false,loadingHtml,loadMoreHtml,afterFinishHtml);
	$(document).ready(function () {
		scrollPagination2(); 
	});
 
</script> 

  </div>
</div>
<div class="clearfix"></div>
  <div class="col-sm-12 tex-center">
    <h1>  Ask a Question <?php echo $model->fullName;?></h1>
  </div>
<div class="row margin-top-30">
  <div class="col-sm-6 col-xs-12 col-md-6 col-sm-offset-3">
	<?php
	$contact = new ContactAgent();
	$contact->user_id = $model->user_id ;
	$form = $this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl('user_listing/validateEnquiry'),
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
	'validateOnSubmit'=>true,
	'afterValidate' => 'js:function(form, data, hasError) { 
	if(hasError) {
	return false;
	}
	else
	{
 	ajaxSubmitHappen(form, data, hasError,"'.Yii::app()->createUrl('user_listing/SendEnquiry').'"); 
	}
	}',
	),
	'htmlOptions'=>array('class'=>'form leadContact right_leadContact phs','style'=>'margin-top: 5px;' ),
	));
	?>
	
	<div class="clear-fix"></div>
      <div class="form-row">
        <div class="form-group col-md-12">
			<?php echo $form->labelEx($contact, 'name'); ?>
			<?php echo $form->textField($contact, 'name',$contact->getHtmlOptions('name',array('class'=>'form-control'))); ?>
			<?php echo $form->error($contact, 'name');?>					
			<?php echo $form->hiddenField($contact, 'user_id',$contact->getHtmlOptions('user_id',array('class'=>'form-control'))); ?>
			<?php echo $form->error($contact, 'user_id');?>					
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
         	<?php echo $form->labelEx($contact, 'email'); ?>
			<?php echo $form->textField($contact, 'email',$contact->getHtmlOptions('email',array('class'=>'form-control'))); ?>
			<?php echo $form->error($contact, 'email');?>
        </div>
        <div class="form-group col-md-6">
			<?php echo $form->labelEx($contact, 'phone'); ?>
			<?php echo $form->textField($contact, 'phone',$contact->getHtmlOptions('phone',array('class'=>'form-control'))); ?>
			<?php echo $form->error($contact, 'phone');?>
        </div>
      </div>

      <div class="form-group">
        <div class="form-check col-sm-12">
          <label class="form-check-label" for="gridCheck">
            I am considering &nbsp;&nbsp;
          </label>
          <?php echo $form->radioButton($contact, 'considering',$contact->getHtmlOptions('phone',array('class'=>'form-check-input','value'=>'S','checked'=>true))); ?>
			&nbsp;Sale&nbsp;&nbsp; 
           <?php echo $form->radioButton($contact, 'considering',$contact->getHtmlOptions('phone',array('class'=>'form-check-inputl','value'=>'B'))); ?>
           &nbsp;Buy&nbsp;&nbsp; 
           <?php echo $form->error($contact, 'considering');?>
			<?php echo $form->textarea($contact, 'meassage',$contact->getHtmlOptions('meassage',array('class'=>'form-control'))); ?>
			<?php echo $form->error($contact, 'meassage');?>

          <button type="submit" class=" xlg-btn btn btn-danger btn-lg" style="width: 100%;
          margin-top: 7px;">Contact <?php echo $model->first_name;?></button>
          <div id="msg_alert"></div>
          <p> You are  agree to our <a href="#"> terms of services</a> and <a href="#"> Privacy Policy</a></p>
        </div>
      </div>
 <?php $this->endWidget();?>
  </div>
</div>
</div>
