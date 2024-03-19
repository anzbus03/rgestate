<?php defined('MW_PATH') || exit('No direct script access allowed');  ?>
<style>
.no-margin-left { margin-left:0px !important; }
.mysearches-p a { color:#333;}
 
.pagingarea {
  clear: both;
  margin: 0 auto 20px;
  padding-top: 5px;
  padding-bottom: 5px;
  text-align: center;
}

.pagingarea .actions { text-align: center; }

.pagingarea .actions .paging_back a,
.pagingarea .actions .paging_forward a,
.pagingarea .actions .paging_back .paging_back_inactive,
.pagingarea .actions .paging_forward .paging_forward_inactive,
.pagingarea .actions .pages .page-links {
  border-width: 1px 1px 1px;
  border-style: solid;
  border-radius: .166666667em; // 2px/12px (inherited font size)
  font-weight: 300;
  padding: .833333333em 1.166666667em; // 10px 14px/12px (inherited font size)
  text-align: center;
  text-decoration: none;
  display: inline-block;
}

.pagingarea .actions .paging_back a,
.pagingarea .actions .paging_forward a,
.pagingarea .actions .pages .page-links {
  background-color: #fff;
  /*border-color: #d8d9da;*/
  
  color: #3b4245;
}

.pagingarea .actions .paging_back .paging_back_inactive,
.pagingarea .actions .paging_forward .paging_forward_inactive,
.pagingarea .actions .paging_back .paging_back_inactive:hover,
.pagingarea .actions .paging_forward .paging_forward_inactive:hover {
  background-color: #eeeeee;
  border-color: #d8d9da;
  color: #989898;
}

.pagingarea .actions .paging_back a:hover,
.pagingarea .actions .paging_forward a:hover,
.pagingarea .actions .pages .page-links:hover {
  background-color: #fdfbf8;
}

.pagingarea .actions .paging_back a:active,
.pagingarea .actions .paging_forward a:active,
.pagingarea .actions .pages .page-links:active {
  background-color: #005f96;
  border-color: #005f96;
  color: #fff;
}

.pagingarea .actions .pages #current {
  background-color: #0974c8;
  border:none;
  color: #fff;
}

.pagingarea .actions {
  display: table;
  width: 100%;
}

.pagingarea .actions > * {
  display: table-cell;
}
</style>
<?php 
$criteria = new CDbCriteria();
					$criteria->select= 'ad.ad_title,ad.slug';
					$criteria->compare('t.user_id',Yii::app()->user->getId());
					$criteria->join=' INNER JOIN {{place_an_ad}} ad on ad.id=t.ad_id and ad.isTrash="0" and ad.status="A"';
					$criteria->order='t.date_added desc';
					$adsCount = FreebitesDownloadIformation::model()->count($criteria);
					$pages = new CPagination($adsCount);
					$pages->pageSize = 25;
					$pages->applyLimit($criteria);
					$ads = FreebitesDownloadIformation::model()->findAll($criteria);
					
				  ?>
<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
						  <h4 class="card-title">My Active Downloads (<?php echo $adsCount;?>)</h4>
						  
	</style>
		<div class="alert alert-info">
  <strong>Info!</strong> Inactive or deleted download automtically remove from your list.
</div>
					<?php
					
					  
				 
						if($adsCount==0){
						?>
						<div id="#" class="header" style="margin-top:50px;">
						<h4 style="font-size:13px">No Downloads Yet !!! 	
						</h4>
						<div style="clear:both"></div>
						</div>
						<div style="clear:both"></div>
						<?
						}
						else{
							?>
							

						<div class="table">
						<table cellspacing='0' class="table  table-striped"> 
							<thead>
						<tr>
						<th width="125px">Time</th>
						<th>Work</th>
						</tr>
						</thead>
						<tbody>
						<?php
						foreach($ads as $k2=>$v2)
						{
						?>

						<tr>

						<td  >
						<i class="fa fa-clock-o" title="<?php echo $v2->dateAdded;  ?>"></i> <?php echo $v2->dateAdded;  ?>
						</td>

						<td  >


						<a href="<?php   echo Yii::app()->createUrl('details/index',array('slug'=>$v2->slug));   ;?>">
						<?php echo $v2->ad_title;?>
						</a>
						</td>


						</tr>
						<?php     

						}
						?>
						<tr><td colspan="100%" class="paginator">
						<div class="pagingarea"  >
						<div class="actions"  >
						<?php 
						//if($pages->itemCount>3){


						$this->widget('frontend.components.web.widgets.SimplaPager', array(
						'pages'=>$pages,
						// 'route' => 'user/AjaxDetails',

						));  
						//}
						?>
						</div>
						</div>
						</td></tr>
<tbody>


						</table>

						</div>
							<?
						 
						}
                       ?>

                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        </div>
</div> 
                

 
