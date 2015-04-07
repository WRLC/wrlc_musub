<?php
/**
 * @file
 * Islandora solr search navigation block.
 *
 * Variables available:
 * - $return_link: link to reutrn to original search.
 * - $prev_link: Link to previous object in search result.
 * - $next_link: link to next object in the search result.
 *
 */
?>

<?php if ($prev_link): ?>
  <span id="islandora-solr-search-previous-link"><?php print $prev_link; ?></span>
<?php endif; ?>
<span id="islandora-solr-search-return-link"><?php print $return_link; ?></span>
<?php if ($next_link): ?>
  <span id="islandora-solr-search-next-link"><?php print $next_link; ?></span>
<?php endif; ?>
