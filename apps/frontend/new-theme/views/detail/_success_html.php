<style>
   .modal-body {
   
    overflow-x: hidden;
}
</style>
<div class="success-modal" style="    margin: auto;">
      
        <div class="anim" style="background:#fff;height:auto; margin:60px 0px 25px;display: block;;">
            <div class="contaiwerwner22" >
           <img src="data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNDE1Ljg2OSA0MTUuODY5IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA0MTUuODY5IDQxNS44Njk7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgY2xhc3M9IiI+PGc+PGc+Cgk8cGF0aCBzdHlsZT0iZmlsbDojMzRBODUzIiBkPSJNMTI1LjkxLDE3MC44NDFjLTUuNzQ3LTYuMjY5LTE1LjY3My02Ljc5Mi0yMS45NDMtMS4wNDVjLTYuMjY5LDUuNzQ3LTYuNzkyLDE1LjY3My0xLjA0NSwyMS45NDMgICBsNzguODksODUuNjgyYzMuMTM1LDMuMTM1LDYuNzkyLDUuMjI0LDEwLjk3MSw1LjIyNGMwLDAsMCwwLDAuNTIyLDBjNC4xOCwwLDguMzU5LTEuNTY3LDEwLjk3MS00LjcwMkw0MDMuODUzLDc4Ljg5ICAgYzYuMjY5LTYuMjY5LDYuMjY5LTE2LjE5NiwwLTIxLjk0M2MtNi4yNjktNi4yNjktMTYuMTk2LTYuMjY5LTIxLjk0MywwTDE5My44MjksMjQ0LjUwNkwxMjUuOTEsMTcwLjg0MXoiIGRhdGEtb3JpZ2luYWw9IiM0RENGRTAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgZGF0YS1vbGRfY29sb3I9IiM0RENGRTAiPjwvcGF0aD4KCTxwYXRoIHN0eWxlPSJmaWxsOiMzNEE4NTMiIGQ9Ik00MDAuMTk2LDE5Mi4yNjFjLTguODgyLDAtMTUuNjczLDYuNzkyLTE1LjY3MywxNS42NzNjMCw5Ny4xNzUtNzkuNDEyLDE3Ni41ODgtMTc2LjU4OCwxNzYuNTg4ICAgUzMxLjM0NywzMDUuMTEsMzEuMzQ3LDIwNy45MzVTMTEwLjc1OSwzMS4zNDcsMjA3LjkzNSwzMS4zNDdjOC44ODIsMCwxNS42NzMtNi43OTIsMTUuNjczLTE1LjY3M1MyMTYuODE2LDAsMjA3LjkzNSwwICAgQzkzLjUxOCwwLDAsOTMuNTE4LDAsMjA3LjkzNXM5My41MTgsMjA3LjkzNSwyMDcuOTM1LDIwNy45MzVzMjA3LjkzNS05My41MTgsMjA3LjkzNS0yMDcuOTM1ICAgQzQxNS44NjksMTk5LjA1Myw0MDkuMDc4LDE5Mi4yNjEsNDAwLjE5NiwxOTIuMjYxeiIgZGF0YS1vcmlnaW5hbD0iIzREQ0ZFMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzREQ0ZFMCI+PC9wYXRoPgo8L2c+PC9nPiA8L3N2Zz4=" style="width: 50px;">
             <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="info">
        <?php
            // ContactUs
            $contactUs = ContactUs::model()->find(array(
                'order' => 'id DESC', // Replace 'id' with your primary key or timestamp column if different
            ));
            $name = $contactUs ? $contactUs->name : null;
            $email = $contactUs ? $contactUs->email : null;	

        ?>
        <div class="title"><?php echo $this->tag->getTag('thank_you_for_your_submission.', "Thank you {$name} <span class='email'>{$email}</span> for your submission."); ?></div>
        <div class="text"><?php echo $this->tag->getTag('we_will_get_back_to_you_soon.','We will get back to you soon.') ;?></div>
            <button class="continue"  data-dismiss="modal"><?php echo  $this->tag->gettag('continue','Continue') ;?></button>
        </div>
    </div>
 
