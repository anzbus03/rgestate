<script src="<?= $checkoutJSUrl ?>"
        data-error="errorCallback"
        data-cancel="cancelCallback"
        data-beforeRedirect="beforeRedirect"
        data-afterRedirect="afterRedirect"
        data-complete="completeCallback">
</script>
<style>body{ display:none !important; }</style>
<script>
	    var merchantId = '<?echo $merchantId; ?>';
		var	 sessionId  = '<?echo $sessionId; ?>';
		var	 sessionVersion = '<?echo $sessionVersion; ?>';
		var	 successIndicator= '<?echo $successIndicator; ?>';
		var	 orderId = '<?echo $orderId; ?>';
		var	 resultIndicator;
	 
		var	 currency = '<?echo $currency; ?>';
		var	 total = '<?echo $amount; ?>';
		
		var	 cancelU = 	 '<?php echo $cancelUrl;?>' ;

    // This method preserves the current state of successIndicator and orderId, so they're not overwritten when we return to this page after redirect
    function beforeRedirect() {
        return {
            successIndicator: successIndicator,
            orderId: orderId,
            sessionId: sessionId,
            sessionVersion: sessionVersion,
            merchantId: merchantId
        };
    }

    // This method is specifically for the full payment page option. Because we leave this page and return to it, we need to preserve the
    // state of successIndicator and orderId using the beforeRedirect/afterRedirect option
    function afterRedirect(data) {
        // Compare with the resultIndicator saved in the completeCallback() method
        if (resultIndicator) {
            var result = (resultIndicator === data.successIndicator) ? "SUCCESS" : "ERROR";
           // window.location.href = "/hostedCheckout/" + data.orderId + "/" + result;
           $('#processor').removeClass('hide');
           if(result=="SUCCESS"){ 
               alert('Update Payment Status')
           }
        }
        else {
            successIndicator = data.successIndicator;
            orderId = data.orderId;
            sessionId = data.sessionId;
            sessionVersion = data.sessionVersion;
            merchantId = data.merchantId;

            window.location.href = cancelU   ;
        }

//        var result = (resultIndicator === data.successIndicator)   ? "SUCCESS" : "ERROR";
//        window.location.href = "/hostedCheckout/" + data.orderId + "/" + result;
    }

    function errorCallback(error) {
        console.log(JSON.stringify(error));
    }
    function cancelCallback() {
        console.log('Payment cancelled');
        // Reload the page to generate a new session ID - the old one is out of date as soon as the lightbox is invoked
        window.location.reload(true);
    }

    // This handles the response from Hosted Checkout and redirects to the appropriate endpoint
    function completeCallback(response) {
        // Save the resultIndicator
        resultIndicator = response;
        var result = (resultIndicator === successIndicator) ? "SUCCESS" : "ERROR";
        $('#processor').removeClass('hide');
        if(result=="SUCCESS"){
            alert('update_payment2');
      
        }
         
    }

    function randomId() {
        var chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", length = 10;
        var result = '';
        for (var i = length; i > 0; --i) result += chars[Math.round(Math.random() * (chars.length - 1))];
        return result;
    }
jQuery(document).ready(function($){
         Checkout.configure({
        merchant: merchantId,
        order: {
            amount: function () {
                return total;
            },
            currency: currency ,
            description: orderId ,
            id: orderId
        },
        session: {
            id: sessionId,
            version: sessionVersion
        },
        interaction: {
            operation: 'PURCHASE',
            merchant: {
                name: 'Arab Avenue',
                address: {
                    line1: 'Riyadh',
                    
                }
            },
          
            
            
        }
    });
    Checkout.showPaymentPage();
})
</script>
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgb(255, 255, 255) none repeat scroll 0% 0%; display: block; shape-rendering: auto;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
<g transform="translate(20 50)">
<circle cx="0" cy="0" r="6" fill="#f27f52">
  <animateTransform attributeName="transform" type="scale" begin="-0.375s" calcMode="spline" keySplines="0.3 0 0.7 1;0.3 0 0.7 1" values="0;1;0" keyTimes="0;0.5;1" dur="1s" repeatCount="indefinite"></animateTransform>
</circle>
</g><g transform="translate(40 50)">
<circle cx="0" cy="0" r="6" fill="#7f7f7f">
  <animateTransform attributeName="transform" type="scale" begin="-0.25s" calcMode="spline" keySplines="0.3 0 0.7 1;0.3 0 0.7 1" values="0;1;0" keyTimes="0;0.5;1" dur="1s" repeatCount="indefinite"></animateTransform>
</circle>
</g><g transform="translate(60 50)">
<circle cx="0" cy="0" r="6" fill="#f27f52">
  <animateTransform attributeName="transform" type="scale" begin="-0.125s" calcMode="spline" keySplines="0.3 0 0.7 1;0.3 0 0.7 1" values="0;1;0" keyTimes="0;0.5;1" dur="1s" repeatCount="indefinite"></animateTransform>
</circle>
</g><g transform="translate(80 50)">
<circle cx="0" cy="0" r="6" fill="#7f7f7f">
  <animateTransform attributeName="transform" type="scale" begin="0s" calcMode="spline" keySplines="0.3 0 0.7 1;0.3 0 0.7 1" values="0;1;0" keyTimes="0;0.5;1" dur="1s" repeatCount="indefinite"></animateTransform>
</circle>
</g>
<!-- [ldio] generated by https://loading.io/ --></svg>
<?php
  //  $this->renderPartial('order_detail', compact('order', 'note', 'transaction')); ?>