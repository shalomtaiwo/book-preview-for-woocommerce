<?php if ( ! defined( 'WPINC' ) ) {die;} // end if?>

<div id="wbps_woo_options" class="panel woocommerce_options_panel">
				<?php
woocommerce_wp_select( 
     array(
          'id'            => 'wbps_preview_select_option',
          'label'         => __('Choose option','wpbpreview'),
          'name'          => 'wbps_preview_select_option',
          'options'       => array(
            ''               => __( 'Do not Show', 'wpbpreview' ),
            'wbps_txteditor' => __('Text Editor', 'wpbpreview' ),
            'wbps_opt_pdf'       => __('PDF', 'wpbpreview' ),
    ),
    'default' => '',
  )
); 

woocommerce_wp_text_input(
  array(
    'id'          => 'wbps_preview_content_author',
    'label'         => __('Author','wpbpreview'),
    'placeholder'       => __('Author name','wpbpreview'),
    'description' => __( 'E.g Book Author', 'wpbpreview' ),
  )
  );

woocommerce_wp_text_input(
    array(
      'id'          => 'wbps_preview_year_publication',
      'label'         => __('Date','wpbpreview'),
      'placeholder'       => __('Publication Date','wpbpreview'),
      'description' => __( 'E.g 2nd Jan 2022.', 'wpbpreview' ),
    )
    );
?>
<style>
  div.wbps_accordion{width:100%;background-color:#f5f5f5;border:none;outline:0;text-align:left;padding:15px 20px;font-size:18px;color:#333;cursor:pointer;transition:background-color .2s linear}div.wbps_accordion:after{font-family:FontAwesome;font-family:fontawesome;font-size:18px;float:right}div.wbps_accordion.wbps_is-open,div.wbps_accordion:hover{background-color:#ddd}.wbps_accordion-content{background-color:#fff;border-left:1px solid #f5f5f5;border-right:1px solid #f5f5f5;padding:0 20px;max-height:0;overflow:hidden;transition:max-height .2s ease-in-out}
</style>
<p style="color: black; background-color: #bfe7f5; padding: 5px; width: 70px;"><a href="https://shalomt.com/plugins/wpbookpreview/contact/" target="_blank" style="text-decoration: none; color: black;">Need Help?</a></p>
<div class="wbps_accordion">Text Editor</div>
  <div class="wbps_accordion-content">
  <div id="wb_tab_wbps_txteditor" class="wbps_tab_content">
  <p style="text-align: center; color: black; background-color: #bfe7f5; padding: 10px;">You could click "View" and Choose FullScreen for a better mode. Click it again to leave Fullscreen mode</p>

<?php

woocommerce_wp_textarea_input(
					array(
						'id'          => 'wbps-preview-text-content',
            'label'         => __('Text content','wpbpreview'),
						'description' => __( '...', 'wpbpreview' ),
					)
				);
				?>
                <script type="text/javascript">
                    
                jQuery(document).ready(function() {

                if ( typeof( tinyMCE ) == "object") {
                tinyMCE.init({
                selector: '#wbps-preview-text-content',
                height: 650,
                branding: false,
                menubar: 'file edit view',
                plugins: ['textcolor','lists link image', 'fullscreen','media'],
              
                toolbar1: 'fontselect | forecolor backcolor | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media',
                image_title: false,
                automatic_uploads: true,
                file_picker_types: 'image,file ',
                file_picker_callback: function (cb, value, meta) {
                  var input = document.createElement('input');
                  input.setAttribute('type', 'file');
                  input.setAttribute('accept', 'image/*');
                input.onchange = function () {
                  var file = this.files[0];
                  var reader = new FileReader();
                  reader.onload = function () {
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);
                    cb(blobInfo.blobUri(), { title: file.name });
                  };
                  reader.readAsDataURL(file);
                };
                input.click();
              },
              content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
                        });


                    }
                });

</script>

</div>
  </div>

  <div class="wbps_accordion">PDF Preview</div>
  <div class="wbps_accordion-content">
  <div id="wb_tab_wbps_opt_pdf" class="wbps_tab_content">
    <p style="text-align: center; color: black; background-color: #bfe7f5; padding: 10px;">Make sure link is correct! (localhosted sites' link doesn't count)</p>
  <?php
woocommerce_wp_text_input(
  array(
    'id'          => 'wbps-preview-pdf-content',
    'label'         => __('Add pdf link','wpbpreview'),
    'placeholder'       => __('PDF file Link','wpbpreview'),
  )
);?>

<div>
  <p style="text-align: center; color: black; background-color: #bfe7f5; padding: 10px;">Add Alternate Preview For Unsupported Browsers</p>
</div>
<?php
woocommerce_wp_textarea_input(
  array(
    'id'          => 'wbps-preview-pdf-content-alt',
    'label'         => __('Alternate preview','wpbpreview'),
  )
);
  ?>
  <script type="text/javascript">
                    
                    jQuery(document).ready(function() {
    
                    if ( typeof( tinyMCE ) == "object") {
                    tinyMCE.init({
                    selector: '#wbps-preview-pdf-content-alt',
                    height: 500,
                    branding: false,
                    menubar: 'file edit view',
                    plugins: ['lists link image', 'fullscreen','media'],
                  
                    toolbar1: 'fontselect | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media',
                    image_title: false,
                    automatic_uploads: true,
                    file_picker_types: 'image file ',
                    file_picker_callback: function (cb, value, meta) {
                      var input = document.createElement('input');
                      input.setAttribute('type', 'file');
                      input.setAttribute('accept', 'image/*');
                    input.onchange = function () {
                      var file = this.files[0];
                      var reader = new FileReader();
                      reader.onload = function () {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), { title: file.name });
                      };
                      reader.readAsDataURL(file);
                    };
                    input.click();
                  },
                  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
                            });
                        }
                        
                    });
    </script>
    </div>
  </div>
</div>
<script type="text/javascript">
                    
    jQuery(document).ready(function() {
    const wbps_accordionBtns = document.querySelectorAll(".wbps_accordion");
    wbps_accordionBtns.forEach((wbps_accordion) => {
      wbps_accordion.onclick = function () {
        this.classList.toggle("wbps_is-open");
    
        let content = this.nextElementSibling;
        console.log(content);
    
        if (content.style.maxHeight) {
          //this is if the wbps_accordion is open
          content.style.maxHeight = null;
        } else {
          //if the wbps_accordion is currently closed
          content.style.maxHeight = content.scrollHeight + "px";
          console.log(content.style.maxHeight);
        }
      };
    });
                      
  });
</script>