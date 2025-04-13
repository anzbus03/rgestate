<?php
/**
 * This is the model class for table "mw_image_watermark".
 *
 * The followings are the available columns in table 'mw_image_watermark':
 * @property integer $id
 * @property string $watermark_image
 * @property integer $opacity
 * @property integer $position_x
 * @property integer $position_y
 */

class ImageWatermark extends ActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'mw_image_watermark';
    }
    
    public function rules()
    {
        return [
            ['opacity, position_x, position_y, watermark_width, watermark_height', 'numerical', 'integerOnly' => true],
            ['watermark_image', 'length', 'max' => 255],
        ];
    }
    
}
