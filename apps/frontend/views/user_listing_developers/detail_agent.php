<style>
.t-Region {
    display: block;
     margin-bottom: 16px;
}
.dev_projects_list .location_name {
    margin-top: 0px;
}
 
.t-Region-header {
    border-bottom-right-radius: 0 !important;
    border-bottom-left-radius: 0 !important;
    border-bottom: 1px solid rgba(0,0,0,.075);
    box-sizing: border-box;
    display: table;
    table-layout: auto;
    width: 100%;
    font-size: 1.6rem;
    font-weight: 400;
    line-height: 1.6rem;
}
.t-Region--hideShow.is-expanded > .t-Region-bodyWrap {
    display: block;
    height: auto;
}
.t-Cards {
    list-style: none;
    padding: 0;
    margin: -8px;
    overflow: hidden;
    display: flex;
    -webkit-flex-wrap: wrap;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}
.t-Cards--3cols .t-Cards-item:nth-child(3n+1), .t-Cards--4cols .t-Cards-item:nth-child(4n+1), .t-Cards--5cols .t-Cards-item:nth-child(5n+1), .t-Cards--cols .t-Cards-item:nth-child(2n+1) {
    clear: both;
}
.t-Cards--cols .t-Cards-item {
    width: 50%;
}
.t-Cards--3cols .t-Cards-item, .t-Cards--4cols .t-Cards-item, .t-Cards--5cols .t-Cards-item, .t-Cards--cols .t-Cards-item {
    float: left;
}
.t-Cards-item {
    padding: 1%;
}
.t-Cards-item {
    display: block;
}
.t-Cards-item {
    position: relative;
}
.t-Region .t-Region-body {
    padding: 16px;
}
.projects_list43 .t-Card-desc {
    min-height: 53px;
}
.dev_projects_list .project_title{overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;}
li.t-Cards-item:focus{ border:unset !important; }
 .banner-container {
                        height: auto;
                        margin: 0 auto;
                        width: 100%;
                        }
                        #home img {
                        box-shadow: 0 0 50px rgba(0, 0, 0, 0.8);
                        height: auto;
                        margin: 0 auto;
                        position: relative;
                        display:table;
                        width: 100%;
                        max-width: 1170px;
                        }
</style>
<?php
	   $referer = $this->app->request->urlReferrer ;
	   
	   if( strpos( $referer, 'real-estate-developers' ) !== false ) {
			$return_title = 'Back to Developers';
			$return_url = $referer;
		} 
		else{
			 $return_title = 'Back To Find Developers';
	         $return_url = Yii::app()->createUrl('user_listing_developers/find');
		}
	  ?>
<section class="short-image no-padding agency">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-lg-12 short-image-title">
					<h5 class="subtitle-margin second-color upper-case">more</h5>
					<h1 class="second-color upper-case">about us</h1>
					<div class="short-title-separator"></div>
				</div>
			</div>
		</div>
    </section>
    <section class="section-light section-top-shadow no-bottom-padding">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="row">
						<div class="col-xs-12">
							<div class="details-title col-xs-12" style="padding:0px;">
								<h3 class="title-negative-margin"><?php echo $model->companyName;?><span class="special-color">.</span></h3>
								<div class="col-xs-6" style="padding:0px;">
								<div class="details-agency-address pull-left">
									<i class="fa fa-map-marker"></i>
									<span><?php echo $model->address;?>, <?php echo $model->country_name;?></span>
								</div>
								</div>
								<div class="col-xs-6"><a href="<?php echo $return_url;?>" class="pull-right">Back</a></div>
							</div>
							<div class="clearfix"></div>	
							<div class="title-separator-primary"></div>
							<style>
							.team-desc-line span	a{    white-space: nowrap;
    width: 180px;
    text-overflow: ellipsis;
    overflow: hidden;}
							</style>
							<div class="row margin-top-60" >
								<div class="col-xs-12 col-sm-6 col-lg-3" >
									<?php
										   	$image = $this->app->apps->getBaseUrl('uploads/resized/'.$model->image);?>
											<img src="<?php echo $image;?>" style="background:#F8F8F8;border:1px solid #eee;">
									<div class="details-parameters agency-details margin-top-60" style="padding: 20px 10px 20px 20px;">
										<div class="team-desc-line">
											<span class="agent-icon-circle">
												<i class="fa fa-phone"></i>
											</span>
											<span><?php echo $model->phone;?></span>
										</div>
										<?php
										if(!empty($model->ContactPerson)){ ?>
										<div class="team-desc-line">
											<span class="agent-icon-circle">
												<i class="fa fa-user fa-sm"></i>
											</span>
											<span><a href="javascript:void(0)" title="Contact Person" ><?php echo $model->ContactPerson;?></a></span>
										</div>
										<?php } ?>
										<div class="team-desc-line">
											<span class="agent-icon-circle">
												<i class="fa fa-envelope fa-sm"></i>
											</span>
											<span><a href="javascript:void(0)" title="<?php echo $model->ContactEmail;?>" ><?php echo $model->ContactEmail;?></a></span>
										</div>
										
										<?php 
										if(!empty($model->website)){ ?>
										<div class="team-desc-line">
											<span class="agent-icon-circle">
												<i class="fa fa-globe"></i>
											</span>
											<span><a href="<?php echo $model->website;?>" target="_blank"><?php echo $model->WebsiteTitle;?></a></span>
										</div>
										<?php } ?> 
										<div class="team-social-cont">
											<?php 
											if(!empty($model->facebook)){ ?>
											<div class="team-social">
												<a class="agent-icon-circle" href="#">
													<i class="fa fa-facebook"></i>
												</a>
											</div>
											<?php } ?> 
											<?php 
											if(!empty($model->twiter)){ ?>
											<div class="team-social">
												<a class="agent-icon-circle" href="<?php echo $model->twiter;?>">
													<i class="fa fa-twitter"></i>
												</a>
											</div>
											<?php } ?>
											<?php 
											if(!empty($model->google)){ ?>
											<div class="team-social">
												<a class="agent-icon-circle" href="<?php echo $model->google;?>">
													<i class="fa fa-google-plus"></i>
												</a>
											</div>
											<?php } ?>
											
											 
										</div>
									</div>
								</div>					
								<div class="col-xs-12 col-sm-6 col-lg-9">
									 <?php echo nl2br($model->description);?>
								</div>
							</div>
							 <?php $this->renderPartial('_offers');?>
						
						</div>
					</div>
				 
				</div>
			</div>
		</div>
	</section>
