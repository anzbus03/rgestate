<?php

class EmailFriend extends CFormModel
{
    public $name;
    public $email;
    public $message;

    public $url;

    public function rules()
    {
        return array(
            array('name, email,message,url', 'required'),
            array('email', 'email'),
          
        );
    }
}
?>
