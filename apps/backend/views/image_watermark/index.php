
<?php if (Yii::app()->user->hasFlash('success')): ?>
    <div class="alert alert-success">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>

<div class="row">
    <!-- Form Section -->
    <div class="col-md-6">
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                <h5 class="card-title">Watermark Settings</h5>
            </div>
            <div class="">
                <div class="card-body">
                    <?php echo CHtml::beginForm('', 'post', ['enctype' => 'multipart/form-data']); ?>

                    <div class="mb-3">
                        <label for="opacity" class="form-label">Opacity (0-100)</label>
                        <?php echo CHtml::numberField('ImageWatermark[opacity]', $model->opacity, ['class' => 'form-control', 'id' => 'opacity']); ?>
                    </div>

                    <div class="mb-3">
                        <label for="pos_x" class="form-label">Position X</label>
                        <?php echo CHtml::numberField('ImageWatermark[position_x]', $model->position_x, ['class' => 'form-control', 'id' => 'pos_x']); ?>
                    </div>

                    <div class="mb-3">
                        <label for="pos_y" class="form-label">Position Y</label>
                        <?php echo CHtml::numberField('ImageWatermark[position_y]', $model->position_y, ['class' => 'form-control', 'id' => 'pos_y']); ?>
                    </div>

                    <div class="mb-3">
                        <label for="wm_width" class="form-label">Watermark Width (pixels)</label>
                        <?php echo CHtml::numberField('ImageWatermark[watermark_width]', $model->watermark_width, ['class' => 'form-control', 'id' => 'wm_width']); ?>
                    </div>

                    <div class="mb-3">
                        <label for="wm_height" class="form-label">Watermark Height (pixels)</label>
                        <?php echo CHtml::numberField('ImageWatermark[watermark_height]', $model->watermark_height, ['class' => 'form-control', 'id' => 'wm_height']); ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload Watermark Image (PNG)</label>
                        <?php echo CHtml::fileField('ImageWatermark[watermark_image]', null, ['class' => 'form-control']); ?>
                        <?php if ($model->watermark_image): ?>
                            <input type="hidden" name="ImageWatermark[existing_watermark]" value="<?php echo $model->watermark_image; ?>">
                            <div class="mt-2">
                                <img src="<?php echo '/uploads/files/' . $model->watermark_image; ?>" id="preview_watermark" width="200" class="img-thumbnail">
                            </div>
                        <?php endif; ?>
                    </div>

                    <div>
                        <?php echo CHtml::submitButton('Save Settings', ['class' => 'btn btn-primary']); ?>
                    </div>

                    <?php echo CHtml::endForm(); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Preview Section -->
    <div class="col-md-6">
        <div class="card shadow-sm mb-4">
            <div class="card-body d-flex justify-content-center align-items-center" style="min-height: 500px; background-color: #f8f9fa;">
                <canvas id="previewCanvas" class="w-100 border border-secondary border-dashed"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Preview Script -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const canvas = document.getElementById("previewCanvas");
    const ctx = canvas.getContext("2d");

    const watermark = new Image();
    watermark.src = "<?php echo $model->watermark_image ? '/uploads/files/' . $model->watermark_image : ''; ?>";

    watermark.onload = function () {
        drawPreview();
    };

    function drawPreview() {
        const opacity = parseFloat(document.getElementById("opacity").value) || 50;
        const x = parseInt(document.getElementById("pos_x").value) || 10;
        const y = parseInt(document.getElementById("pos_y").value) || 10;
        const wmWidth = parseInt(document.getElementById("wm_width").value) || 100;
        const wmHeight = parseInt(document.getElementById("wm_height").value) || 50;

        // Set fixed canvas size
        canvas.width = 800;
        canvas.height = 600;

        // Fill background with solid color
        ctx.fillStyle = "#e0e0e0"; // light gray or change to any color
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        // Draw watermark with opacity
        ctx.globalAlpha = opacity / 100;
        ctx.drawImage(watermark, x, y, wmWidth, wmHeight);
        ctx.globalAlpha = 1;
    }

    ["opacity", "pos_x", "pos_y", "wm_width", "wm_height"].forEach(id => {
        document.getElementById(id).addEventListener("input", drawPreview);
    });
});
</script>

