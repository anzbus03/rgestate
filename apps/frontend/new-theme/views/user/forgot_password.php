<?php defined('MW_PATH') || exit('No direct script access allowed'); ?>


<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5"> <!-- smaller width for centered layout -->
            <!-- Card Design for Login -->
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4">

                    <!-- Header -->
                    <h4 class="text-center mb-4">
                        <?php echo $this->tag->getTag('forgot_password', 'Forgot Password'); ?>
                    </h4>

                    <!-- Forgot Password Partial -->
                    <div class="mb-4">
                        <?php $this->renderPartial('_forgot_password'); ?>
                    </div>

                    <!-- Link to Sign Up -->
                    <div class="text-center mt-3">
                        <p class="mb-0">
                            <?php echo Yii::t('app', $this->tag->getTag('dont_have_an_account?_{link}', 'Don\'t have an account? {link}'), array(
                                '{link}' => '<a href="' . Yii::App()->createUrl('user/signup') . '" onclick="easyload(this,event,\'pajax\')" class="text-primary fw-semibold">' . $this->tag->getTag('click_here_to_register', 'Click here to register') . '</a>'
                            )); ?>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
