<?php

/**
 * This is the model class for table "mw_contact_us".
 *
 * The followings are the available columns in table 'mw_contact_us':
 * @property integer $id
 * @property integer $type
 * @property string $email
 * @property string $name
 * @property string $meassage
 * @property string $city
 * @property string $date
 */
class SendEnquiry2  extends SendEnquiry
{
	public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
