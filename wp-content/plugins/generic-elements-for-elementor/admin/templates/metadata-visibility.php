<?php do_action( 'generic_el_metadata_tab_content_before', $id ); ?>
<div id="generic-el-metadata-source-wrap" class="visibility section">
    <div id="generic-el-display_tab" class="generic-el-metatab-content active">
        <div id="generic-el-meta-section-image" class="generic-el-meta-section generic-el-image" style="">
            <h2 class="generic-el-meta-section-title">Template Visibility</h2>
        </div>
        <!-- Tab Content !-->
        <table class="optiontable form-table">
            <tbody>
            <?php 

            foreach ($tab['fields'] as $name => ${$id} ) {
                switch( ${$id}['type'] ) {
                    case 'radio' :
                        print \Generic\Elements\MetaFields::set_radio_meta_field($name, ${$id});
                        break;
                    case 'checkbox' :
                        \Generic\Elements\MetaFields::set_checkbox_meta_field($name, ${$id});
                        break;
                    case 'select' :
                        \Generic\Elements\MetaFields::set_select_meta_field($name, ${$id});
                        break;
                    case 'text' :
                        \Generic\Elements\MetaFields::set_text_meta_field($name, ${$id});
                        break;
                    case 'textarea' :
                        \Generic\Elements\MetaFields::set_textarea_meta_field($name, ${$id});
                        break;
                    case 'message' :
                        \Generic\Elements\MetaFields::set_message_meta_field($name, ${$id});
                        break;
                    case 'file' :
                        \Generic\Elements\MetaFields::set_file_meta_field($name, ${$id});
                        break;
                }
            } ?>
            </tbody>
        </table>

    </div>

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