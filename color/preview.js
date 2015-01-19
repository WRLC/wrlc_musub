/*global Drupal, jQuery*/
(function($) {
    'use strict';
    Drupal.color = {
        logoChanged: false,
        callback: function(context, settings, form, farb, height, width) {
            // Change the logo to be the real one.
            if (!this.logoChanged) {
                $('#preview #preview-logo img').attr('src', Drupal.settings.color.logo);
                this.logoChanged = true;
            }
            // Remove the logo if the setting is toggled off.
            if (Drupal.settings.color.logo === null) {
                $('div').remove('#preview-logo');
            }
            // HTML background.
            $('#preview', form).css('background-color', $('#palette input[name="palette[html]"]', form).val());

            // Solid background.
            $('#preview-main', form).css('background-color', $('#palette input[name="palette[bg]"]', form).val());

            // Text preview.
            $('#preview #preview-main h2, #preview .preview-content', form).css('color', $('#palette input[name="palette[text]"]', form).val());
            $('#preview #preview-content a', form).hover(function() {
                $(this).css('color', $('#palette input[name="palette[linkalt]"]', form).val());
            }, function() {
                $(this).css('color', $('#palette input[name="palette[link]"]', form).val());
            });
        }
    };
}(jQuery));
