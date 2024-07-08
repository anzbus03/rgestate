<div class="new-navigation">
    <ul>
        <?php foreach ($menuItems as $item): ?>
            <li class="<?php echo isset($item['items']) ? 'has-submenu' : ''; ?>">
                <a href="<?php echo isset($item['route']) ? Yii::app()->createUrl($item['route'][0]) : '#'; ?>">
                    <i class="<?php echo $item['icon']; ?>"></i> <?php echo $item['name']; ?>
                </a>
                <?php if (isset($item['items']) && is_array($item['items'])): ?>
                    <ul class="submenu">
                        <?php foreach ($item['items'] as $subItem): ?>
                            <li>
                                <a href="<?php echo Yii::app()->createUrl($subItem['url'][0]); ?>">
                                    <?php echo $subItem['label']; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>