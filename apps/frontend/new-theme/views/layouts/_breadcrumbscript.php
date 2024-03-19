<?php
if(defined('LIST_URL')){ ?> 
<script type='application/ld+json'>
{   
	"@context": "https://schema.org", 
	"@type": "BreadcrumbList",  
	"itemListElement": [
		{
		"@type": "ListItem", 
		"position": 1,   
		"name": "Back to Search",     
		"item": "<?php echo LIST_URL;?>"
		},
		{     
		"@type": "ListItem", 
		"position": 2,
		"name": "<?php echo LIST_URL_TITLE;?>",
		"item": "<?php echo LIST_URL;?>"  
		},
		{     
		"@type": "ListItem", 
		"position": 3,
		"name": "<?php echo CITY_NAME;?>",
			"item": "<?php echo CITY_URL;?>"  
		},
		{  
		"@type": "ListItem",   
		"position": 4, 
		"name": "<?php echo CATEGORY_NAME;?>", 
		"item": "<?php echo CATEGORY_URL;?>" 
		},
		{  
		"@type": "ListItem",   
		"position": 5, 
		"name": "<?php echo AD_TITLE;?>", 
		"item": "<?php echo AD_URL;?>" 
		}
	] 
}
</script>
<?php } ?> 
