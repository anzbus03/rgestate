<?php

$filename = Yii::app()->apps->getBaseUrl('uploads/resume/'.$file); // of course find the exact filename....        
 

readfile($filename);

exit;
