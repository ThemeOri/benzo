<?php do_action( 'generic_el_metadata_tab_content_before', $id ); ?>
<div id="generic-el-metadata-source-wrap" class="design section">
    <h2 class="generic-el-meta-section-title">Select Template
        <div class="generic-el-section-reset" data-tooltip="Reset"><span class="dashicons dashicons-image-rotate"></span> </div>
    </h2>

</div>
<?php do_action( 'generic_el_metadata_tab_content_after', $id ); ?>
<button class="generic-el-meta-next" data-tab="" data-tabid="">
    <?php if( $totaltabs < $tabid ) {
        _e( 'Publish', 'generic-elements' );
    }
    else {
        _e( 'Next', 'generic-elements' );
    } ?>
</button>