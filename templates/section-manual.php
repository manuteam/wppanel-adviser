<?php
/**
 * Template section of manual
 * @since 1.0.0
 */
?>

<div class="admin-manual_wrap">
    <div class="admin-manual_container admin-manual-question">
        <div class="admin-manual_left">
            <div class="admin-manual_icon"><div class="admin-manual_icon-text">?</div></div>
        </div>
        <div class="admin-manual_right">
            <?php if ( isset($manualContent['sections']['title']) ) { ?>
                <div class="admin-manual_title"><?php echo $manualContent['sections']['title'] ?></div>
            <?php } ?>
            <?php if ( isset($manualContent['sections']['description']) ) { ?>
                <div class="admin-manual_content"><?php echo $manualContent['sections']['description'] ?></div>
            <?php } ?>
        </div>
    </div>
</div>
