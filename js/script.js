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
Drupal.behaviors.my_custom_behavior = {
  attach: function(context, settings) {
    $('#islandora-solr-simple-search-form input.form-text', context).once('my_custom_behavior', function() {
      if ($(this).val() == Drupal.t('')) $(this).val('Search...');
      $(this).focus(function() {
        if ($(this).val() == '') {
          $(this).val(Drupal.t('Search...'));
        }
        else {
          $(this).val(Drupal.t(''));
        }
      });
      $(this).focusout(function() {
        if ($(this).val() == '') {
          $(this).val(Drupal.t('Search...'));
        }
        else {
          $(this).val(Drupal.t(''));
        }
      });
      }
    );
    // Fix the footer position on AJAX callbacks.
    positionFooter();
  }
};

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
  $(document).ready(function () {
      positionFooter();
      $(window).scroll(positionFooter);
      $(window).resize(positionFooter);
      $(window).load(positionFooter);
  });
})(jQuery, Drupal, this, this.document);
