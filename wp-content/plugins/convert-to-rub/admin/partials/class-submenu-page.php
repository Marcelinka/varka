<?php

/**
 * 
 * @link       aisapr.ru
 * @since      1.0.0
 *
 * @package    Convert_To_Rub
 * @subpackage Convert_To_Rub/admin/partials
 * 
 * Creates the submenu page for the plugin.
 *
 * Provides the functionality necessary for rendering the page corresponding
 * to the submenu with which this page is associated.
 *
 * @package Custom_Admin_Settings
 */

class Submenu_Page {
 
    /**
     * This function renders the contents of the page associated with the Submenu
     * that invokes the render method. In the context of this plugin, this is the
     * Submenu class.
     */

    public function render() {

        //$currency_rates_json = file_get_contents(plugin_dir_path('currency_rates/rates.json');
        print_r(file_get_contents('./rates.json'));

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

        ?>

        <div class="container">
            <div class="row">
                <h2>Обновление товаров с ценой в валюте</h2>
            </div>
            <div class="row">
                <form id="convert-form">
                    <div class="form-group">
                        <label for="currency-code">Код валюты</label>
                        <select class="form-control" id="currency-code" required>
                            <option selected value="eur">Евро</option>
                            <option value="usd">Доллар</option>
                        </select>
                    </div>
                    <button id="convert-run" type="submit" class="btn btn-primary">Обновить цены</button>
                </form>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <h2>Результаты обновления</h2>
            </div>
            <table id="convert-table" class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">ID товара</th>
                        <th scope="col">Название товара</th>
                        <th scope="col">Цена (базовая)</th>
                        <th scope="col">Цена (RUB)</th>
                    </tr>
                </thead>
                <tbody id="convert-results">
                </tbody>
            </table>
        </div>
        
        <?php

    }
}

?>