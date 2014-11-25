<?php
/**
 * @file
 * Returns HTML for a region.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728112
 */
?>
<?php if ($content): ?>
  <div class="<?php print $classes; ?>">

    <div id="pre_header_account_wrapper">
    <?php
      if ($user->uid > 0) {
        print l(t('Logout'), 'user/logout');
      }
      else {
        print l(t('Login'), 'user');
      }
    ?>
    <i class="fontawsome-chevron fa fa-angle-double-right"></i>
    </div>
    <div class="pre-header-block-wrapper">
    <?php print $content; ?>
    </div>
  </div>
<?php endif; ?>
