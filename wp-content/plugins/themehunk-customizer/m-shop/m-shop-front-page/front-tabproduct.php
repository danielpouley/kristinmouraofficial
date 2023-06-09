<?php
if(get_theme_mod('m_shop_disable_cat_sec',false) == true){
    return;
  }
?>
<section class="thunk-product-tab-section">
  <?php m_shop_display_customizer_shortcut( 'm_shop_category_tab_section' );?>
 <!-- thunk head start -->
  <div id="thunk-cat-tab" class="thunk-cat-tab">
  <div class="thunk-heading-wrap">
  <div class="thunk-heading">
    <h4 class="thunk-title">
    <span class="title"><?php echo esc_html(get_theme_mod('m_shop_cat_tab_heading',__('Tabbed Product Carousel','themehunk-customizer')));?></span>
   </h4>
  </div>
<!-- tab head start -->
<?php  $term_id = get_theme_mod('m_shop_category_tab_list');   
m_shop_category_tab_list($term_id); 
?>
</div>
<!-- tab head end -->
<div class="content-wrap">
  <div class="tab-content">
      <div class="thunk-slide thunk-product-cat-slide owl-carousel">
       <?php 
          $term_id = get_theme_mod('m_shop_category_tab_list'); 
          $prdct_optn = get_theme_mod('m_shop_category_optn','recent');
          m_shop_product_cat_filter_default_loop($term_id,$prdct_optn); 
         ?>
      </div>
    </div>
  </div>
</div>
</section>