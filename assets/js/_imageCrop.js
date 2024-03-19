 var newCropUrl ;
 var $image  ;
	 var  imgX5;
	 var  imgY5;
	 var  widthX;
	 var  widthY;
	 var _min_height;
	 var _min_width;
	 var _ratio;
	 $(function () {
       $image = $('#crp_image');
      var cropBoxData;
      var canvasData;
 
      $('#modal_cropper').on('shown.bs.modal', function () {
	 
		$image.cropper('destroy');
        $image.cropper({
          autoCropArea:0,
          minCropBoxHeight:_min_height,
		 minCropBoxWidth:_min_width,
		   aspectRatio: _ratio,
		 cropBoxMovable: false,
						cropBoxResizable: false,
						center:true,
						viewMode: 1,
						dragMode: 'move',
          crop: function(e) {
			 imgX5 = e.x;
			 imgY5 = e.y;
			 
			 widthX = e.width;
			 widthY = e.height;
			 
    
  },
  
          viewMode: 1, 
          ready: function () {
            $image.cropper('setCanvasData', canvasData);
            $image.cropper('setCropBoxData', cropBoxData);
          }
        });
      }).on('hidden.bs.modal', function () {
        cropBoxData = $image.cropper('getCropBoxData');
        canvasData = $image.cropper('getCanvasData');
        $image.cropper('destroy');
      });
    });
    
    var croppingDiv ;
    function showCropp(k)
    {
		var banner_id = $('#CampaignAd_banner_size').val();
		_min_width  =  $(k).attr('data-width');
		_min_height = $(k).attr('data-height');
		_ratio =  parseFloat(_min_width)/parseFloat(_min_height);
 
		 $('#modal_cropper').modal('show');
		 $('#modal_cropper').find('#crp_image').attr('src',$(k).attr('data-img'));
		 croppingDiv = $(k).parent();
	}   
	function SaveCropedImage(){
		var cropBoxData		=	$image.cropper('getCropBoxData');
		var imageData		=	$image.cropper('getData');
		  
        var submitArray =  {
		   imgUrl		:		$image.attr('src') ,		   
		   imgX5		:		imgX5,
		   imgY5		:		imgY5,
		   widthX		:		widthX,
		   widthY		:		widthY,
		   cropW		:		cropBoxData.width,
		   cropH		:		cropBoxData.height,	
		   rotate		:		imageData.rotate,
		   	   
		   
		   };
   
      
       $.get(newCropUrl,submitArray,function(data){  
		   
											dataParse = JSON.parse( data );
							  
											if(dataParse.status == 'success'){
												       $('#modal_cropper').modal('hide');
												    alert('cropped') ;
												   //$image.cropper('destroy');
												//  alert(dataParse.url) 
											} 
											else if(dataParse.status == 'failed'){
												alert(dataParse.message) ;
												return false; 
											}
		   
		   }) 
 
	}
 
	 
	 
