<?php
/**
 * Result Count
 *
 * Shows text: Showing x - x of x results
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $wp_query;

if ( ! woocommerce_products_will_display() )
	return;
function build_link_pagination($link,$per_page) {
    if(strpos($link,'limit=') !== false) {
        return preg_replace("/limit=[0-9]+/ism","limit=".$per_page,$link);
    }
    else {
        return $link.'?limit='.$per_page;
    }
}
?>
<p class="woocommerce-result-count">
    <?php
  //  $total    = $wp_query->found_posts;
   if(woocommerce_get_page_id('shop') == 131)
   {
           function getSubCat($paren_id)
           {
               $args = array(
                   'taxonomy'     => 'product_cat',
                   'child_of'     => 0,
                   'parent'       => $paren_id,
                   'orderby'      => 'name',
                   'show_count'   => 0,
                   'pad_counts'   => 0,
                   'hierarchical' => 1,
                   'title_li'     => '',
                   'hide_empty'   => 0
               );
               $sub_cats = get_categories( $args );
               if($sub_cats) {
                   foreach($sub_cats as $sub_category)
                   {
                       echo '<li><a href="'. get_term_link($sub_category->slug, 'product_cat') .'">'. $sub_category->name .'</a></li>';
                       if($sub_category->category_parent != 0) getSubCat($sub_category->term_id);
                   }

               }
           }


           $taxonomy     = 'product_cat';
           $orderby      = 'name';
           $show_count   = 0;      // 1 for yes, 0 for no
           $pad_counts   = 0;      // 1 for yes, 0 for no
           $hierarchical = 1;      // 1 for yes, 0 for no
           $title        = '';
           $empty        = 0;
           $args = array(
               'taxonomy'     => $taxonomy,
               'orderby'      => $orderby,
               'show_count'   => $show_count,
               'pad_counts'   => $pad_counts,
               'hierarchical' => $hierarchical,
               'title_li'     => $title,
               'hide_empty'   => $empty
           );

        $all_categories = get_categories( $args );
        echo '<div class="list-category"><ul>';
        foreach ($all_categories as $cat)
        {
            if($cat->category_parent == 0)
            {
                $category_id = $cat->term_id;
                echo '<li><a href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .'</a></li>';
             }
            if($cat->category_parent != 0) getSubCat($cat->term_id);
        }
       echo '</ul>'
?>
    <div class="number-list">
        <p><?php _e(' product per page');
            $link_current = get_pagenum_link();
            $arr_pagination = array(9=>1,18=>1,27=>1,36=>1);
            $page_current = isset($_GET['limit'])?$_GET['limit']:9;
            if(!$arr_pagination[$page_current]) {
                $page_current = 9;
            }

            ?> :</p>
        <span>[
            <?php
                $i = 0;
                foreach($arr_pagination as $key=>$vl) {
                    $clas_active_pagin = '';
                    if($key == $page_current) {
                        $clas_active_pagin = ' class="active"';
                    }
                    if($i !== 0) {
                        echo '/';
                    }
                    echo '<a rel="nofollow" href="'.build_link_pagination($link_current,$key).'"'.$clas_active_pagin.'>'.$key.'</a>';
                    $i++;
                }
            ?>
            ]</span>
    </div>

<?php
  echo '</div>';
    }
?>


</p>
<div class="div_test"></div>