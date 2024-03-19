 <div class="mt-4">
           <?php 
			  $model = new AdFavourite('serach');
          
        $model->unsetAttributes();
       
          $model->user_id  =  Yii::app()->user->getId();
     
          $this->renderPartial('favourite_list',compact('model'));?>
       </div>
