<?php foreach ($data as $item) { ?>
<tr>
    <td><?php echo CHtml::encode($item->name); ?></td>
    <td><?php echo CHtml::encode($item->email); ?></td>
    <td><?php echo CHtml::encode($item->phone); ?></td>
    <td><?php echo CHtml::decode($item->PropertyDetail); ?></td>
    <td><?php echo CHtml::encode($item->IpInfo); ?></td>
    <td>
        <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id.'/update')) { ?>
            <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id.'/update', array('id' => $item->id)); ?>" title="<?php echo Yii::t('app', 'View'); ?>" onclick="loadthis(this, event)">
                <span class="fa fa-eye"></span>
            </a>
        <?php } ?>
        <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id.'/delete')) { ?>
            <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id.'/delete', array('id' => $item->id)); ?>" title="<?php echo Yii::t('app', 'Delete'); ?>" class="delete">
                <span class="fa fa-trash"></span>
            </a>
        <?php } ?>
    </td>
</tr>
<?php } ?>
