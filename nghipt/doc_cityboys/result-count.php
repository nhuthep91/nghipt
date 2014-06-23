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
?>
<p class="woocommerce-result-count">
<!--	--><?php
//    $args = array(
//        'number'     => $number,
//        'orderby'    => $orderby,
//        'order'      => $order,
//        'hide_empty' => $hide_empty,
//        'include'    => $ids
//    );
//
//    $product_categories = get_terms( 'product_cat', $args );
//
//    foreach($product_categories as $cat)
//    {
////        echo '<a href="'.wooLinkCat($cat->name).'">'.$cat->name.'</a>' . ' ';
//    }
//
//    var_dump($product_categories);
//
//    $paged    = max( 1, $wp_query->get( 'paged' ) );
//    $per_page = $wp_query->get( 'posts_per_page' );
//    $total    = $wp_query->found_posts;
//    $first    = ( $per_page * $paged ) - $per_page + 1;
//    $last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );
//    $per_page = $wp_query->get( 'posts_per_page' );
//
//    function wooLinkCat($catname)
//    {
//        $cat_pro = "product-category";
//        if($catname == null)
//            return false;
//        else
//        {
//            $catLink  = get_site_url() .'/'. $cat_pro .'/'. $catname;
//            return $catLink;
//        }
//    }
//	?>
    <?php
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
    ?>
    <?php $all_categories = get_categories( $args );
    //print_r($all_categories);
    foreach ($all_categories as $cat) {
        //print_r($cat);
        if($cat->category_parent == 0) {
            $category_id = $cat->term_id;

            ?>

            <?php

            echo '<br /><a href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .'</a>'; ?>


            <?php
            $args2 = array(
                'taxonomy'     => $taxonomy,
                'child_of'     => 0,
                'parent'       => $category_id,
                'orderby'      => $orderby,
                'show_count'   => $show_count,
                'pad_counts'   => $pad_counts,
                'hierarchical' => $hierarchical,
                'title_li'     => $title,
                'hide_empty'   => $empty
            );
            $sub_cats = get_categories( $args2 );
            if($sub_cats) {
                foreach($sub_cats as $sub_category) {
                    echo  $sub_category->name ;
                }

            } ?>



        <?php }
    }
    ?>
</p>