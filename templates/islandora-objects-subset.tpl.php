<?php

/**
 * @file
 * islandora-basic-collection-wrapper.tpl.php
 *
 * @TODO: needs documentation about file and variables
 */
?>
<div class="islandora-basic-collection-wrapper">
  <div class="islandora-basic-collection clearfix">
    <div class="clearfix">
      <span class="islandora-basic-collection-display-switch">
        <?php
   print theme('links', array(
       'links' => $display_links,
       'attributes' => array('class' => array('links', 'inline')),
     )
   );?>
      </span>
    </div>
    <div class="islandora-basic-collection-wrapper-metadata" style="color: #777; line-height: 1.5; word-wrap: break-word;">
      <?php if ($metadata_found):?>
        <?php if (!(empty($solr_fields) && variable_get('islandora_solr_metadata_omit_empty_values', FALSE))):?>
          <?php foreach ($solr_fields as $value): ?>
            <div class="islandora-basic-collection-wrapper-metadatum">
              <strong><?php print $value['display_label'] . ':'; ?></strong>
              <span><?php print check_markup(implode("\n", $value['value']), 'filtered_html'); ?></span>
            </div>
          <?php endforeach ?>
        <?php endif; ?>
      <?php endif; ?>
      <?php if ($description_found && !empty($descriptions)): ?>
        <div class="islandora-basic-collection-wrapper-metadatum">
              <strong><?php if (count($descriptions) > 1):
                  print (t('Description:'));
                else:
                  $desc_array = reset($descriptions);
                  print ($desc_array['display_label']) . ':'; ?>
                <?php endif; ?></strong>
              <span>
                <?php if (isset($short_description)): ?>
                  <span class="wrlc-short-description">
                    <?php print $short_description; ?>
                  </span>
                <?php endif; ?>
                <span class="wrlc-full-description wrlc-hidden">
                  <?php foreach($descriptions as $value): ?>
                    <?php print check_markup(implode("\n", $value['value']), 'filtered_html'); ?><br/>
                  <?php endforeach; ?>
                </span>
                <?php if (isset($more_link)): ?>
                  <?php print $more_link; ?>
                <?php endif; ?>
              </span>
        </div>
      <?php endif; ?>
    </div>
    <?php print $pager; ?>
    <?php print $content; ?>
    <?php print $pager; ?>
  </div>
</div>
