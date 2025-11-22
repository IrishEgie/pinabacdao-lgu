<?php
/**
 * Custom News Gallery Meta Box
 * Adds a custom image uploader to the News post type
 */

// 1. Register the Meta Box
function pinabacdao_register_gallery_metabox() {
    add_meta_box(
        'news_custom_gallery',      // ID
        'News Gallery Images',      // Title
        'pinabacdao_render_gallery_box', // Callback
        'news',                     // Post Type
        'normal',                   // Context
        'high'                      // Priority
    );
}
add_action('add_meta_boxes', 'pinabacdao_register_gallery_metabox');

// 2. Render the HTML content
function pinabacdao_render_gallery_box($post) {
    // Retrieve existing value
    $gallery_ids = get_post_meta($post->ID, '_news_gallery_ids', true);
    
    // Security nonce
    wp_nonce_field('save_news_gallery', 'news_gallery_nonce');
    ?>
    
    <div id="news-gallery-wrapper">
        <div id="gallery-preview-container" style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 15px;">
            <?php if ($gallery_ids) : 
                $ids = explode(',', $gallery_ids);
                foreach ($ids as $id) : 
                    $img = wp_get_attachment_image_src($id, 'thumbnail');
                    if ($img) : ?>
                        <div class="gallery-item" data-id="<?php echo esc_attr($id); ?>" style="position: relative; width: 80px; height: 80px;">
                            <img src="<?php echo esc_url($img[0]); ?>" style="width: 100%; height: 100%; object-fit: cover; border-radius: 4px; border: 1px solid #ccc;">
                            <button type="button" class="remove-image" style="position: absolute; top: -5px; right: -5px; background: red; color: white; border: none; border-radius: 50%; width: 20px; height: 20px; cursor: pointer; line-height: 1;">&times;</button>
                        </div>
            <?php endif; endforeach; endif; ?>
        </div>

        <input type="hidden" name="news_gallery_ids" id="news_gallery_ids" value="<?php echo esc_attr($gallery_ids); ?>">
        
        <button type="button" class="button button-primary" id="upload_gallery_button">Add Images</button>
        <p class="description" style="margin-top: 10px;">Select multiple images to create the swipeable gallery.</p>
    </div>

    <script>
    jQuery(document).ready(function($){
        var frame;
        var $imgContainer = $('#gallery-preview-container');
        var $inputId = $('#news_gallery_ids');

        // OPEN MEDIA FRAME
        $('#upload_gallery_button').on('click', function(e){
            e.preventDefault();
            
            // If the frame already exists, re-open it.
            if (frame) {
                frame.open();
                return;
            }
            
            // Create the frame.
            frame = wp.media({
                title: 'Select Images for Gallery',
                button: { text: 'Add to Gallery' },
                library: { type: 'image' },
                multiple: true  // Set to true to allow multiple files to be selected
            });

            // When an image is selected, run a callback.
            frame.on('select', function(){
                var selection = frame.state().get('selection');
                var ids = $inputId.val() ? $inputId.val().split(',') : [];

                selection.map(function(attachment){
                    attachment = attachment.toJSON();
                    
                    // Avoid duplicates
                    if(ids.indexOf(String(attachment.id)) === -1) {
                        ids.push(attachment.id);
                        
                        // Append preview
                        $imgContainer.append(
                            '<div class="gallery-item" data-id="' + attachment.id + '" style="position: relative; width: 80px; height: 80px;">' +
                            '<img src="' + attachment.sizes.thumbnail.url + '" style="width: 100%; height: 100%; object-fit: cover; border-radius: 4px; border: 1px solid #ccc;">' +
                            '<button type="button" class="remove-image" style="position: absolute; top: -5px; right: -5px; background: red; color: white; border: none; border-radius: 50%; width: 20px; height: 20px; cursor: pointer; line-height: 1;">&times;</button>' +
                            '</div>'
                        );
                    }
                });

                $inputId.val(ids.join(','));
            });

            frame.open();
        });

        // REMOVE IMAGE
        $imgContainer.on('click', '.remove-image', function(){
            var $parent = $(this).parent();
            var idToRemove = String($parent.data('id'));
            var ids = $inputId.val().split(',');
            
            // Filter out the removed ID
            ids = ids.filter(function(id){ return id !== idToRemove; });
            
            $inputId.val(ids.join(','));
            $parent.remove();
        });
        
        // ENABLE SORTING (Simple drag and drop using jQuery UI if available, optional)
        if($.fn.sortable) {
            $imgContainer.sortable({
                update: function() {
                    var newIds = [];
                    $('.gallery-item').each(function(){
                        newIds.push($(this).data('id'));
                    });
                    $inputId.val(newIds.join(','));
                }
            });
        }
    });
    </script>
    <?php
}

// 3. Save the Data
function pinabacdao_save_gallery_meta($post_id) {
    // Check nonce
    if (!isset($_POST['news_gallery_nonce']) || !wp_verify_nonce($_POST['news_gallery_nonce'], 'save_news_gallery')) {
        return;
    }
    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    // Check permissions
    if (!current_user_can('edit_post', $post_id)) return;

    // SAVE
    if (isset($_POST['news_gallery_ids'])) {
        update_post_meta($post_id, '_news_gallery_ids', sanitize_text_field($_POST['news_gallery_ids']));
    } else {
        delete_post_meta($post_id, '_news_gallery_ids');
    }
}
add_action('save_post', 'pinabacdao_save_gallery_meta');