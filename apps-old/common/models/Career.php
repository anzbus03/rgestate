<?php

class Career extends CFormModel
{
    public $name;
    public $email;
    public $position;
    public $message;
    public $image;
    public $phone;
 
    private $_identity;
 
    public function rules()
    {
        return array(
            array('name, email,position,message,phone,', 'required'),
             array('image', 'file', 'types'=>'pdf,doc,docx', 'allowEmpty'=>true,  'safe' => true),
           // array('resume', 'file','types'=>'pdf', 'allowEmpty'=>true, 'on'=>'update', 'on'=>'insert'),
           
        );
    }
   
   
   public function attributeLabels()
    {
        return array(
            'image' => 'Resume',
            'image_field' => 'Resume [ **pdf,doc,docx]',
            
        );
    }
  
}
