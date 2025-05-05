/**
 * SanalPosPRO Payment Gateway checkout script
 * Handles the payment iframe and communication with the payment provider
 */
(function($) {
    $(document).ready(function() {
        if (typeof $ === 'undefined') {
            console.error('jQuery is not loaded');
            return;
        }
        
        $('form.checkout').on('checkout_place_order_success', function(event, response) {
            if (response.iframe_html) {
                $('body').append(response.iframe_html);
                
                // Add loading indicator
                $('.sppro-loading').show();
                
                // Handle iframe messages
                window.addEventListener("message", function (event) {
                    if ((event.origin === "https://pay.paythor.com")) {
                        console.log("Payment response:", event.data);
                        
                        if (event.data.isSuccess) {
                            
                            $('.sppro-close-iframe').hide();
                           
                            window.location.href = response.redirect_url + "&p_id=" + encodeURIComponent(event.data.processID);
                        } else if (event.data.error) {
                            
                            $('.sppro-iframe-content').append('<div class="sppro-error-message">' + event.data.error + '</div>');
                        }
                    }
                }, false);
                
                return false;
            }
            return true;
        });
    });
})(jQuery);