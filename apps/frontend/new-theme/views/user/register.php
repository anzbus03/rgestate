<?php defined('MW_PATH') || exit('No direct script access allowed'); ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
            <!-- Card Design for Signup -->
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4">

                    <!-- Header Text -->
                    <h4 class="text-center mb-4">
                        <?php echo $this->tag->getTag('create_a_free_account', 'Create a free account'); ?>
                    </h4>

                    <!-- Register Partial -->
                    <div class="mb-4">
                        <?php $this->renderPartial('_register_partial'); ?>
                    </div>

                    <!-- Already a Member? -->
                    <div class="text-center mt-3">
                        <p class="mb-0">
                            <?php echo Yii::t('app', $this->tag->getTag('already_a_member?_{link}', 'Already a member? {link}'), [
                                '{link}' => '<a href="' . Yii::app()->createUrl('user/signin') . '" onclick="easyload(this,event,\'pajax\')" class="text-primary fw-semibold">' . $this->tag->getTag('click_here_to_login.', 'Click here to login.') . '</a>'
                            ]); ?>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
