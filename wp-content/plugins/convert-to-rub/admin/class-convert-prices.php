<?php

/**
 * Creates the convert_prices function to convert prices to RUB
 *
 * @package Convert_To_Rub
 */

class Converter {

    /**
     * Creates the submenu item and calls on the Submenu Page object to render
     * the contents of the page.
     */
    public function convert_prices() {

        $base_currency = 'eur';
        if (isset($_POST['base_currency'])) {
            $base_currency = $_POST['base_currency'];
        }

        $query = new WP_Query( 
            array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_tag',
                        'field'    => 'slug',
                        'terms'    => $base_currency
                    ),
                )
            )
        );

        $currency_rates = file_get_contents(plugin_dir_url( __FILE__ ) . 'currency_rates/rates.json');
        $decoded_currency_rates = json_decode($currency_rates);

        $results = array(
            'currency' => $decoded_currency_rates->Valute->{strtoupper($base_currency)}
        );

        $i = 1;

        while ( $query->have_posts() ) {

            $query->the_post();

            $ID = get_the_id();
            $title = get_the_title();
            $price_eur = get_field('price_' . $base_currency, $ID);
            $currency_rate = $decoded_currency_rates->Valute->{strtoupper($base_currency)}->Value * 1.02;
            $price_rub = round($price_eur * $currency_rate);

            // Set or update regular price in RUB
            update_post_meta( $ID, '_regular_price', $price_rub);
            update_post_meta( $ID, '_price', $price_rub);

            // Get the new price
            $regular_price = get_post_meta( $ID, '_regular_price', true);

            $results['html'] .= '<tr>
                <td>' . $i . '</td>
                <td>' . $ID . '</td>
                <td>' . $title . '</td>
                <td>' . $price_eur . '</td>
                <td>' . $regular_price . '</td>
            </tr>';

            $i++;

        }

        wp_reset_query();

        echo json_encode($results);

    }

    /*public function count_pages() {

        $query = new WP_Query( 
            array(
                'post_type' => 'product',
                'posts_per_page' => 20,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_tag',
                        'field'    => 'slug',
                        'terms'    => $_POST['base_currency']
                    ),
                ),
                'paged' => $_POST['page']
            )
        );

        $results = array(
            'total' => $query->max_num_pages
        );

        wp_reset_query();

        echo json_encode($results);

    }*/

}