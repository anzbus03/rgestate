<?php 
// Begin the form widget
$form = $this->beginWidget('CActiveForm'); 
?>

<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title"><?php echo Yii::t('settings', 'Manage Menu')?></h3>
    </div>
    <div class="box-body">
        <?php 
        $hooks->doAction('before_active_form_fields', new CAttributeCollection(array(
            'controller'    => $this,
            'form'          => $form    
        )));
        ?>
        <style>
            /* Add border and margin to form fields */
            .form-group input {
                border: 1px solid #ccc;
                margin-bottom: 15px;
                padding: 10px;
                border-radius: 4px;
            }

            /* Style for the menu structure container */
            #menu-structure {
                border: 1px solid #ddd;
                padding: 15px;
                border-radius: 4px;
                margin-top: 20px;
            }

            /* Style for each menu item */
            .menu-item {
                border: 1px solid #ddd;
                padding: 10px;
                margin-bottom: 10px;
                border-radius: 4px;
                display: flex;
                flex-direction: column;
                position: relative;
            }

            .menu-item .submenu {
                margin-left: 20px;
                border-left: 1px dashed #ddd;
                padding-left: 10px;
            }

            /* Style for the remove button */
            .btn-remove-menu-item {
                margin-right: 10px;
            }

            /* Style for the add sub-menu button */
            .btn-add-submenu {
                margin-top: 10px;
                margin-bottom: 10px;
            }
        </style>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo $form->labelEx($commonModel, 'url'); ?>
                    <?php echo $form->textField($commonModel, 'url', $commonModel->getHtmlOptions('url')); ?>
                    <?php echo $form->error($commonModel, 'url'); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($commonModel, 'name'); ?>
                    <?php echo $form->textField($commonModel, 'name', $commonModel->getHtmlOptions('name')); ?>
                    <?php echo $form->error($commonModel, 'name'); ?>
                </div>
                <div class="form-group col-md-12">
                    <button type="button" class="btn btn-primary btn-add-menu-item"><?php echo Yii::t('app', 'Add Menu Item'); ?></button>
                </div>
            </div>
            <div class="col-md-8">
                <div id="menu-structure">
                    <!-- Render existing menu items here -->
                    <?php foreach ($menuItems as $menuItem) { ?>
                        <div class="menu-item" data-id="<?php echo CHtml::encode($menuItem['id']); ?>">
                            <span class="menu-name-<?php echo $menuItem->id; ?>"><?php echo CHtml::encode($menuItem['name']); ?></span>
                            <span class="menu-url-<?php echo $menuItem->id; ?>">URL: <?php echo CHtml::encode($menuItem['url']); ?></span>
                            <div class="menu-actions">
                                <button type="button" class="btn btn-danger btn-remove-menu-item"><?php echo Yii::t('app', 'Remove'); ?></button>
                                <button type="button" class="btn btn-secondary btn-add-submenu"><?php echo Yii::t('app', 'Add Submenu'); ?></button>
                            </div>
                        </div>
                        <div class="submenu">
                            <!-- Submenu items will be appended here -->
                            <?php if (isset($menuItem['submenus'])) { ?>
                                <?php foreach ($menuItem['submenus'] as $submenuItem) { ?>
                                    <div class="menu-item" data-id="<?php echo CHtml::encode($submenuItem['id']); ?>">
                                        <span class="menu-name"><?php echo CHtml::encode($submenuItem['name']); ?></span>
                                        <span class="menu-url">URL: <?php echo CHtml::encode($submenuItem['url']); ?></span>
                                        <button type="button" class="btn btn-danger btn-remove-menu-item"><?php echo Yii::t('app', 'Remove'); ?></button>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <?php 
        $hooks->doAction('after_active_form_fields', new CAttributeCollection(array(
            'controller'    => $this,
            'form'          => $form    
        )));
        ?>
        <div class="clearfix"><!-- --></div>
    </div>
    <div class="box-footer">
        <div class="pull-right">
            <button type="submit" id="submitForm" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>">
                <?php echo Yii::t('app', 'Save Changes');?>
            </button>
        </div>
        <div class="clearfix"><!-- --></div>
    </div>
</div>

<?php 
$this->endWidget(); 
?>

<script>
$(document).ready(function() {
    // Function to add a menu item
    function generateRandomId() {
        return Math.random().toString(36).substr(2, 9); // Generate a random alphanumeric string
    }

    // Function to add a menu item
    $('.btn-add-menu-item').on('click', function() {
        var url = $('#<?php echo CHtml::activeId($commonModel, 'url'); ?>').val();
        var name = $('#<?php echo CHtml::activeId($commonModel, 'name'); ?>').val();
        var randomId = generateRandomId();

        if (url && name) {
            var menuItemHtml = '<div class="menu-item" data-id="' + randomId + '">'
                + '<span class="menu-name-'+ randomId +'">' + name + '</span>'
                + '<span class="menu-url-' + randomId + '">URL: ' + url + '</span>'
                + '<div class="menu-actions">'
                + '<button type="button" class="btn btn-danger btn-remove-menu-item"><?php echo Yii::t('app', 'Remove'); ?></button>'
                + '<button type="button" class="btn btn-secondary btn-add-submenu"><?php echo Yii::t('app', 'Add Submenu'); ?></button>'
                + '</div>'
                + '<div class="submenu"></div>'
                + '</div>';
            $('#menu-structure').append(menuItemHtml);
        }
    });

    // Function to add a sub-menu item
    $('#menu-structure').on('click', '.btn-add-submenu', function() {
        var parentMenuItem = $(this).closest('.menu-item');
        var url = prompt('Enter URL for sub-menu item:');
        var name = prompt('Enter Name for sub-menu item:');
        var randomId = generateRandomId();

        if (url && name) {
            var submenuHtml = '<div class="menu-item" data-id="' + randomId + '">'
                + '<span class="menu-name">' + name + '</span>'
                + '<span class="menu-url">URL: ' + url + '</span>'
                + '<div class="menu-actions">'
                + '<button type="button" class="btn btn-danger btn-remove-menu-item"><?php echo Yii::t('app', 'Remove'); ?></button>'
                + '</div>'
                + '</div>';
            parentMenuItem.find('.submenu').append(submenuHtml);
        }
    });

    // Function to remove a menu item
    $('#menu-structure').on('click', '.btn-remove-menu-item', function() {
        $(this).closest('.menu-item').remove();
    });
    function collectMenuData() {
        var menus = [];

        // Loop through each main menu item
        $('#menu-structure .menu-item').each(function() {
            // Collect the main menu data
            if ($(this).find('.menu-name-'+$(this).data('id')).text().trim() != ""){
                var menu = {
                    id: $(this).data('id'),  // Use empty string if id is not present
                    name: $(this).find('.menu-name-'+$(this).data('id')).text().trim(),
                    url: $(this).find('.menu-url-'+$(this).data('id')).text().replace('URL: ', '').trim(),
                    submenus: []
                };
    
                // Loop through each submenu within the current main menu item
                $(this).find('.submenu .menu-item').each(function() {
                    var submenu = {
                        id: $(this).data('id'),  // Use empty string if id is not present
                        name: $(this).find('.menu-name').text().trim(),
                        url: $(this).find('.menu-url').text().replace('URL: ', '').trim()
                    };
                    menu.submenus.push(submenu);
                });
                menus.push(menu);
            }
        });

        console.log(menus);
        return menus;
    }

    $('#submitForm').click(function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo Yii::app()->createUrl($this->route); ?>',
            type: 'POST',
            data: {
                menus: collectMenuData(),
                csrf_token: "<?php echo Yii::app()->request->csrfToken; ?>"
            },
            success: function(response) {
                window.location.reload()
            },
            error: function() {
                // Handle error
            }
        });
    });
});
</script>
