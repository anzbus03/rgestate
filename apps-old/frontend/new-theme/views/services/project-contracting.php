    <!-- Start RG Estate Hero -->
    <section class="rg-page-header">
        <div class="container">
            <div class="rg-page-header-bg rg-project-constracting position-relative overflow-hidden">
                <div class="rg-page-header-content position-relative d-flex flex-column justify-content-center z-1">
                    <h1 class="rg-fs-40 rg-fw-600 text-white"><?php echo $this->tag->getTag('project_contracting_dubai', 'Project Contracting in Dubai'); ?></h1>
                    <p class="rg-fs-16 mt-4 rg-text-gray-300">
                    <?php echo $this->tag->getTag('project_contracting_partner', 'Partner with RGEstate by Riveria Global Group for Tailored Project Contracting Solutions in Dubai and Flawless Project Execution.'); ?>    </p>
                    <div class="rg-breadcrumb mt-4">
                        <nav>
                            <ol class="breadcrumb rg-fs-16 rg-fw-400 mb-0">
                                <li class="breadcrumb-item"><a href="#"><?php echo $this->tag->getTag('home', 'Home'); ?></a></li>
                                <li class="breadcrumb-item active"><?php echo $this->tag->getTag('project_contracting', 'Project Contracting'); ?> </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End RG Estate Hero -->

    <!-- Start RG Estate History -->
    <section class="rg-history rg-mt-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="rg-static-header position-relative d-flex flex-column justify-content-center">
                        <h2 class="rg-fs-40 rg-fs-sm-26 rg-fs-sm-26 rg-fw-700 rg-text-blue">
                        <?php echo $this->tag->getTag('project_contracting_success', 'Your Path to Success'); ?>    </h2>
                        <p class="rg-fs-18 rg-fw-400 rg-text-gray-800 mt-3 rg-w-420">
                        <?php echo $this->tag->getTag('project_contracting_navigating', 'Your Guide in Navigating Dubai\'s Project Contracting Landscape'); ?>     
                        </p>
                    </div>
                    <p class="rg-fs-18 rg-fw-400 rg-text-gray-800">
                    <?php echo $this->tag->getTag('project_contracting_division', 'At RGEstate, a division of Riveria Global Group, we recognize the pivotal role of meticulous project contracting in the dynamic business landscape of Dubai. Our specialized Project Contracting services are designed to offer tailored solutions that empower individuals and businesses to bring their project visions to fruition through seamless execution.'); ?>      </p>
                    <div class="rg-contact-form rg-br-20 d-block d-lg-none">
                        <h2 class="rg-fs-30 rg-fw-700 text-white"><?php echo $this->tag->getTag('contact_us','Contact Us');?></h2>
                        <div id="contact-message2"></div>  
                        <?php
                            $form = $this->beginWidget('CActiveForm', array(
					       'id' =>'signUpForm2',
        					'action'=>Yii::app()->createUrl('site/contact_popup'),
        					'enableAjaxValidation'=>true,
        							'clientOptions' => array(
        							'validateOnSubmit'=>true,
        							'validateOnChange'=>false,
        							'beforeValidate' => 'js:function(form) {
        				     
        						form.find("#bb2").val("Validating");
        						return true;
        					}',
        					'afterValidate' => 'js:function(form, data, hasError) { 
        							if(hasError) {
        							form.find("#bb2").val("SEND INQUIRY");
        							 
        							return false;
        							}
        							else
        							{
        							form.find("#bb2").val("Please Wait..."); 
        				
        							ajaxSubmitHappenlistmort2(form, data, hasError,"'.Yii::app()->createUrl($this->id.'/send').'"); 
        							}
        							}',
        							),
        					));
        					?>
                                <div class="form-group">
                                    <?php echo $form->textField($model, 'name',$model->getHtmlOptions('name',array('class'=>'form-input','placeholder'=>$this->tag->getTag('full_name_*','Full Name *')))); ?>
							    	<?php echo $form->error($model, 'name');?>
                                    
                                </div>
                                <div class="form-group">
                                    <?php echo $form->textField($model, 'email',$model->getHtmlOptions('email',array('class'=>'form-input','placeholder'=>$this->tag->getTag('email_*','Email *')))); ?>
							        <?php echo $form->error($model, 'email');?>
                                </div>
                                <div class="form-group">
                                    <?php echo $form->textField($model, 'phone_false',$model->getHtmlOptions('phone_false',array('id'=>'phone2','class'=>'form-input','placeholder'=>$this->tag->getTag('contact_number_*','Contact Number *')))); ?>
    							    <?php echo $form->error($model, 'phone_false');?>
    							</div>
    							<input type="hidden" name="ContactPopup[type]" value="Retail Investments" >
                                <div class="form-group">
                                    <?php echo $form->textArea($model, 'message',$model->getHtmlOptions('message',array('cols'=>'40','rows'=>'2',
                                    'class'=>'form-input','style'=>'min-height:200px;',
                                    'placeholder'=>$this->tag->getTag('write_your_message','Type your message here')))); ?>
					                <?php echo $form->error($model, 'message');?>
                                    
                                </div>
                                 <input type="submit" id="bb2" class="btn btn-light w-100" value="<?php echo $this->tag->getTag('send','SEND INQUIRY') ?>">
                            <?php $this->endWidget();?>
                    </div>
                    <ul class="rg-static-stats rg-br-10 d-flex flex-column flex-md-row">
                        <li>
                            <span class="rg-fs-50 rg-fw-600 rg-text-blue d-block"><i class="rg-service-counter fst-normal">20</i>+</span>
                            <span class="rg-fs-16 rg-fw-400 rg-text-gray-600 d-block"><?php echo $this->tag->getTag('industry_experience_new','Years of Industry Experience');?></span>
                        </li>
                        <li>
                            <span class="rg-fs-50 rg-fw-600 rg-text-blue d-block"><i class="rg-service-counter fst-normal">50</i>+</span>
                            <span class="rg-fs-16 rg-fw-400 rg-text-gray-600 d-block"><?php echo $this->tag->getTag('working_professionals','Working Professionals');?></span>
                        </li>
                        <li>
                            <span class="rg-fs-50 rg-fw-600 rg-text-blue d-block rg-service-counter"><i class="rg-service-counter fst-normal">100</i>%</span>
                            <span class="rg-fs-16 rg-fw-400 rg-text-gray-600 d-block"><?php echo $this->tag->getTag('satisfied_customers','Satisfied Customers');?></span>
                        </li>
                    </ul>
                    <p class="rg-fs-18 rg-fw-400 rg-text-gray-800"><?php echo $this->tag->getTag('project_contracting_service','Leveraging our deep understanding of the local market and unwavering commitment to excellence, we strive to be your strategic partner in turning your project concepts into successful realities. Uncover how our Project Contracting services can expedite the realization of your projects, enhance operational efficiency, and maximize the potential of your ventures.');?></p>
                </div>
                <div class="col-lg-5">
                    <div class="rg-contact-form-outer d-none d-lg-block">
                        <div class="rg-contact-form rg-br-20">
                            <h2 class="rg-fs-30 rg-fw-700 text-white"><?php echo $this->tag->getTag('contact_us','Contact Us');?></h2>
                            <div id="contact-message3"></div> 
                            <?php
                            $form = $this->beginWidget('CActiveForm', array(
					       'id' =>'signUpForm',
        					'action'=>Yii::app()->createUrl('site/contact_popup'),
        					'enableAjaxValidation'=>true,
        							'clientOptions' => array(
        							'validateOnSubmit'=>true,
        							'validateOnChange'=>false,
        							'beforeValidate' => 'js:function(form) {
        				     
        						form.find("#bb").val("Validating");
        						return true;
        					}',
        					'afterValidate' => 'js:function(form, data, hasError) { 
        							if(hasError) {
        							form.find("#bb").val("SEND INQUIRY");
        							 
        							return false;
        							}
        							else
        							{
        							form.find("#bb").val("Please Wait");  
        				
        							ajaxSubmitHappenlistmort(form, data, hasError,"'.Yii::app()->createUrl($this->id.'/send').'"); 
        							}
        							}',
        							),
        					));
        					?>
                                <div class="form-group">
                                    <?php echo $form->textField($model, 'name',$model->getHtmlOptions('name',array('class'=>'form-input','placeholder'=>$this->tag->getTag('full_name_*','Full Name *')))); ?>
							    	<?php echo $form->error($model, 'name');?>
                                    
                                </div>
                                <div class="form-group">
                                    <?php echo $form->textField($model, 'email',$model->getHtmlOptions('email',array('class'=>'form-input','placeholder'=>$this->tag->getTag('email_*','Email *')))); ?>
							        <?php echo $form->error($model, 'email');?>
                                </div>
                                <div class="form-group">
                                    <?php echo $form->textField($model, 'phone_false',$model->getHtmlOptions('phone_false',array('class'=>'form-input','placeholder'=>$this->tag->getTag('contact_number_*','Contact Number *')))); ?>
    							    <?php echo $form->error($model, 'phone_false');?>
    							</div>
    							<input type="hidden" name="ContactPopup[type]" value="Retail Investments" >
                                <div class="form-group">
                                    <?php echo $form->textArea($model, 'message',$model->getHtmlOptions('message',array('cols'=>'40','rows'=>'2',
                                    'class'=>'form-input','style'=>'min-height:200px;',
                                    'placeholder'=>$this->tag->getTag('write_your_message','Type your message here')))); ?>
					                <?php echo $form->error($model, 'message');?>
                                    
                                </div>
                                <input type="submit" id="bb" class="btn btn-light w-100" value="<?php echo $this->tag->getTag('send','SEND INQUIRY') ?>">
                            <?php $this->endWidget();?>
                        </div>
                    </div>
                </div>
           
            </div>
        </div>
    </section>
    <!-- End RG Estate History -->

    <!-- Start RG Estate Vision -->
    <!--<section class="rg-vision rg-mt-70">-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
    <!--            <div class="col-lg-6">-->
    <!--                <div class="rg-static-header position-relative d-flex flex-column justify-content-center">-->
    <!--                    <h2 class="rg-fs-40 rg-fw-700 rg-text-blue">Transform Your Project Vision with Tailored Contracting Solutions</h2>-->
    <!--                    <p class="rg-fs-18 rg-fw-400 rg-text-gray-800 mt-3 rg-w-286">Initiate Your Project Contracting Journey Today: Schedule a Consultation</p>-->
    <!--                </div>-->
    <!--                <p class="rg-fs-18 rg-fw-400 rg-text-gray-600">We deliver the fine enjoy in the whole thing actual-->
    <!--                    estate. not handiest can we promote franchises, we also provider the ones franchise owners thru-->
    <!--                    business consulting, marketing, schooling and generation across the globe. the entirety we do is-->
    <!--                    focused on supporting our franchisees enhance how they do commercial enterprise and become more-->
    <!--                    worthwhile.</p>-->
    <!--                <a href="#" class="btn btn-primary d-inline-flex align-items-center">-->
    <!--                    <span><?php echo $this->tag->getTag('contact_us', 'Contact Us'); ?></span>-->
    <!--                    <svg width="15" height="11" class="ms-3">-->
    <!--                        <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-next-arrow"></use>-->
    <!--                    </svg>-->
    <!--                </a>-->
    <!--            </div>-->
    <!--            <div class="col-lg-6">-->
    <!--                <img class="d-block w-100 rg-br-20 object-fit-cover" src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/project-contracting-invest-in-your-vision.jpg"-->
    <!--                    alt="Invest in Your Vision">-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!-- End RG Estate Vision -->

    <!-- Start RG Estate Join -->
    <section class="rg-join rg-mt-70 rg-consultation-today">
        <div class="container">
            <div
                class="rg-join-bg position-relative d-flex align-items-center justify-content-center rg-br-10 overflow-hidden">
                <div class="position-relative z-1">
                    <h2 class="rg-fs-28 rg-fw-700 text-white mx-auto text-center">
                    <?php echo $this->tag->getTag('project_contracting_solutions','Transform Your Project Vision with Tailored Contracting Solutions');?>    </h2>
                    <p class="rg-fs-16 rg-sm-fs-14 rg-fw-400 text-white text-center mt-3">
                    <?php echo $this->tag->getTag('project_contracting_initiate','Initiate Your Project Contracting Journey Today: Schedule a Consultation');?>     
                    </p>
                    <ul
                        class="rg-btn-group d-flex flex-column flex-sm-row align-items-center justify-content-center rg-mt-40">
                        <li>
                            <a href="+(971) 55 279 2403" class="btn btn-primary d-inline-flex align-items-center">
                                <svg width="20" height="20" class="rg-fill-white me-2">
                                    <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-phone"></use>
                                </svg>
                                <span>+(971) 55 279 2403</span>
                            </a>
                        </li>
                        <li class="ms-0 ms-sm-4 mt-4 mt-sm-0">
                            <a href="<?php echo Yii::app()->createUrl('contact-us');?>" class="btn btn-outline-light"><?php echo $this->tag->getTag('contact_us', 'Contact Us'); ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End RG Estate Join -->

    <!-- Start EG Estate Key Terms -->
    <!--<section class="rg-key-terms rg-mt-70">-->
    <!--    <div class="container">-->
    <!--        <div class="rg-key-terms-slider">-->
    <!--            <div class="rg-slider-loop">-->
    <!--                <div class="row align-items-end">-->
    <!--                    <div class="col-lg-6">-->
    <!--                        <img class="d-none d-lg-block w-100 object-fit-cover rg-br-16"-->
    <!--                            src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/key-terms.jpg" alt="Key Terms">-->
    <!--                    </div>-->
    <!--                    <div class="col-lg-6">-->
    <!--                        <div class="rg-key-terms-meta">-->
    <!--                            <div-->
    <!--                                class="rg-static-header position-relative d-flex flex-column justify-content-center">-->
    <!--                                <h2 class="rg-fs-40 rg-fw-700 rg-text-blue">Key Terms</h2>-->
    <!--                                <p class="rg-fs-18 rg-fw-400 rg-text-gray-800 mt-3 rg-w-420">Understand the positive-->
    <!--                                    impact that secured funding can have on the quality and success</p>-->
    <!--                            </div>-->
    <!--                            <img class="d-block d-lg-none w-100 object-fit-cover rg-br-16"-->
    <!--                                src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/key-terms.jpg" alt="Key Terms">-->
    <!--                            <div class="rg-key-terms-card position-relative rg-br-16">-->
    <!--                                <h2 class="rg-fs-30 rg-fw-600 text-black">Fueling Growth</h2>-->
    <!--                                <p class="rg-fs-18 rg-mt-30">Ignite exponential growth in your business with our-->
    <!--                                    comprehensive funding solutions, empowering your website design project to reach-->
    <!--                                    new-->
    <!--                                    heights. Our funding resources act as the catalyst that propels your website-->
    <!--                                    design-->
    <!--                                    venture forward, fueling expansion and unlocking untapped potential.</p>-->
    <!--                                <a href="#" class="rg-fs-18 rg-text-blue rg-mt-30 d-inline-block">Learn More</a>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="rg-slider-loop">-->
    <!--                <div class="row align-items-end">-->
    <!--                    <div class="col-lg-6">-->
    <!--                        <img class="d-none d-lg-block w-100 object-fit-cover rg-br-16"-->
    <!--                            src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/key-terms.jpg" alt="Key Terms">-->
    <!--                    </div>-->
    <!--                    <div class="col-lg-6">-->
    <!--                        <div class="rg-key-terms-meta">-->
    <!--                            <div-->
    <!--                                class="rg-static-header position-relative d-flex flex-column justify-content-center">-->
    <!--                                <h2 class="rg-fs-40 rg-fw-700 rg-text-blue">Key Terms</h2>-->
    <!--                                <p class="rg-fs-18 rg-fw-400 rg-text-gray-800 mt-3 rg-w-420">Understand the positive-->
    <!--                                    impact that secured funding can have on the quality and success</p>-->
    <!--                            </div>-->
    <!--                            <img class="d-block d-lg-none w-100 object-fit-cover rg-br-16"-->
    <!--                                src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/key-terms.jpg" alt="Key Terms">-->
    <!--                            <div class="rg-key-terms-card position-relative rg-br-16">-->
    <!--                                <h2 class="rg-fs-30 rg-fw-600 text-black">Fueling Growth</h2>-->
    <!--                                <p class="rg-fs-18 rg-mt-30">Ignite exponential growth in your business with our-->
    <!--                                    comprehensive funding solutions, empowering your website design project to reach-->
    <!--                                    new-->
    <!--                                    heights. Our funding resources act as the catalyst that propels your website-->
    <!--                                    design-->
    <!--                                    venture forward, fueling expansion and unlocking untapped potential.</p>-->
    <!--                                <a href="#" class="rg-fs-18 rg-text-blue rg-mt-30 d-inline-block">Learn More</a>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="rg-slider-loop">-->
    <!--                <div class="row align-items-end">-->
    <!--                    <div class="col-lg-6">-->
    <!--                        <img class="d-none d-lg-block w-100 object-fit-cover rg-br-16"-->
    <!--                            src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/key-terms.jpg" alt="Key Terms">-->
    <!--                    </div>-->
    <!--                    <div class="col-lg-6">-->
    <!--                        <div class="rg-key-terms-meta">-->
    <!--                            <div-->
    <!--                                class="rg-static-header position-relative d-flex flex-column justify-content-center">-->
    <!--                                <h2 class="rg-fs-40 rg-fw-700 rg-text-blue">Key Terms</h2>-->
    <!--                                <p class="rg-fs-18 rg-fw-400 rg-text-gray-800 mt-3 rg-w-420">Understand the positive-->
    <!--                                    impact that secured funding can have on the quality and success</p>-->
    <!--                            </div>-->
    <!--                            <img class="d-block d-lg-none w-100 object-fit-cover rg-br-16"-->
    <!--                                src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/key-terms.jpg" alt="Key Terms">-->
    <!--                            <div class="rg-key-terms-card position-relative rg-br-16">-->
    <!--                                <h2 class="rg-fs-30 rg-fw-600 text-black">Fueling Growth</h2>-->
    <!--                                <p class="rg-fs-18 rg-mt-30">Ignite exponential growth in your business with our-->
    <!--                                    comprehensive funding solutions, empowering your website design project to reach-->
    <!--                                    new-->
    <!--                                    heights. Our funding resources act as the catalyst that propels your website-->
    <!--                                    design-->
    <!--                                    venture forward, fueling expansion and unlocking untapped potential.</p>-->
    <!--                                <a href="#" class="rg-fs-18 rg-text-blue rg-mt-30 d-inline-block">Learn More</a>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!-- End EG Estate Key Terms -->

    <!-- Start RG Estate We Partner -->
    <section class="rg-we-partner rg-frequently-asked">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="rg-we-partner-left">
                        <h2 class="rg-fs-40 rg-fs-sm-24 rg-fw-700 text-black">
                        <?php echo $this->tag->getTag('project_contracting_faqs','Frequently Asked Questions about Project Contracting');?>
                        </h2>
                        <p class="rg-fs-18 tp-bg-gray-600 rg-mt-20">
                        <?php echo $this->tag->getTag('project_contracting_faq_text','Explore common inquiries about our Project Contracting services. For personalized assistance, feel free to reach out to our team.');?></p>
                        <a href="<?php echo Yii::app()->createUrl('contact-us');?>" class="btn btn-primary d-inline-flex align-items-center rg-mt-40">
                            <span><?php echo $this->tag->getTag('contact_us', 'Contact Us'); ?></span>
                            <svg width="15" height="11" class="ms-3">
                                <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-next-arrow"></use>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="rg-accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <?php echo $this->tag->getTag('project_contracting_faq_1','What types of projects benefit from specialized contracting services?');?>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php echo $this->tag->getTag('project_contracting_faq_1_ans','Our Project Contracting services encompass a broad spectrum of projects, ranging from
                                        residential developments to commercial and industrial endeavors. Whether it\'s a luxury
                                        residence or a complex business facility, we\'re equipped to address your contracting needs');?>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <?php echo $this->tag->getTag('project_contracting_faq_2','How long does the typical contracting process take?');?>
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php echo $this->tag->getTag('project_contracting_faq_2_ans','The duration of project contracting can vary based on project intricacy and local regulations. We
                                        prioritize efficiency, aiming for a seamless and timely execution that aligns with your project
                                        goals.');?>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        <?php echo $this->tag->getTag('project_contracting_faq_3','Does the contracting process involve legal considerations?');?>
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php echo $this->tag->getTag('project_contracting_faq_3_ans','Absolutely, legal analysis is an integral component of the contracting process. Our experts
                                        ensure that your project contracts adhere to local laws and regulations, ensuring a compliant
                                        and secure foundation.');?>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFour" aria-expanded="false"
                                        aria-controls="collapseFour">
                                        <?php echo $this->tag->getTag('project_contracting_faq_4','Can startups or small businesses avail of project contracting services?');?>
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php echo $this->tag->getTag('project_contracting_faq_4_ans','Certainly, our services are open to projects of all scales, including startups and small
                                        businesses. Our custom solutions cater to the unique contracting requirements of diverse
                                        enterprises.');?>
                                     
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFive" aria-expanded="false"
                                        aria-controls="collapseFive">
                                        <?php echo $this->tag->getTag('project_contracting_faq_5','How are contracting strategies determined for each project?');?>
                                    </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php echo $this->tag->getTag('project_contracting_faq_5_ans','Contracting strategies are formulated through a meticulous evaluation of project specifics, legal
                                        nuances, and potential risks. This approach ensures that strategies are attuned to your project\'s
                                        objectives and legal landscape.');?>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseSix" aria-expanded="false"
                                        aria-controls="collapseSix">
                                        <?php echo $this->tag->getTag('project_contracting_faq_6','What distinguishes RGEstate\'s contracting services?');?>
                                    </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php echo $this->tag->getTag('project_contracting_faq_6_ans','RGEstate stands out for its legal acumen, transparent communication, and client-centric ethos.
                                        Our tailor-made contracting solutions, combined with an unwavering commitment to excellence,
                                        position us as the preferred choice for successful project execution through seamless
                                        contracting in Dubai.');?>
                                   
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseSeven" aria-expanded="false"
                                        aria-controls="collapseSeven">
                                        <?php echo $this->tag->getTag('project_contracting_faq_7','Is post-contracting support provided?');?>
                                    </button>
                                </h2>
                                <div id="collapseSeven" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php echo $this->tag->getTag('project_contracting_faq_7_ans','Absolutely, our support extends beyond the completion of the contracting process. We provide
                                        ongoing assistance encompassing project evaluation, legal guidance, and ensuring your
                                        project\'s alignment with contracting goals.');?>
                            
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseEight" aria-expanded="false"
                                        aria-controls="collapseEight">
                                        <?php echo $this->tag->getTag('project_contracting_faq_8','How can I initiate the project contracting process with RGEstate?');?>
                                    </button>
                                </h2>
                                <div id="collapseEight" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php echo $this->tag->getTag('project_contracting_faq_8_ans','Initiating the process is simple—reach out to us through our contact channels. We\'ll guide you
                                        through the initial steps, commencing with a consultation to discuss project specifics and
                                        contracting requirements. Together, we\'ll navigate the intricacies of project contracting and pave
                                        the way for the realization of your vision.');?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End RG Estate We Partners -->

    <!-- Start RG Estate Other Services -->
    <!--<section class="rg-services rg-mt-70">-->
    <!--    <div class="container">-->
    <!--        <div class="rg-static-header position-relative d-flex flex-column justify-content-center">-->
    <!--            <h2 class="rg-fs-40 rg-fw-700 rg-text-blue">Our Other Services</h2>-->
    <!--        </div>-->
    <!--        <div class="rg-services-slider">-->
    <!--            <div class="rg-services-loop">-->
    <!--                <div class="rg-service-card text-center">-->
    <!--                    <img class="d-block w-100 object-fit-cover rg-br-10" src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/service-01.jpg"-->
    <!--                        alt="lobal econmice recovery heatmaps report">-->
    <!--                    <h2 class="rg-fs-24 rg-fw-700 rg-text-blue rg-mt-25">Global econmice recovery heatmaps report-->
    <!--                    </h2>-->
    <!--                    <a href="#" class="d-inline-block rg-text-gray-500 rg-fs-14 rg-mt-25">-->
    <!--                        <span>Read More</span>-->
    <!--                        <svg width="15" height="11" class="ms-2 rg-fill-gray-500">-->
    <!--                            <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-next-arrow-gray"></use>-->
    <!--                        </svg>-->
    <!--                    </a>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="rg-services-loop">-->
    <!--                <div class="rg-service-card text-center">-->
    <!--                    <img class="d-block w-100 object-fit-cover rg-br-10" src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/service-02.jpg"-->
    <!--                        alt="Understand the global impact on the real estate sector">-->
    <!--                    <h2 class="rg-fs-24 rg-fw-700 rg-text-blue rg-mt-25">Understand the global impact on the real-->
    <!--                        estate sector</h2>-->
    <!--                    <a href="#" class="d-inline-block rg-text-gray-500 rg-fs-14 rg-mt-25">-->
    <!--                        <span>Read More</span>-->
    <!--                        <svg width="15" height="11" class="ms-2 rg-fill-gray-500">-->
    <!--                            <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-next-arrow-gray"></use>-->
    <!--                        </svg>-->
    <!--                    </a>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="rg-services-loop">-->
    <!--                <div class="rg-service-card text-center">-->
    <!--                    <img class="d-block w-100 object-fit-cover rg-br-10" src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/service-03.jpg" alt="How to declutter and organise -->
    <!--                    your home">-->
    <!--                    <h2 class="rg-fs-24 rg-fw-700 rg-text-blue rg-mt-25">How to declutter and organise your home-->
    <!--                    </h2>-->
    <!--                    <a href="#" class="d-inline-block rg-text-gray-500 rg-fs-14 rg-mt-25">-->
    <!--                        <span>Read More</span>-->
    <!--                        <svg width="15" height="11" class="ms-2 rg-fill-gray-500">-->
    <!--                            <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-next-arrow-gray"></use>-->
    <!--                        </svg>-->
    <!--                    </a>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="rg-services-loop">-->
    <!--                <div class="rg-service-card text-center">-->
    <!--                    <img class="d-block w-100 object-fit-cover rg-br-10" src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/service-01.jpg"-->
    <!--                        alt="">-->
    <!--                    <h2 class="rg-fs-24 rg-fw-700 rg-text-blue rg-mt-25">Global econmice recovery heatmaps report-->
    <!--                    </h2>-->
    <!--                    <a href="#" class="d-inline-block rg-text-gray-500 rg-fs-14 rg-mt-25">-->
    <!--                        <span>Read More</span>-->
    <!--                        <svg width="15" height="11" class="ms-2 rg-fill-gray-500">-->
    <!--                            <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-next-arrow-gray"></use>-->
    <!--                        </svg>-->
    <!--                    </a>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!-- End RG Estate Other Services -->