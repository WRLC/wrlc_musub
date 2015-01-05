/**
 * @file
 * A JavaScript file for the theme.
 *
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - https://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
(function ($, Drupal, window, document, undefined) {


// To understand behaviors, see https://drupal.org/node/756722#behaviors
Drupal.behaviors.wrlc_primary_islandora_solr_simple_search_text = {
  attach: function(context, settings) {
    $('#islandora-solr-simple-search-form input.form-text', context).once('wrlc_primary_islandora_solr_simple_search_text', function() {
      // Set an initial default value for the search box
      if ($(this).val() == '') $(this).val(Drupal.t('Search...'));
      // Add focusin handler to clear the search box.
      $(this).focusin(function() {
        if ($(this).val() == Drupal.t('Search...')) {
          $(this).val('');
        }
      });
      // Return search box default if it is empty.
      $(this).focusout(function() {
        if ($(this).val() == '') {
          $(this).val(Drupal.t('Search...'));
        }
      });
      }
    );

    // Sticky footer
    function positionFooter() {
      var mFoo = $("#footer");
      if ((($(document.body).height() + mFoo.outerHeight()) < $(window).height() && mFoo.css("position") == "fixed") || ($(document.body).height() < $(window).height() && mFoo.css("position") != "fixed")) {
        mFoo.css({
          position: "fixed",
          bottom: "0px"
        });
      }
      else {
        mFoo.css({
          position: "static"
        });
      }
    }
    // Fix the footer position on AJAX callbacks.
    positionFooter();

    // Fix footer position on window events.
    $(window).scroll(positionFooter);
    $(window).resize(positionFooter);
    $(window).load(positionFooter);
  }
};
})(jQuery, Drupal, this, this.document);
