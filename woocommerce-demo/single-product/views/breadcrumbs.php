<?php
    $show_breadcrumbs = false;
    $show_breadcrumbs = StockieSettings::get( 'woocommerce_page_show_breadcrumbs', 'global' );
    if ( $show_breadcrumbs == 'inherit' ) {
        $show_breadcrumbs = (bool) StockieSettings::get( 'page_show_breadcrumbs', 'global' );
    } else {
        $show_breadcrumbs = ( $show_breadcrumbs == 'yes' );
    }

    $category_in_breadcrumb = false;
    if ($show_breadcrumbs) {
        $category_in_breadcrumb = StockieSettings::get('page_show_category_breadcrumbs');
        if ( $category_in_breadcrumb == 'inherit') {
            $category_in_breadcrumb = StockieSettings::get('woocommerce_page_show_category_breadcrumbs', 'global');
        }
        $category_in_breadcrumb = ( $category_in_breadcrumb == 'yes' );
    }

    $delimiter_symbol = esc_html( StockieSettings::get( 'breadcrumbs_separator', 'global' ) );
    if ( ! $delimiter_symbol ) {
        $delimiter_symbol = '<i class="ion ion-ios-arrow-forward"></i>';
    }
?>

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <ol class="breadcrumbs-slug" itemscope itemtype="http://schema.org/BreadcrumbList">
            <?php $position = 1; ?>

            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                <a class="brand-color-hover" itemprop="item" href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>">
                    <span itemprop="name"><?php echo StockieSettings::breadcrumbs_woocommerce_slug(); ?></span>
                </a>
                <meta itemprop="position" content="<?php echo esc_attr( $position ); ?>" />
            </li>

            <?php
                $ancestors = get_ancestors( get_the_ID(), 'page', 'post_type' );
                for( $i = count( $ancestors ) - 1; $i >= 0; $i-- ):
                    $position += 1;
                    $page = get_page( $ancestors[$i] );
                ?>
                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <?php echo $delimiter_symbol; ?>
                        <a class="brand-color-hover" itemprop="item" href="<?php echo esc_attr( $page->guid ); ?>">
                            <span itemprop="name"><?php echo esc_html( $page->post_title ); ?></span>
                        </a>
                        <meta itemprop="position" content="<?php echo esc_attr( $position ); ?>" />
                    </li>
                <?php
                endfor;

                if ( $category_in_breadcrumb ) {
                    $terms = wp_get_post_terms( $post->ID, 'product_cat', array( 'taxonomy' => 'product_cat' ) );

                    if ( is_array( $terms ) && is_object( $terms[0] ) ):
                        $position += 1;
                    ?>
                        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                            <?php echo $delimiter_symbol; ?>
                            <a class="brand-color-hover hover-underline underline-brand" itemprop="item" href="<?php echo esc_attr( get_term_link( $terms[0] ) ); ?>">
                                <span itemprop="name"><?php echo esc_html( $terms[0]->name ); ?></span>
                            </a>
                            <meta itemprop="position" content="<?php echo esc_attr( $position ); ?>" />
                        </li>
                    <?php
                    endif;
                }
            ?>

            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                <?php echo $delimiter_symbol; ?>
                <span itemprop="name" class="active"><?php the_title(); ?></span>
                <meta itemprop="position" content="<?php echo esc_attr( $position + 1 ); ?>" />
            </li>
        </ol>
    </div>
    <div class="woo_c-product-nav">
        <a href="<?php next_post_link(); ?>" class="woo_c-product-nav-prev tooltip">
            <i class="ion ion-ios-arrow-back"></i>
            <div class="tooltip-item brand-bg-color brand-bg-color-before left"><?php esc_html_e( 'prev', 'stockie' ); ?></div>
        </a>
        <a href="<?php previous_post_link(); ?>" class="woo_c-product-nav-next tooltip">
            <i class="ion ion-ios-arrow-forward"></i>
            <div class="tooltip-item brand-bg-color brand-bg-color-before right"><?php esc_html_e( 'next', 'stockie' ); ?></div>
        </a>
    </div>
</div>