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
                margin-top: 10px;
                margin-bottom: 10px;
                margin-right: 10px;
            }

            /* Style for the add sub-menu button */
            .btn-add-submenu {
                margin-right: 10px;
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
                    <?php foreach ($structuredMenu as $menuItem) { ?>
                        <div class="menu-item" data-id="<?php echo CHtml::encode($menuItem['id']); ?>" data-depth="0">
                            <span class="menu-name"><?php echo CHtml::encode($menuItem['name']); ?></span>
                            <span class="menu-url">URL: <?php echo CHtml::encode($menuItem['url']); ?></span>
                            <div class="menu-actions">
                                <button type="button" class="btn btn-danger btn-remove-menu-item"><?php echo Yii::t('app', 'Remove'); ?></button>
                                <button type="button" class="btn btn-secondary btn-add-submenu"><?php echo Yii::t('app', 'Add Submenu'); ?></button>
                                <button type="button" class="btn btn-primary btn-edit-menu-item"><?php echo Yii::t('app', 'Edit'); ?></button>
                            </div>
                            <div class="submenu">
                                <?php if (!empty($menuItem['submenus'])) { ?>
                                    <?php foreach ($menuItem['submenus'] as $submenuItem) { ?>
                                        <div class="menu-item" data-id="<?php echo CHtml::encode($submenuItem['id']); ?>" data-depth="1">
                                            <span class="menu-name"><?php echo CHtml::encode($submenuItem['name']); ?></span>
                                            <span class="menu-url">URL: <?php echo CHtml::encode($submenuItem['url']); ?></span>
                                            <div class="menu-actions">
                                                <button type="button" class="btn btn-danger btn-remove-menu-item"><?php echo Yii::t('app', 'Remove'); ?></button>
                                                <button type="button" class="btn btn-secondary btn-add-submenu"><?php echo Yii::t('app', 'Add Submenu'); ?></button>
                                                <button type="button" class="btn btn-primary btn-edit-menu-item"><?php echo Yii::t('app', 'Edit'); ?></button>
                                            </div>
                                            <div class="submenu">
                                                <?php if (!empty($submenuItem['submenus'])) { ?>
                                                    <?php foreach ($submenuItem['submenus'] as $subSubmenuItem) { ?>
                                                        <div class="menu-item" data-id="<?php echo CHtml::encode($subSubmenuItem['id']); ?>" data-depth="2">
                                                            <span class="menu-name"><?php echo CHtml::encode($subSubmenuItem['name']); ?></span>
                                                            <span class="menu-url">URL: <?php echo CHtml::encode($subSubmenuItem['url']); ?></span>
                                                            <div class="menu-actions">
                                                                <button type="button" class="btn btn-danger btn-remove-menu-item"><?php echo Yii::t('app', 'Remove'); ?></button>
                                                                <button type="button" class="btn btn-primary btn-edit-menu-item"><?php echo Yii::t('app', 'Edit'); ?></button>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
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

<!-- Submenu Modal -->
<div class="modal fade" id="submenuModal" tabindex="-1" role="dialog" aria-labelledby="submenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="submenuModalLabel"><?php echo Yii::t('app', 'Add Submenu Item'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="submenu-url"><?php echo Yii::t('app', 'URL'); ?></label>
                    <input type="text" class="form-control" id="submenu-url" placeholder="<?php echo Yii::t('app', 'Enter URL'); ?>">
                </div>
                <div class="form-group">
                    <label for="submenu-name"><?php echo Yii::t('app', 'Name'); ?></label>
                    <input type="text" class="form-control" id="submenu-name" placeholder="<?php echo Yii::t('app', 'Enter Name'); ?>">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo Yii::t('app', 'Close'); ?></button>
                <button type="button" id="saveSubmenu" class="btn btn-primary"><?php echo Yii::t('app', 'Save'); ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Menu Item Modal -->
<div class="modal fade" id="editMenuItemModal" tabindex="-1" role="dialog" aria-labelledby="editMenuItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMenuItemModalLabel"><?php echo Yii::t('app', 'Edit Menu Item'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="edit-menu-name"><?php echo Yii::t('app', 'Name'); ?></label>
                    <input type="text" class="form-control" id="edit-menu-name" placeholder="<?php echo Yii::t('app', 'Enter Name'); ?>">
                </div>
                <div class="form-group">
                    <label for="edit-menu-url"><?php echo Yii::t('app', 'URL'); ?></label>
                    <input type="text" class="form-control" id="edit-menu-url" placeholder="<?php echo Yii::t('app', 'Enter URL'); ?>">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo Yii::t('app', 'Close'); ?></button>
                <button type="button" id="saveEditMenuItem" class="btn btn-primary"><?php echo Yii::t('app', 'Save'); ?></button>
            </div>
        </div>
    </div>
</div>


<!-- Scritp code  -->
<script>
$(document).ready(function() {
    var parentMenuItem;  // Variable to store the parent menu item
    var currentMenuItem; // Variable to store the current menu item being edited

    // Function to generate a random ID
    function generateRandomId() {
        return Math.random().toString(36).substr(2, 9); 
    }

    // Function to get the depth of a menu item
    function getMenuDepth(menuItem) {
        var depth = 0;
        while (menuItem.length) {
            menuItem = menuItem.closest('.submenu').closest('.menu-item');
            depth++;
        }
        return depth;
    }

    // Add Menu Item
    $('.btn-add-menu-item').on('click', function() {
        var url = $('#<?php echo CHtml::activeId($commonModel, 'url'); ?>').val();
        var name = $('#<?php echo CHtml::activeId($commonModel, 'name'); ?>').val();
        var randomId = generateRandomId();

        if (url && name) {
            var menuItemHtml = '<div class="menu-item" data-id="' + randomId + '">'
                + '<span class="menu-name">' + name + '</span>'
                + '<span class="menu-url">URL: ' + url + '</span>'
                + '<div class="menu-actions">'
                + '<button type="button" class="btn btn-danger btn-remove-menu-item"><?php echo Yii::t('app', 'Remove'); ?></button>'
                + '<button type="button" class="btn btn-secondary btn-add-submenu"><?php echo Yii::t('app', 'Add Submenu'); ?></button>'
                + '<button type="button" class="btn btn-primary btn-edit-menu-item"><?php echo Yii::t('app', 'Edit'); ?></button>'
                + '</div>'
                + '<div class="submenu"></div>'
                + '</div>';
            $('#menu-structure').append(menuItemHtml);
        }
    });

    // Open modal when "Add Submenu" is clicked
    $('#menu-structure').on('click', '.btn-add-submenu', function() {
        parentMenuItem = $(this).closest('.menu-item'); // Store the parent menu item
        var depth = getMenuDepth(parentMenuItem);

        if (depth < 4) {
            $('#submenuModal').modal('show'); // Show the modal
        } else {
            alert('You can only add submenus up to four layers deep.');
        }
    });

    // Handle Save Submenu click
    $('#saveSubmenu').on('click', function() {
        var url = $('#submenu-url').val();
        var name = $('#submenu-name').val();
        var randomId = generateRandomId();

        if (url && name) {
            var submenuHtml = '<div class="menu-item" data-id="' + randomId + '">'
                + '<span class="menu-name">' + name + '</span>'
                + '<span class="menu-url">URL: ' + url + '</span>'
                + '<div class="menu-actions">'
                + '<button type="button" class="btn btn-danger btn-remove-menu-item"><?php echo Yii::t('app', 'Remove'); ?></button>'
                + '<button type="button" class="btn btn-secondary btn-add-submenu"><?php echo Yii::t('app', 'Add Submenu'); ?></button>'
                + '<button type="button" class="btn btn-primary btn-edit-menu-item"><?php echo Yii::t('app', 'Edit'); ?></button>'
                + '</div>'
                + '<div class="submenu"></div>'
                + '</div>';

            parentMenuItem.find('.submenu').first().append(submenuHtml);
            $('#submenuModal').modal('hide'); // Hide the modal
            $('#submenu-url').val('');  // Clear the input fields
            $('#submenu-name').val('');

            // Check the depth of the newly added submenu and hide the 'Add Submenu' button if depth is 3
            var newSubmenuItem = parentMenuItem.find('.submenu .menu-item').last();
            var newDepth = getMenuDepth(newSubmenuItem);
            if (newDepth == 3) {
                newSubmenuItem.find('.btn-add-submenu').hide();
            }
        }
    });

    // Open modal when "Edit" is clicked
    $('#menu-structure').on('click', '.btn-edit-menu-item', function() {
        currentMenuItem = $(this).closest('.menu-item'); // Store the current menu item being edited
        var currentName = currentMenuItem.find('.menu-name').first().text().trim();
        var currentUrl = currentMenuItem.find('.menu-url').first().text().replace('URL: ', '').trim();

        // Populate the modal with the current values
        $('#edit-menu-name').val(currentName);
        $('#edit-menu-url').val(currentUrl);
        $('#editMenuItemModal').modal('show'); // Show the modal
    });

    // Handle Save Edit Menu Item click
    $('#saveEditMenuItem').on('click', function() {
        var newName = $('#edit-menu-name').val();
        var newUrl = $('#edit-menu-url').val();

        if (newName && newUrl) {
            currentMenuItem.find('.menu-name').first().text(newName);
            currentMenuItem.find('.menu-url').first().text('URL: ' + newUrl);
            $('#editMenuItemModal').modal('hide'); // Hide the modal
        }
    });

    // Function to remove a menu item
    $('#menu-structure').on('click', '.btn-remove-menu-item', function() {
        $(this).closest('.menu-item').remove();
    });

    // Function to collect menu data
    function collectMenuData() {
        var menus = [];

        // Loop through each main menu item
        $('#menu-structure > .menu-item').each(function() {
            // Collect the main menu data
            var menu = {
                id: $(this).data('id'), 
                name: $(this).children('.menu-name').first().text().trim(),
                url: $(this).children('.menu-url').first().text().replace('URL: ', '').trim(),
                submenus: []
            };

            // Loop through each submenu within the current main menu item
            $(this).children('.submenu').children('.menu-item').each(function() {
                var submenu = {
                    id: $(this).data('id'), 
                    name: $(this).children('.menu-name').first().text().trim(),
                    url: $(this).children('.menu-url').first().text().replace('URL: ', '').trim(),
                    submenus: []
                };

                // Loop through each sub-submenu within the current submenu item
                $(this).children('.submenu').children('.menu-item').each(function() {
                    var subSubmenu = {
                        id: $(this).data('id'), 
                        name: $(this).children('.menu-name').first().text().trim(),
                        url: $(this).children('.menu-url').first().text().replace('URL: ', '').trim()
                    };
                    submenu.submenus.push(subSubmenu);
                });

                menu.submenus.push(submenu);
            });

            menus.push(menu);
        });

        console.log(menus);
        return menus;
    }
      // Inline edit menu item
    //   $('#menu-structure').on('click', '.btn-edit-menu-item', function() {
    //     var menuItem = $(this).closest('.menu-item');
    //     menuItem.find('span[class^="menu-name"]').hide();
    //     menuItem.find('span[class^="menu-url"]').hide();
    //    menuItem.find('input[class^="edit-menu-name"]').show();
    //    menuItem.find('input[class^="edit-menu-url"]').show();
    //    $(this).hide();
    //     menuItem.find('.btn-save-menu-item').show();
    // });

    // Save edited menu item
    // $('#menu-structure').on('click', '.btn-save-menu-item', function() {
    //     var menuItem = $(this).closest('.menu-item');
    //     var newName = menuItem.find('input[class^="edit-menu-name"]').val();
    //     var newUrl = menuItem.find('input[class^="edit-menu-url"]').val();

    //     menuItem.find('span[class^="menu-name"]').text(newName).show();
    //     menuItem.find('span[class^="menu-url"]').text('URL: ' + newUrl).show();
    //     menuItem.find('input[class^="edit-menu-name"]').hide();
    //     menuItem.find('input[class^="edit-menu-url"]').hide();
    //     menuItem.find('.btn-save-menu-item').hide();
    //     menuItem.find('.btn-edit-menu-item').show();
    // });

    // $('#menu-structure').sortable({
    //     placeholder: "ui-state-highlight",
    //     update: function(event, ui) {
    //         // You can handle the updated order here if needed
    //         console.log('Menu order updated');
    //     }
    // });

    // Ensure submenus are sortable as well
    // $('.submenu').sortable({
    //     connectWith: '.submenu',
    //     placeholder: "ui-state-highlight",
    //     update: function(event, ui) {
    //         console.log('Submenu order updated');
    //     }
    // });

   // Handle form submission
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
                window.location.reload();
            },
            error: function() {
                // Handle error
            }
        });
    });

});
</script>
