/**
 * @file
 * Javascript file for WRLC Theme more and lessing.
 */
(function ($) {
    // Adds more/less toggle functionality.
    Drupal.behaviors.wrlcMoreToggle = {
        attach: function(context, settings) {
            // show more
            if (!$(".wrlc-show-more").hasClass('processed')) {
                $(".wrlc-show-more").click(function(e) {
                    // toggle class .hidden
                    $(".wrlc-short-description, .wrlc-full-description").toggleClass('wrlc-hidden');
                    if ($(this).text() == Drupal.t('[more]')) {
                        $(this).text(Drupal.t('[less]'));
                    }
                    else {
                        $(this).text(Drupal.t('[more]'));
                    }
                    e.preventDefault();
                });
                $(".wrlc-show-more").addClass('processed');
            }
        }
    }
 })(jQuery);
