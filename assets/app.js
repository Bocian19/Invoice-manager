/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

window.addEventListener('DOMContentLoaded', () => {

    let net_price = document.getElementById("product_net_price");
    let tax = document.getElementById("product_tax");
    let with_tax_price = document.getElementById("product_with_tax_price");

    net_price.addEventListener('change', ()=> {
        with_tax_price.value = tax.value * net_price.value;
    })
    tax.addEventListener('change', ()=> {
        with_tax_price.value = tax.value * net_price.value;
    })


});