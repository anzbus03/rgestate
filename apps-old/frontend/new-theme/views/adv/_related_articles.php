	<style>
	    .white-aside.nobm::after {
 
    content:unset; 
}
	</style>
	<aside class="margin-bottom-15 margin-top-0">
	    
	     
    <span class="white-aside">
      <h4>  <svg class="icon">
                      <use xlink:href="#house"></use>
                  </svg> <?php echo $this->tag->getTag('property_advertising','Property Advertising');?></h4>
    </span>

    <span class="grey-aside" id="related">
  <section class="related-articles">
    <ul>
		<li class="<?php echo $article->slug=='property-advertising-agent' ? 'active' : '' ;?>"><a href="<?php echo $this->app->createUrl('adv/view',array('slug'=>'property-advertising-agent'));?>">   <svg class="icon"><use xlink:href="#real-estate-agent"></use></svg><?php echo $this->tag->getTag('property_owner','Property Owner');?></a></li>
	 	<li class="<?php echo $article->slug=='property-advertising-companies' ? 'active' : '' ;?>"><a href="<?php echo $this->app->createUrl('adv/view',array('slug'=>'property-advertising-companies'));?>">  <svg class="icon"> <use xlink:href="#enterprise"></use></svg><?php echo $this->tag->getTag('real_estate_company_/__develop','Real Estate Company /  Developer  / Property Management Company');?></a></li>
	 
    </ul>
  </section>

</span>
    
  
	    
	 
	</aside>
	<aside class="margin-top-0">

    
    <span class="white-aside">
      <h4>  <svg class="icon">
                      <use xlink:href="#megaphone"></use>
                  </svg> <?php echo $this->tag->getTag('banner_advertising','Banner Advertising');?></h4>
    </span>

    <span class="grey-aside" id="related">
  <section class="related-articles">
    <ul>
		<li class="<?php echo $article->slug=='advertise-home-page' ? 'active' : '' ;?>"><a href="<?php echo $this->app->createUrl('adv/view',array('slug'=>'advertise-home-page'));?>"><svg class="icon"><use xlink:href="#home"></use></svg><?php echo $this->tag->getTag('home_page','Home Page');?></a></li>
		<li class="<?php echo $article->slug=='advertise-sales-listing' ? 'active' : '' ;?>"><a href="<?php echo $this->app->createUrl('adv/view',array('slug'=>'advertise-sales-listing'));?>"><svg class="icon"><use xlink:href="#key"></use></svg><?php echo $this->tag->getTag('sales_listing_page','Sales Listing Page');?></a></li>
		<li class="<?php echo $article->slug=='advertise-rental-listing' ? 'active' : '' ;?>"><a href="<?php echo $this->app->createUrl('adv/view',array('slug'=>'advertise-rental-listing'));?>"><svg class="icon"><use xlink:href="#key-1"></use></svg><?php echo $this->tag->getTag('rental_listing_page','Rental Listing Page');?></a></li>
		<li class="<?php echo $article->slug=='advertise-residentail-listing' ? 'active' : '' ;?>"><a href="<?php echo $this->app->createUrl('adv/view',array('slug'=>'advertise-residentail-listing'));?>"><svg class="icon"><use xlink:href="#apartment"></use></svg><?php echo $this->tag->getTag('residentail_listing_page','Residentail Listing Page');?></a></li>
		<li class="<?php echo $article->slug=='advertise-commercial-listing' ? 'active' : '' ;?>"><a href="<?php echo $this->app->createUrl('adv/view',array('slug'=>'advertise-commercial-listing'));?>"><svg class="icon"><use xlink:href="#supermarkets"></use></svg><?php echo $this->tag->getTag('commercial_listing_page','Commercial Listing Page');?></a></li>
		<li class="<?php echo $article->slug=='advertise-sales-detail-page' ? 'active' : '' ;?>"><a href="<?php echo $this->app->createUrl('adv/view',array('slug'=>'advertise-sales-detail-page'));?>"><svg class="icon"><use xlink:href="#key"></use></svg><?php echo $this->tag->getTag('sales_detail_page','Sales Detail Page');?></a></li>
		<li class="<?php echo $article->slug=='advertise-rental-detail-page' ? 'active' : '' ;?>"><a href="<?php echo $this->app->createUrl('adv/view',array('slug'=>'advertise-rental-detail-page'));?>"><svg class="icon"><use xlink:href="#key-1"></use></svg><?php echo $this->tag->getTag('rental_detail_page','Rental Detail Page');?></a></li>
      
    </ul>
  </section>

</span>
    
      
     
   
  </aside>
	
