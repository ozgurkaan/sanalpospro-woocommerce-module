jQuery(document).ready(function($) {
    // Show popup when button is clicked
    $('#sppro-show-instructions').on('click', function(e) {
        e.preventDefault();
        $('#sppro-popup').css('display', 'flex');
    });
    
    // Close popup when X is clicked
    $('.sppro-popup-close').on('click', function(e) {
        e.preventDefault();
        $('#sppro-popup').css('display', 'none');
    });
    
    // Close popup when clicking outside
    $('#sppro-popup').on('click', function(e) {
        if (e.target === this) {
            $(this).css('display', 'none');
        }
    });
    
    // Close on ESC key
    $(document).keyup(function(e) {
        if (e.key === "Escape") {
            $('#sppro-popup').css('display', 'none');
        }
    });
}); 