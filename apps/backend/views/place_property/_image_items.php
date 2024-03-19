<div id="loader_againn"></div>
 <style>
	  .mbtns  { padding:0px; margin-bottom:10px;}
	 .mbtns a { background:#fafafa; }
 .mbtns a { width:32%; margin-right:0.333%;}
 </style>
<div class="masonry-wrapper "   >
	
	
	<div class="col-sm-12 mbtns">
	<a href="<?php echo Yii::app()->createUrl('place_property/image_management2',array('status'=>'I'));?>"    class="btn <?php echo @$attributes['status'] =='I' ? 'btn-warning' :'';?>" >Waiting Approval</a>
	<a    href="<?php echo Yii::app()->createUrl('place_property/image_management2',array('status'=>'A'));?>" class="btn <?php echo @$attributes['status'] =='A' ? 'btn-success' :'';?>" >Approved</a> 
	<a   href="<?php echo Yii::app()->createUrl('place_property/image_management2',array('status'=>'All'));?>" class="btn <?php echo @$attributes['status'] =='All' ? 'btn-primary' :'';?>" >All Image</a>
	</div>
	
 
<a href="javascript:void(0)"><label><input type="checkbox" id="exchnger"  onclick="selectCheck(this)"> <span id="trs">Select All</span></label></a>

	<?php
	if(empty($profileList)){
		
		?>
		<div class="col-sm-12" id="no-data">
			<div class="ig-dive"><img style="width: 250px;margin:30px auto;text-align: center;display: inherit;" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZlcnNpb249IjEuMSIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbG5zOnN2Z2pzPSJodHRwOi8vc3ZnanMuY29tL3N2Z2pzIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgeD0iMCIgeT0iMCIgdmlld0JveD0iMCAwIDI2NS4yNTcgMjY1LjI1NyIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMiIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgY2xhc3M9IiI+PGc+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+Cgk8cGF0aCBzdHlsZT0iIiBkPSJNMjQ3Ljc1NywyNy42NzdIMTcuNWMtOS42NDksMC0xNy41LDcuODUxLTE3LjUsMTcuNVYyMjAuMDhjMCw5LjY1LDcuODUxLDE3LjUsMTcuNSwxNy41aDIzMC4yNTcgICBjOS42NDksMCwxNy41LTcuODUsMTcuNS0xNy41VjQ1LjE3N0MyNjUuMjU3LDM1LjUyOCwyNTcuNDA3LDI3LjY3NywyNDcuNzU3LDI3LjY3N3ogTTE3LjUsNDIuNjc3aDIzMC4yNTcgICBjMS4zNTUsMCwyLjUsMS4xNDUsMi41LDIuNXYxMTYuNDc0bC00MC4xMDgtNTEuNDc0Yy0yLjk3Ni0zLjgxOS03LjMzMi02LjEwOC0xMS45NTItNi4yNzhjLTQuNjE5LTAuMTczLTkuMTMyLDEuNzkxLTEyLjM4Miw1LjM4MiAgIGwtNTIuMDM5LDU3LjUxMmMtMS4yNTMsMS4zODQtNC4wMzMsMS43NjYtNS42MTQsMC43NzJsLTQyLjc4OC0yNi45NDZjLTcuMzMyLTQuNjE5LTE4LjA2My00LjE0My0yNC45NTgsMS4xMDVMMTUsMTc2LjI4OFY0NS4xNzcgICBDMTUsNDMuODIyLDE2LjE0NSw0Mi42NzcsMTcuNSw0Mi42Nzd6IE0yNDcuNzU3LDIyMi41OEgxNy41Yy0xLjM1NSwwLTIuNS0xLjE0NS0yLjUtMi41di0yNC45NDJsNTQuNTAxLTQxLjQ3OCAgIGMxLjg5My0xLjQ0LDUuODctMS42MTYsNy44ODEtMC4zNDlsNDIuNzg4LDI2Ljk0NmM3LjczNCw0Ljg3MSwxOC41OTYsMy4zNzcsMjQuNzI5LTMuNGw1Mi4wMzktNTcuNTEyICAgYzAuMzEyLTAuMzQ1LDAuNTM1LTAuNDUsMC43MDgtMC40NTdjMC4xMzEsMC4wMDUsMC4zODUsMC4xNDEsMC42NzEsMC41MDhsNTEuOTQsNjYuNjU4djM0LjAyNSAgIEMyNTAuMjU3LDIyMS40MzUsMjQ5LjExMiwyMjIuNTgsMjQ3Ljc1NywyMjIuNTh6IiBmaWxsPSIjZjI3ZjUyIiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAyIiBjbGFzcz0iIj48L3BhdGg+Cgk8cGF0aCBzdHlsZT0iIiBkPSJNMTEwLjg0MywxMjkuMjI0YzE0LjY0OSwwLDI2LjU2Ni0xMS45MTcsMjYuNTY2LTI2LjU2NnMtMTEuOTE4LTI2LjU2Ni0yNi41NjYtMjYuNTY2ICAgYy0xNC42NDksMC0yNi41NjYsMTEuOTE4LTI2LjU2NiwyNi41NjZTOTYuMTk0LDEyOS4yMjQsMTEwLjg0MywxMjkuMjI0eiBNMTEwLjg0Myw5MS4wOTFjNi4zNzgsMCwxMS41NjYsNS4xODgsMTEuNTY2LDExLjU2NiAgIGMwLDYuMzc4LTUuMTg4LDExLjU2Ni0xMS41NjYsMTEuNTY2Yy02LjM3OCwwLTExLjU2Ni01LjE4OC0xMS41NjYtMTEuNTY2Qzk5LjI3Nyw5Ni4yOCwxMDQuNDY1LDkxLjA5MSwxMTAuODQzLDkxLjA5MXoiIGZpbGw9IiNmMjdmNTIiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDIiIGNsYXNzPSIiPjwvcGF0aD4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8L2c+PC9zdmc+">
			
			</div>
			<div class="ig-dive-data text-center" style="font-size:20px;">No result found.</div>
		</div>	
		
		 
			<?
	}
	else{ ?> 
				<div>Total Results - <span class="total-data-span"><?php echo number_format($profileCount,0,'.',',');?></span>  </div>
				<div class="clearfix"></div>
				<div class="masonry" >
					<?php
					$this->renderPartial('_list_image');?>
					   <div id="suggest_friends_last_idt"></div>
					<!--<div class="test"></div>-->
				</div>
				<?php } ?> 
            </div>
