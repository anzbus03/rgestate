 <style>.furnshed .search-popup-cntainer-wrapper {
    padding: 0px;
    -webkit-box-shadow: unset;
    box-shadow: unset;
    -webkit-box-sizing: unset;
    box-sizing: border-box;
    border-radius: 0px;
    background-color: #fff;
}.search-popup-cntainer {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    z-index: 111;
    margin-top: 2px;
    display: none;
}.form-container-list-item {
    position: relative;
    border-radius: 4px;
    color: #222;
    font-weight: 400;
    background-color: #fff;
    
    margin-right: 10px;
}.filters_listing .list-item-p {
    padding: 0px 10px 0;
    border-radius: 2px;
    background-color: #fff;
    border: 1px solid #dfdfdf;
    min-height: 31px;
}.furnshed .list-item-p.list-item-purpose {
    display: none;
}.furnshed .search-popup-cntainer {
    position: unset;
    display: flex;
}
					 .furnshed.form-container-list-item {
    border: 1px solid #dfdfdf;
    padding: 3px;
}.filters_listing  .form-container-list-item {
    width: auto;
    margin-right: 10px;
    min-width: 120px;
    margin-top: 3px;
}.furnshed .askaan-listbox {
    display: flex;
}.furnshed .askaan-listbox span {
    margin-right: 2px;
}.furnshed .search-popup-cntainer-btn1 {
    border-radius: 5px;
    min-width: 50px;
    border: 0px;
    height: 23px !important;
    /* max-height: 21px !important; */
    padding: 2px 5px;
    margin: 0px;
    line-height: 1;
    min-height: unset !important;
}.furnshed  .search-popup-cntainer-btn1.active {
    color: var(--secondary-color);
    background-color:#D2E0E8;
}.furnshed .search-popup-cntainer-btn1 {
    border-radius: 5px;
    min-width: 50px;
    border: 0px;
}
@media only screen and (min-width: 768px){
    #listing .furnshed .search-popup-cntainer{
   
    position: unset !important;
    display: flex;
    box-shadow: unset;
    border: 0px !important;
 
    }
    #listing .furnshed .search-popup-cntainer-wrapper {
    padding: 0px;
    -webkit-box-shadow: unset;
    box-shadow: unset; margin: 0px;
}
#listing .furnshed .search-popup-cntainer{margin: 0px;
}#listing .furnshed  .search-popup-cntainer-btn { 
    border: 0px;
}
}
</style>
<script>
	function setFavVaue(k){
		var val_fa = $(k).attr('aria-value');
		$('.acg-fav').removeClass('active')
		$(k).addClass('active');
		$('input[name="furnished"]').val(val_fa).change();
		search_byAjax()
	}
	function setLease(k){
		var val_fa = $(k).attr('aria-value');
		$('.acg-fav').removeClass('active')
		$(k).addClass('active');
		$('input[name="lease_status"]').val(val_fa).change();
		search_byAjax()
	}
	function setProjectStatus(k){
	    $('#status'+ $(k).attr('aria-value')).prop('checked',true).change()
	}
</script>
					 		 
					 		<div class="form-container-list-item furnshed pull-left margin-bottom-10" data-input="furnished" data-function="">
							 
								
								<div class="search-popup-cntainer">
									<div class="search-popup-cntainer-wrapper" role="listbox">
											<div>
                                                <div role="listbox" class="askaan-listbox">
                                                    <?php
                                                    if(isset($_GET['preleased'])){
														$lease_ststau = $filterModel->getlease_status();
														  $lease_status = @$formData['lease_status'];
														  $k1 =''; 
														  $v1 = 'All'; $cls =  $lease_status==$k1 ? 'active' :'';
														  echo ' <span><button aria-label="'.$v1.'"  onclick="setLease(this)" aria-value="'.$k1.'" class="acg-fav search-popup-cntainer-btn1 search-popup-cntainer-btn '.$cls.'">'.$v1.'</button></span>';
														
														foreach($lease_ststau as $k1=>$v1){
															  $cls =  $lease_status==$k1 ? 'active' :''; 
															echo ' <span><button aria-label="'.$v1.'"  onclick="setLease(this)" aria-value="'.$k1.'" class="acg-fav search-popup-cntainer-btn1 search-popup-cntainer-btn '.$cls.'">'.$v1.'</button></span>';
														}
													}else if($filterModel->section_id!='new-development'){
                                                     $furnished = @$formData['furnished'];?> 
                                                     
                                                    <span><button aria-label="All" onclick="setFavVaue(this)" aria-value="" class="acg-fav search-popup-cntainer-btn1 search-popup-cntainer-btn <?php echo $furnished=='' ? 'active' :'';?>">All</button></span>
                                                     <span><button aria-label="Furnished"  onclick="setFavVaue(this)" aria-value="furnished" class="acg-fav search-popup-cntainer-btn1 search-popup-cntainer-btn <?php echo $furnished=='furnished' ? 'active' :'';?>">Furnished</button></span>
                                                     <span><button aria-label="Unfurnished" onclick="setFavVaue(this)" aria-value="unfurnished" class="acg-fav search-popup-cntainer-btn1 search-popup-cntainer-btn <?php echo $furnished=='unfurnished' ? 'active' :'';?>">Unfurnished</button></span>
                                                 <?php }
                                                 else if($filterModel->section_id=='new-development'){
                                                      $furnished = @$formData['pstatus'];
                                                      if($furnished=='all'){ $furnished =''; }
                                                     ?>
                                                              <span><button aria-label="All" onclick="setProjectStatus(this)" aria-value="all" class="acg-fav search-popup-cntainer-btn1 search-popup-cntainer-btn <?php echo $furnished=='' ? 'active' :'';?>">All</button></span>
                                                     <span><button aria-label="Ready"  onclick="setProjectStatus(this)" aria-value="ready" class="acg-fav search-popup-cntainer-btn1 search-popup-cntainer-btn <?php echo $furnished=='ready' ? 'active' :'';?>">Ready</button></span>
                                                     <span><button aria-label="Off Plan" onclick="setProjectStatus(this)" aria-value="off-plan" class="acg-fav search-popup-cntainer-btn1 search-popup-cntainer-btn <?php echo $furnished=='off-plan' ? 'active' :'';?>">Off Plan</button></span>
                                         
                                                     <?php
                                                 }
                                                 
                                                 
                                                 ?> 
                                                 </div>
												 
											</div>
									</div>
								
								</div>
					</div>
					
