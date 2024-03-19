 <div class="col-md-3">
          <a href="<?php echo ($this->route=='send_email/index') ? Yii::app()->createUrl('send_email/mail') : Yii::app()->createUrl('send_email/index')  ;?>" class="btn btn-primary btn-block margin-bottom"><?php echo  ($this->route=='send_email/index') ? 'Compose' :  'Back to inbox'  ;?></a>

          <div class="box box-solid">
          
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
				   <li <?php if(Yii::app()->request->getQuery('draft','0')=='0' and  in_array($this->action->id,array('index','mail')) ) { ?>  class="active" <?php } ?> ><a href="<?php echo Yii::app()->createUrl('send_email/index');?>"><i class="fa fa-inbox "></i> Mail Queue Manager </a></li>
                   <li <?php if($this->route=='send_email/index' and Yii::app()->request->getQuery('draft','0')=='1'  and  in_array($this->action->id,array('index','mail')) ) { ?>  class="active" <?php } ?> ><a href="<?php echo Yii::app()->createUrl('send_email/index',array('draft'=>'1'));?>"><i class="fa fa-file-text-o"></i>My Drafts</a></li>
                   <li  <?php if($this->route=='send_email/trash' ) { ?>  class="active" <?php } ?> ><a href="<?php echo Yii::app()->createUrl('send_email/trash');?>"><i class="fa fa-trash-o"></i> Trash</a></li>
                   <li  <?php if(in_array($this->action->id,array('email_template','email_template_create','templateupdate'))){ ?>  class="active" <?php } ?> ><a href="<?php echo Yii::app()->createUrl('send_email/email_template');?>"><i class="glyphicon glyphicon-flag"></i> Templates</a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
      </div>
     
        
  <style>
  .margin-bottom {  margin-bottom: 20px; } 
  </style>
