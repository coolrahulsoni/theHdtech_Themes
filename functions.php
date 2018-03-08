<?php add_theme_support( 'post-thumbnails' ); 


function meta_og() {
	global $post;
	if ( is_single() ) {
		if( has_post_thumbnail( $post->ID ) ) {
			$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
		} 
		$excerpt = strip_tags($post->post_content);
		$excerpt_more = '';
		if ( strlen($excerpt ) > 155) {
			$excerpt = substr($excerpt,0,155);
			$excerpt_more = ' ...';
		}
		$excerpt = str_replace( '"', '', $excerpt );
		$excerpt = str_replace( "'", '', $excerpt );
		$excerptwords = preg_split( '/[\n\r\t ]+/', $excerpt, -1, PREG_SPLIT_NO_EMPTY );
		array_pop( $excerptwords );
		$excerpt = implode( ' ', $excerptwords ) . $excerpt_more;
		?>
<meta name="author" content="Your Name">
<meta name="description" content="<?php echo $excerpt; ?>">
<meta property="og:title" content="<?php echo the_title(); ?>">
<meta property="og:description" content="<?php echo $excerpt; ?>">
<meta property="og:type" content="article">
<meta property="og:url" content="<?php echo the_permalink(); ?>">
<meta property="og:site_name" content="Your Site Name">
<meta property="og:image" content="<?php echo $img_src[0]; ?>">
<?php
	} else {
			return;
	}
}
add_action('wp_head', 'meta_og', 5);




function coolRahulSoni_function() {
	//code
	add_theme_support( 'title-tag' );
	}
add_action( 'after_setup_theme', 'coolRahulSoni_function');

 

function coolRahulSoni_scripts() {

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css', array(), '3.3.6' );
	wp_enqueue_style( 'blog', get_template_directory_uri() . '/css/blog.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );
	$dependencies = array('jquery');
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', $dependencies, '3.3.6', true );
}

add_action( 'wp_enqueue_scripts', 'coolRahulSoni_scripts' );

function coolRahulSoni_google_fonts() {
				wp_register_style('WorkSans', 'https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,700');
				wp_register_style('Josefin', 'https://fonts.googleapis.com/css?family=Josefin+Sans:300,400,400i,600,700');
				wp_register_style('OpenSans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800');
				wp_register_style('DroidSansMono', 'https://fonts.googleapis.com/css?family=Droid+Sans+Monos');
				wp_register_style('Roboto', 'https://fonts.googleapis.com/css?family=Roboto:300i,400,500,500i,700,700i,900,900i');
				wp_register_style('New', 'https://fonts.googleapis.com/css?family=Asul|Concert+One|Eczar:400,500,600,700|Fruktur|Kavoon|Neuton|Space+Mono|Tillana|Work+Sans');
				
				wp_enqueue_style( 'Roboto');
				wp_enqueue_style( 'Josefin');
				wp_enqueue_style( 'WorkSans');
		}

add_action('wp_print_styles', 'coolRahulSoni_google_fonts');


// Custom Post Type
function coolRahulSoni_my_custom_post() {
	register_post_type( 'my-custom-post',
			array(
			'labels' => array(
					'name' => __( 'My Custom Post' ),
					'singular_name' => __( 'My Custom Post' ),
			),
			'public' => true,
			'has_archive' => true,
			'supports' => array(
					'title',
					'editor',
					'thumbnail',
				  'custom-fields'
			)
	));
}
add_action( 'init', 'coolRahulSoni_my_custom_post' );




//Custom Admin Menu Field
function coolRahulSoni_custom_settings_add_menu() {
  add_menu_page( 'CoolRahulSoni Custom Settings', 'CoolRahulSoni Custom Settings', 'manage_options', 'custom-settings', 'custom_settings_page', null, 99 );
}
add_action( 'admin_menu', 'coolRahulSoni_custom_settings_add_menu' );


// Create Custom Global Settings
function custom_settings_page() { ?>
  <div class="wrap">
    <h1>Custom Settings</h1>
    <form method="post" action="options.php">
       <?php
           settings_fields( 'section' );
           do_settings_sections( 'theme-options' );      
           submit_button(); 
       ?>          
    </form>
  </div>
<?php }


// Twitter
function setting_twitter() { ?>
  <input type="text" name="twitter" id="twitter" value="<?php echo get_option( 'twitter' ); ?>" />
<?php }

function custom_settings_page_setup() {
  add_settings_section( 'section', 'All Settings', null, 'theme-options' );
  add_settings_field( 'twitter', 'Twitter URL', 'setting_twitter', 'theme-options', 'section' );
  add_settings_field( 'github', 'GitHub URL', 'setting_github', 'theme-options', 'section' );
  

  register_setting('section', 'twitter');
  register_setting( 'section', 'github' );
}
add_action( 'admin_init', 'custom_settings_page_setup' );


function setting_github() { ?>
  <input type="text" name="github" id="github" value="<?php echo get_option('github'); ?>" />
<?php }

?>







<?php 

/** Add Meta Box Script **/


function coolRahulSoni_meta_box_add()
{
    add_meta_box( 'my-meta-box-id', 'My First Meta Box', 'cd_meta_box_cb', 'post', 'normal', 'high' );
}

	function cd_meta_box_cb($post)
	{
		// $post is already set, and contains an object: the WordPress post
		global $post;
		$values = get_post_custom( $post->ID );
		$text = isset( $values['my_meta_box_text'] ) ? esc_attr( $values['my_meta_box_text'][0] ) : '';
		$selected = isset( $values['my_meta_box_select'] ) ? esc_attr( $values['my_meta_box_select'][0] ) : '';
		$check = isset( $values['my_meta_box_check'] ) ? esc_attr( $values['my_meta_box_check'][0] ) : '';
		 
		// We'll use this nonce field later on when saving.
		wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
		?>
		<p>
			<label for="my_meta_box_text">Text Label</label>
			<input type="text" name="my_meta_box_text" id="my_meta_box_text" value="<?php echo $text; ?>" />
		</p>
		 
		<p>
			<label for="my_meta_box_select">Color</label>
			<select name="my_meta_box_select" id="my_meta_box_select">
				<option value="red" <?php selected( $selected, 'red' ); ?>>Red</option>
				<option value="blue" <?php selected( $selected, 'blue' ); ?>>Blue</option>
			</select>
		</p>
		 
		<p>
			<input type="checkbox" id="my_meta_box_check" name="my_meta_box_check" <?php checked( $check, 'on' ); ?> />
			<label for="my_meta_box_check">Do not check this</label>
		</p>
		<?php    
	}
	add_action( 'add_meta_boxes', 'coolRahulSoni_meta_box_add' );	
	
	function coolRahulSoni_meta_box_save( $post_id )
	{
		wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
		// Bail if we're doing an auto save
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		 
		// if our nonce isn't there, or we can't verify it, bail
		if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
		 
		 
		// if our current user can't edit this post, bail
		 if( !current_user_can( 'edit_post', $post_id ) ) return;
		 
		 // check permissions
		/*
		if ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}  
	*/
		 
		 
		// now we can actually save the data
		$allowed = array( 
			'a' => array( // on allow a tags
				'href' => array() // and those anchors can only have href attribute
			)
		);
		 
		// Make sure your data is set before trying to save it
		if( isset( $_POST['my_meta_box_text'] ) )
			update_post_meta( $post_id, 'my_meta_box_text', wp_kses( $_POST['my_meta_box_text'], $allowed ) );
			 
		if( isset( $_POST['my_meta_box_select'] ) )
			update_post_meta( $post_id, 'my_meta_box_select', esc_attr( $_POST['my_meta_box_select'] ) );
			 
		// This is purely my personal preference for saving check-boxes
		$chk = isset( $_POST['my_meta_box_check'] ) && $_POST['my_meta_box_select'] ? 'on' : 'off';
		update_post_meta( $post_id, 'my_meta_box_check', $chk );
	}
	
	add_action( 'save_post', 'coolRahulSoni_meta_box_save' );
	
	
	
	
	
	/*** Excerpt Lenght Fix **/
/******
	function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'... <a href="'. get_permalink($post->ID) . '">Continue &raquo</a>';
	/*
	For linked Continue reading "post title" use:
	'... <a href="'. get_permalink($post->ID) . '">Continue reading "'.get_the_title($post->ID).'"</a>'
	For linked Continue reading >> use:
	'... <a href="'. get_permalink($post->ID) . '">Continue &raquo</a>'
	*/
	/*
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}
 
function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'... <a href="'. get_permalink($post->ID) . '">Continue &raquo;</a>';
  } else {
    $content = implode(" ",$content);
  }	
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>»', ']]&gt;&raquo;', $content);
  return $content;
}
	*/
	
	
	function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'... <a href="'. get_permalink() . '">Continue Reading</a>';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}
 
function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'... <a href="'. get_permalink() . '">Continue Reading</a>';
  } else {
    $content = implode(" ",$content);
  }	
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}
	
	/*** Excerpt Lenght Fix Ends**/
	
	
	
	?>
	









<?php /*

/*** New Post Type and new metabox types example * /

function create_post_your_post() {
	register_post_type( 'your_post',
		array(
			'labels'       => array(
				'name'       => __( 'Your Post' ),
			),
			'public'       => true,
			'hierarchical' => true,
			'has_archive'  => true,
			'supports'     => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
			), 
			'taxonomies'   => array(
				'post_tag',
				'category',
			)
		)
	);
	register_taxonomy_for_object_type( 'category', 'your_post' );
	register_taxonomy_for_object_type( 'post_tag', 'your_post' );
}
add_action( 'init', 'create_post_your_post' );
function add_your_fields_meta_box() {
	add_meta_box(
		'your_fields_meta_box', // $id
		'Your Fields', // $title
		'show_your_fields_meta_box', // $callback
		'your_post', // $screen
		'normal', // $context
		'high' // $priority
	);
}
add_action( 'add_meta_boxes', 'add_your_fields_meta_box' );
function show_your_fields_meta_box() {
	global $post;  
		$meta = get_post_meta( $post->ID, 'your_fields', true ); 
		//$meta = get_post_meta( $post->ID, 'your_fields', true ); 
		//$meta = [get_post_meta( $post->ID, ‘your_fields’, true )]; ?>
	<input type="hidden" name="your_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

	<p>
		<label for="your_fields[text]">Input Text</label>
		<br>
		<input type="text" name="your_fields[text]" id="your_fields[text]" class="regular-text" value="<?php echo $meta['text']; ?>">
	</p>
	<p>
		<label for="your_fields[textarea]">Textarea</label>
		<br>
		<textarea name="your_fields[textarea]" id="your_fields[textarea]" rows="5" cols="30" style="width:500px;"><?php echo $meta['textarea']; ?></textarea>
	</p>
	<p>
		<label for="your_fields[checkbox]">Checkbox
			<input type="checkbox" name="your_fields[checkbox]" value="checkbox" <?php if ( $meta['checkbox'] === 'checkbox' ) echo 'checked'; ?>>
		</label>
	</p>
	<p>
		<label for="your_fields[select]">Select Menu</label>
		<br>
		<select name="your_fields[select]" id="your_fields[select]">
				<option value="option-one" <?php selected( $meta['select'], 'option-one' ); ?>>Option One</option>
				<option value="option-two" <?php selected( $meta['select'], 'option-two' ); ?>>Option Two</option>
		</select>
	</p>
	<p>
		<label for="your_fields[image]">Image Upload</label><br>
		<input type="text" name="your_fields[image]" id="your_fields[image]" class="meta-image regular-text" value="<?php echo $meta['image']; ?>">
		<input type="button" class="button image-upload" value="Browse">
	</p>
	<div class="image-preview"><img src="<?php echo $meta['image']; ?>" style="max-width: 250px;"></div>


<script>
jQuery(document).ready(function ($) {
	// Instantiates the variable that holds the media library frame.
	var meta_image_frame;
	// Runs when the image button is clicked.
	$('.image-upload').click(function (e) {
		// Prevents the default action from occuring.
		e.preventDefault();
		var meta_image = $(this).parent().children('.meta-image');
		// If the frame already exists, re-open it.
		if (meta_image_frame) {
			meta_image_frame.open();
			return;
		}
		// Sets up the media library frame
		meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
			title: meta_image.title,
			button: {
				text: meta_image.button
			}
		});
		// Runs when an image is selected.
		meta_image_frame.on('select', function () {
			// Grabs the attachment selection and creates a JSON representation of the model.
			var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
			// Sends the attachment URL to our custom image input field.
			meta_image.val(media_attachment.url);
			//var image_url = meta_image.val();
			//$(selected).closest('div').find('.image-preview').children('img').attr('src', image_url);
		});
		// Opens the media library frame.
		meta_image_frame.open();
	});
});
</script>

	<?php }
function save_your_fields_meta( $post_id ) {   
	// verify nonce
	if ( !wp_verify_nonce( $_POST['your_meta_box_nonce'], basename(__FILE__) ) ) {
		return $post_id; 
	}
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// check permissions
	if ( 'page' === $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}  
	}
	
	$old = get_post_meta( $post_id, 'your_fields', true );
	$new = $_POST['your_fields'];
	if ( $new && $new !== $old ) {
		update_post_meta( $post_id, 'your_fields', $new );
	} elseif ( '' === $new && $old ) {
		delete_post_meta( $post_id, 'your_fields', $old );
	}
}
add_action( 'save_post', 'save_your_fields_meta' );







*/




	
	
//**Function for add style to perticular pages only
/*
add_action('init', 'my_register_styles');

function my_register_styles() {
    wp_register_style( 'style1', get_template_directpry_uri() . '/style1.css' );
    wp_register_style( 'style2', get_template_directpry_uri() . '/style2.css' );
    wp_register_style( 'style3', get_template_directpry_uri() . '/style3.css' );
}

add_action( 'wp_enqueue_scripts', 'my_enqueue_styles' );

function my_enqueue_styles() {
    if ( is_front_page() ) {
        wp_enqueue_style( 'style3' );
    } elseif ( is_page_template( 'special.php' ) ) {
        wp_enqueue_style( 'style1' );
        wp_enqueue_style( 'style2' );
    } else {
        wp_enqueue_style( 'style1' );
    }
}
*/
/** Functions to add specific style to specific pages ends **/



?>

	
