 <style>
 	.dasbrd .col-xl-4 {
 		width: 33.333333% !important;
 	}

 	span.det-sn {
 		color: #bbb;
 		font-weight: normal;
 		font-size: 15px;
 	}

 	@media only screen and (max-width: 600px) {
 		.posingpackge a.button7 {
 			width: 100% !important;
 			max-width: 100% !important;
 			margin-bottom: 0px;
 		}

 		.margin-bottom-15.mob-no-m {
 			margin-bottom: 0px !important;
 		}

 		.posingpackge .col-sm-6 {
 			margin-bottom: 20px;
 		}

 		.accounb-dic {
 			float: none;
 			background: #eee;
 			padding: 15px 10px;
 			border-radius: 4px;
 		}
 	}

 	.border-left-primary {
 		border-left: .25rem solid #4e73df !important;
 	}

 	.border-left-success {
 		border-left: .25rem solid #1cc88a !important;
 	}

 	.border-left-info {
 		border-left: .25rem solid #36b9cc !important;
 	}

 	.border-left-warning {
 		border-left: .25rem solid #f6c23e !important;
 	}

 	.dasbrd .card .card-body {
 		padding: 6px 20px;
 	}

 	#js-legend2 ul li {
 		width: auto !important;
 		line-height: 1.5;
 		margin-right: 5px !important;
 		float: left;
 	}

 	#js-legend2 ul li span {

 		display: inline-block;
 		width: 29px;
 		height: 11px;
 		margin-right: 5px;
 	}

 	.dasbrd .card {
 		border: 0px !important;
 		box-shadow: unset !important;
 	}

 	.card-body-sep {
 		min-height: 320px;
 	}

 	.warning {
 		font-weight: 600;
 	}
 </style>
 <div class="">
	<div class="  margin-bottom-20">
		<div style="width:50px;height:50px;" class="pull-left"><svg id="Capa_1" enable-background="new 0 0 512 512" height="100%" viewBox="0 0 512 512" width="100%" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="256" x2="256" y1="512" y2="0">
					<stop offset="0" stop-color="#ffe59a" />
					<stop offset="1" stop-color="#ffffd5" />
				</linearGradient>
				<linearGradient id="SVGID_2_" gradientUnits="userSpaceOnUse" x1="256" x2="256" y1="407" y2="105">
					<stop offset="0" stop-color="#ffde00" />
					<stop offset="1" stop-color="#fd5900" />
				</linearGradient>
				<g>
					<g>
						<circle cx="256" cy="256" fill="url(#SVGID_1_)" r="256" />
					</g>
					<g>
						<g>
							<path d="m309.25 105.898v52.396h52.353c-3.929-27.125-25.25-48.463-52.353-52.396zm-71 150.102v44.412h35.5v-44.412c0-4.91 3.969-8.882 8.875-8.882h5.2l-31.825-31.852-31.825 31.852h5.2c4.906 0 8.875 3.972 8.875 8.882zm62.125-79.941c-4.906 0-8.875-3.973-8.875-8.882v-62.177h-133.125c-4.906 0-8.875 3.973-8.875 8.882v284.235c0 4.91 3.969 8.882 8.875 8.882h195.25c4.906 0 8.875-3.973 8.875-8.882v-222.058zm-103.9 73.661 53.25-53.294c3.467-3.47 9.083-3.47 12.55 0l53.25 53.294c2.54 2.542 3.302 6.358 1.924 9.68-1.369 3.322-4.611 5.482-8.199 5.482h-17.75v44.412c0 4.909-3.969 8.882-8.875 8.882h-53.25c-4.906 0-8.875-3.973-8.875-8.882v-44.412h-17.75c-3.588 0-6.83-2.16-8.199-5.482-1.378-3.322-.615-7.139 1.924-9.68zm130.525 95.103c0 4.91-3.969 8.882-8.875 8.882h-124.25c-4.906 0-8.875-3.973-8.875-8.882v-17.765c0-4.91 3.969-8.882 8.875-8.882s8.875 3.973 8.875 8.882v8.882h106.5v-8.882c0-4.91 3.969-8.882 8.875-8.882s8.875 3.973 8.875 8.882z" fill="url(#SVGID_2_)" />
						</g>
					</g>
				</g>
			</svg></div>
		<div style="width:calc(100% - 60px); " class="pull-right">
			<div class="warning"><?php echo $this->tag->getTag('warning', 'Warning'); ?>:</div>
			<p>
				<?php if (empty($this->member->cr_number) and empty($this->member->u_crdoc)) {
						echo $this->tag->getTag('update_commercial_registration', 'Update Commercial Registration No., Upload Commercial Registration.');
					} else if (empty($this->member->cr_number)) {
						echo $this->tag->getTag('update_commercial_registrati_2', 'Update Commercial Registration No.');
					} else if (empty($this->member->u_crdoc)) {
						echo $this->tag->getTag('upload_commercial_registration', 'Upload Commercial Registration.');
					}
					?>
				<a href="<?php echo Yii::app()->createUrl('member/update_profile'); ?>"><?php echo  $this->tag->getTag('click_here_to_update', 'Click here to update'); ?></a>
			</p>
		</div>
		<div class="clearfix"></div>
	</div>
 </div>



