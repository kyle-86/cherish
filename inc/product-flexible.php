<?php
if( have_rows( 'td_product_content' ) ) {
    $count = count(get_field('td_product_content'));
    while ( have_rows( 'td_product_content' ) ) {
        $i = get_row_index() + 1;
        the_row();
        $layout_name  = get_row_layout();
        $layout_class = str_replace('_', '-', $layout_name);
        $section_class = 'standard';
        if($i == 1) {
        	$section_class = 'first';
        } elseif ($i == $count) {
        	$section_class = 'last';
        }
        echo '<div class="layout layout--' . $layout_class . ' layout--' . $section_class . '">';
        get_template_part( 'layout-product/' . $layout_class );
        echo '</div>';
    }
}
?>