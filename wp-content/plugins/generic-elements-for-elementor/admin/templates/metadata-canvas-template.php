<?php do_action( 'generic_el_metadata_tab_content_before', $id ); ?>
<div id="generic-el-metadata-source-wrap" class="design section">
    <h2 class="generic-el-meta-section-title">Enable Canvas Template
        <div class="generic-el-section-reset" data-tooltip="Reset"><span class="dashicons dashicons-image-rotate"></span> </div>
    </h2>

    <div>
        <!-- Tab Content !-->
        <table class="optiontable form-table">
            <tbody>
            <tr valign="top" class="background-image">
                <th scope="row">
                    <label><?php esc_html_e( 'Do you want to enable Canvas Template', 'generic-elements' ) ?></label>
                </th>
                <td>
                    <div class="ui grid">
                        <?php foreach ($tab['fields'] as $name => ${$id} ) {
                            switch (${$id}['type']) {
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
                    </div>
                </td>
            </tr>
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