<?php defined('MW_PATH') || exit('No direct script access allowed');?>
<?php 
if(Yii::app()->user->hasFlash('error'))
{
	?>
	<div class="error1"><?php echo CHtml::errorSummary($model); ?></div>
 <?
}
?>
<fieldset id="report-modal">
    <legend>Report this Listing</legend>
    <div class="fieldset-content non-js">
    <h2><?php echo $ad->ad_title;?></h2>
    <div class="Report-listing-non-js">
        <div id="accordion" class="sections">
            <h3>Spam</h3>
            <div id="spam-tab">
                  <?php
                    $form = $this->beginWidget('CActiveForm',array( 
												'clientOptions' => array(
												'validateOnSubmit'=>true,
                 
												),

												)); 
												?>
                  
                    <p>What kind of Spam is this?</p>
                    <div id="spam-categories" class="categories">
                        <div class="category"><input type="radio" name="details" value="Commercial" id="commercial"/><label for="commercial">Commercial</label></div>
                        <div class="category"><input type="radio" name="details" value="Offensive" id="offensive"/><label for="offensive">Offensive</label></div>
                        <div class="category"><input type="radio" name="details" value="Irrelevant" id="irrelevant"/><label for="irrelevant">Irrelevant</label></div>
                        <div class="category"><input type="radio" name="details" value="Other" id="other"/><label for="other">Other</label></div>
                    </div>
                    <input type="hidden" name="type" value="Spam"/>
                    <input type="hidden" name="ad_id" value="<?php echo $ad->id;?>"/>
					<input type="hidden" name="previous_page" value=""/> 
                    <div class="buttons">
                        
                        <input type="submit" value="Report Spam" title="Report" alt="Report" class="awesome small red"/>
                    </div>
                <?php $this->endWidget();?>
            </div>

            <!--<div class="blogdetaildivider"></div>-->
            <h3>Fraud</h3>
            <div id="fraud-tab">
					<?php
					$form = $this->beginWidget('CActiveForm',array( 
						'clientOptions' => array(
						'validateOnSubmit'=>true,

						),

						)); 
						?>
                    <p>Please tell us why you believe this is fraud:</p>
                    <textarea name="details" style="width:97%; margin-bottom:10px"></textarea>
                    <input type="hidden" name="type" value="Fraud"/>
                     
                    <input type="hidden" name="ad_id" value="<?php echo $ad->id;?>"/>
                    <div class="buttons">
                        
                        <input type="submit" value="Report Fraud" title="Report" alt="Report" class="awesome small red" />
                    </div>
             <?php   $this->endWidget();?>
            </div>
            <!--<div class="blogdetaildivider"></div>-->
            <h3>Miscategorized</h3>
            <div id="miscategorized-tab">
                 <?php
					$form = $this->beginWidget('CActiveForm',array( 
						'clientOptions' => array(
						'validateOnSubmit'=>true,

						),

						)); 
						?>
                    <p>This Ad will be reviewed and recategorized accordingly.</p>
                    
                    <input type="hidden" name="type" value="Miscategorized"/>
                    
                    <input type="hidden" name="details" value="Miscategorized"/>
                    <input type="hidden" name="ad_id" value="<?php echo $ad->id;?>"/>
                    <div class="buttons">
                        
                        <input type="submit" value="Report Miscategorisation" title="Report" alt="Report" class="awesome small red" style="width:100%;" />
                    </div>
               <?php   $this->endWidget();?>
            </div>
            <!-- <div class="blogdetaildivider"></div>-->
            <h3>Repetitive Listing</h3>
            <div id="repetitive-tab">
					<?php
					$form = $this->beginWidget('CActiveForm',array( 
					'clientOptions' => array(
					'validateOnSubmit'=>true,
					),
					)); 
					?>
                    <p>You have chosen to Report this as a repetitive listing.</p>
                    <input type="hidden" name="type" value="Repetitive listing"/>
                    <input type="hidden" name="details" value="Rpetitive listing"/>
                     <input type="hidden" name="ad_id" value="<?php echo $ad->id;?>"/>
                    <div class="buttons">
                        
                        <input type="submit" value="Report Repetition" title="Report" alt="Report" class="awesome small red" />
                    </div>
               <?php   $this->endWidget();?>
            </div>
            

        </div>
            
 	            <a class="awesome small red" href="<?php echo Yii::app()->request->baseUrl.base64_decode($back);?>">Back</a>
 	         
    </div>
    </div>
</fieldset>

