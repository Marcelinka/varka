import VueTheMask from 'vue-the-mask';
import makePdf from './makePdfFile.js';
import {lockScroll, unlockScroll} from './lockScroll.js';

Vue.use(VueTheMask);

let products = JSON.parse( localStorage.getItem('wishlist') );

/*
    Wishlist
*/
new Vue({
    el: '#vue-wishlist',
    data: {
        products: products,
        form: false,
        orderFileBase64: '',
        person: {
            name: '',
            email: '',
            phone: ''
        },
        button: {
            text: 'Отправить',
            block: false
        }
    },
    methods: {
        showForm() {
            if(this.products.length) {
                this.form = true;
                lockScroll();

                let file = makePdf();
                file.getBase64(this.getBuffer);
            } else {
                alert('Добавьте товары!');
            }
        },
        downloadPdf() {
            if(this.products.length) {
                let file = makePdf();
                //console.log(file);
                file.download('order.pdf');
            } else {
                alert('Добавьте товары!');
            }
        },
        deleteItem(event, id) {
            //console.log(event);
            this.products.splice(id, 1);
            localStorage.setItem( 'wishlist', JSON.stringify(this.products) );
            //console.log(localStorage);
        },
        closeForm() {
            this.form = false;
            unlockScroll();
        },
        sendOrder() {
            //alert(this.person.name + ' ' + this.person.email + ' ' + this.person.phone);
            if(this.products.length) {
                this.button.text = 'Отправляю..';
                this.button.block = true;

                //console.log(this.orderFileBase64);

                let data = {
                    action: 'mail_order',
                    fileContent: this.orderFileBase64,
                    name: this.person.name,
                    email: this.person.email,
                    phone: this.person.phone
                };
                //console.log(data);
                jQuery.post('/wp-admin/admin-ajax.php', data, this.checkResponse);
            }
        },
        checkResponse(response) {
            response = JSON.parse(response);
            console.log(response);
            let message = response.message;

            if(message == 'success') {
                //console.log(this);
                this.button.text = 'Отправлено!';
                setTimeout(this.closeForm, 3000);
            } else {
                alert('Что-то пошло не так! Попробуйте позже. ' + message);
                this.closeForm();
            }
        },
        getBuffer(buffer) {
            //console.log('Буфер'+buffer);
            this.orderFileBase64 = buffer;
            //console.log('Переменная сохраненная'+this.orderFileBase64);
        }
    }
});

Vue.component('button-wishlist', {
    props: [
        'productId',
        'productImage',
        'productName',
        'productLink',
        'productSku',
        'productPrice',
        'productArray'
    ],
    template: `
        <button class="add-in-storage" @click="productAction">
            <div class="add-in-storage__heart">
                <svg :class="{animate: liked}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 51.997 51.997">
                  <path d="M51.911 16.242c-.759-8.354-6.672-14.415-14.072-14.415-4.93 0-9.444 2.653-11.984 6.905-2.517-4.307-6.846-6.906-11.697-6.906C6.759 1.826.845 7.887.087 16.241c-.06.369-.306 2.311.442 5.478 1.078 4.568 3.568 8.723 7.199 12.013l18.115 16.439 18.426-16.438c3.631-3.291 6.121-7.445 7.199-12.014.748-3.166.502-5.108.443-5.477zm-2.39 5.019c-.984 4.172-3.265 7.973-6.59 10.985L25.855 47.481 9.072 32.25c-3.331-3.018-5.611-6.818-6.596-10.99-.708-2.997-.417-4.69-.416-4.701l.015-.101c.65-7.319 5.731-12.632 12.083-12.632 4.687 0 8.813 2.88 10.771 7.515l.921 2.183.921-2.183c1.927-4.564 6.271-7.514 11.069-7.514 6.351 0 11.433 5.313 12.096 12.727.002.016.293 1.71-.415 4.707z"/>
                </svg>
                <svg :class="{animate: liked}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                  <path d="M24.85 10.126c2.018-4.783 6.628-8.125 11.99-8.125 7.223 0 12.425 6.179 13.079 13.543 0 0 .353 1.828-.424 5.119-1.058 4.482-3.545 8.464-6.898 11.503L24.85 48 7.402 32.165c-3.353-3.038-5.84-7.021-6.898-11.503-.777-3.291-.424-5.119-.424-5.119C.734 8.179 5.936 2 13.159 2c5.363 0 9.673 3.343 11.691 8.126z" fill="#d75a4a"/>
                </svg>
            </div>
            <span>Wishlist</span>
        </button>
    `,
    created: function() {
        /*console.log(this.productId);
        console.log(this.productImage);
        console.log(this.productName);
        console.log(this.productLink);
        console.log(this.productArray);
        console.log(this.liked);*/
    },
    methods: {
        productAction() {
            //this.getLiked();

            if(this.liked) {
                this.$emit('remove-product', this.productId);
            } else {
                let product = {
                    id: this.productId,
                    image: this.productImage,
                    name: this.productName,
                    link: this.productLink,
                    sku: this.productSku,
                    price: this.productPrice
                };

                let count = jQuery('input[type="number"]').val();
                //console.log(count);
                product.count = count;
                //console.log(product);

                let variation = jQuery('input.variation-input[type="radio"]:checked + label p').text();
                //console.log(variation);
                if(variation) {
                    let sku = jQuery('.product_meta .sku').text();
                    let price = jQuery('p.price').text();
                    price = price.replace(/\D/gi, () => { return ''; });
                    //console.log(sku);
                    //console.log(price);
                    product.variation = variation;
                    product.sku = sku;
                    product.price = price;
                }

                console.log(product);

                this.$emit('add-product', product);
            }
        }
    },
    computed: {
        liked() {
            let isLiked = false;
            this.productArray.forEach((item) => {
                if(item.id == this.productId) {
                    isLiked = true;
                }
            });

            return isLiked;
        }
    }
});

new Vue({
    el: '.add-in-storage-container',
    data: {
        products: products
    },
    created: function() {
        if ( localStorage.getItem('wishlist') == null) {
            this.products = [];
            localStorage.setItem('wishlist', JSON.stringify(this.products));
        }
    },
    methods: {
        add(product) {
            console.log('add product');
            this.products.push(product);
            console.log(this.products);
        },
        remove(id) {
            console.log('remove product');
            this.products.forEach((item, index) => {
                if(item.id == id) {
                    this.products.splice(index, 1);
                }
            });
            console.log(this.products);
        }
    },
    watch: {
        products: function(val) {
            localStorage.setItem('wishlist', JSON.stringify(val));
            console.log('local storage изменился');
            console.log(localStorage);
        }
    }
});

new Vue({
    el: '#menu-menu2',
    data: {
        products: products
    },
    computed: {
        count() {
            return this.products.length;
        }
    }
});

new Vue({
    el: '#menu-menu2-1',
    data: {
        products: products
    },
    computed: {
        count() {
            return this.products.length;
        }
    }
});