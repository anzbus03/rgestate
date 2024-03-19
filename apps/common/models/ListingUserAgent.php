<?php
 
class ListingUserAgent extends ListingUsers
{
   
    public function getCompanyNabel(){
		 
		     return 'Agency Name';
		    
		 
	}
 
	public function getemailLabel(){
		 
		  
		    return 'Agent Email';
			 
		 
	}
	public function getcontact_numberLabel(){
		 
		   
		    return 'Agenct Contact Number';
			 
		 
	}
 
	public function getServiceLabel(){
		 
	  return 'Service Country'   ;
		 
		 
	}
	public function getAddressLabel(){
	 
			return   'Agent Address' ;
			 
	}
	public function getCityLabel(){
		 
		 return   'Service Locations'   ;
		 
		 
	}
	public function getCompanyLogoNabel(){
		 
		 
		    return 'Agent Image';
			 
		 
	}
		public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public function getOptionCls(){
        $html  = '';
        if(empty($this->parent_user)){
                  	$html  .= '<div class="opts"><a href="'.Yii::app()->createUrl('member/account_settings').'"><i class="fa fa-edit"></i> '.$this->mTag()->getTag('edit','Edit').'</a>  <br />';
     	$html  .= '<a href="'.Yii::app()->createUrl('member/account_settings').'" class="cls-succes"><i class="fa fa-key"></i> '.$this->mTag()->getTag('reset_password','Reset Password').'</a>  ';
	
        }else{
            
            	$html  .= '<div class="opts"><a href="'.Yii::app()->createUrl('member/add_agent',array('id'=>$this->user_id)).'"><i class="fa fa-edit"></i> '.$this->mTag()->getTag('edit','Edit').'</a>  <br />';
        
		$html  .= '<a href="'.Yii::app()->createUrl('member/user_reset_password',array('id'=>$this->user_id)).'" class="cls-succes"><i class="fa fa-key"></i> '.$this->mTag()->getTag('reset_password','Reset Password').'</a>  ';
		  
		if($this->user_status=='A'){
		$html  .= '<br /><a href="javascript:void(0)" data-href="'.Yii::app()->createUrl('member/user_deativate',array('id'=>$this->user_id)).'" onclick="termicateUser(this)" class="cls-danger"><i class="fa fa-stop"></i> '.$this->mTag()->getTag('deactivate','Deactivate').'</a> </div>';
		}
		if($this->user_status=='I'){
		$html  .= '<br /><a href="javascript:void(0)" data-href="'.Yii::app()->createUrl('member/user_ativate',array('id'=>$this->user_id)).'" onclick="termicateUser(this)" class="cls-danger"><i class="fa fa-stop"></i> '.$this->mTag()->getTag('activate','Activate').'</a> </div>';
		}
		   
            
        }
	
        return $html;
	}
}
