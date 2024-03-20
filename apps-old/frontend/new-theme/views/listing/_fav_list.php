                        <!-- Listing Item -->
                        <?php
                        $links_open_in  = $this->options->get('system.common.link_open_in','S');	
                        $apps = $this->app->apps;
                        $remove = $this->tag->getTag('remove','Remove');
                        $s_class_n = 'col-sm-4';$bg = true;
                        foreach($works as $k=>$v){ 
							?>
							    	<div class="col-sm-4 lst-prop">
							<div class="strip grid">
            <figure>            
                        <a href="<?php echo $v->detailUrl;?>"><img src="<?php echo $v->SingleImage;?>" class="img-fluid" alt="">
              <div class="read_more"><span>Read more</span></div>
              </a>  <?php echo $v->listRowPrice();?>
                 
              </figure>
            <div class="wrapper">
              <div class="smartad_infoarea">
                <h2 class="smartad_title smartad_title-link"><a href="<?php echo $v->detailUrl;?>"><?php echo  $v->SectionCategoryFullTitle;?></a></h2>
               <div class="sh-mobile"><?php echo $v->listRowPrice();?></div>
                <div class="smartad_detail">
                   
                    <?php echo $v->listRowFeatures();?>
                    </div>
                <div class="smartad_location-area">
                  <div class="smartad_location"><span class="svg">
                    <svg viewBox="0 0 1792 1792" class="smartad_locationicon">
                      <use xlink:href="#svg-location"></use>
                    </svg>
                    </span><span class="smartad_locationtext"><?php echo $v->listRowLocation();?></span></div>
                </div>
              </div>
            </div>
            <a class="remove-propp-shortlis" onclick="removethisShortlist(this)" data-id="<?php echo $v->id;?>"><i class="fa fa-trash"></i> <?php echo $remove;?></a>
                
          </div>
          </div>
                         
							<?
						 
						 }  

                 
