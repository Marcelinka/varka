<?php

/*
	Template Name: Wislist
*/

	get_header(); ?>

	<div class="wishlist-wrapper container">
		<h2 class="wishlist__title">Wishlist</h2>
		<section class="wishlist" id="vue-wishlist">
			<div class="wishlist__items">
				<div class="wishlist__item" v-for="(product, index) in products">
					<div class="wishlist__image-wrapper">
						<img class="wishlist__image" :src="product.image">
					</div>
					<div class="wishlist__text wishlist__name"><a class="wishlist__link" :href="product.link" v-text="product.name"></a></div>
					<div class="wishlist__text wishlist__variation" v-text="product.variation"></div>
					<div class="wishlist__text wishlist__details wishlist__count" v-text="product.count + ' шт.'"></div>
					<div class="wishlist__text wishlist__details" v-text="product.price + ' руб'"></div>
					<button class="wishlist__button" @click="deleteItem($event, index)"><?= file_get_contents( get_template_directory_uri().'/img/svg/close-button.svg' ) ?></button>
				</div>
			</div>

			<div class="wishlist__buttons">
				<button class="btn wishlist__btn" @click="showForm">Сформировать заказ</button>
				<button class="btn wishlist__btn" @click="downloadPdf">Скачать PDF</button>
			</div>

			<div class="wishlist__form-wrapper" v-show="form" @submit.prevent="sendOrder">
				<form class="wishlist__form">
					<button @click="closeForm" type="button" class="wishlist__cross">
						<?= file_get_contents( get_template_directory_uri().'/img/svg/close-button.svg' ) ?>
					</button>
					<h2 class="wishlist__form-title">Заказ</h2>
					<label class="wishlist__label">
						Ваше имя
						<input type="text" required v-model="person.name" class="wishlist__input">
					</label>
					<label class="wishlist__label">
						Ваш e-mail
						<input type="email" required v-model="person.email"  class="wishlist__input">
					</label>
					<label class="wishlist__label">
						Ваш телефон
						<!--<input type="tel" required placeholder="+7 (___) ___-__-__" v-model="person.phone">-->
						<the-mask mask="+7 (###) ###-##-##" type="tel" :masked="true" placeholder="+7 (___) ___-__-__" v-model="person.phone" required  class="wishlist__input"></the-mask>
					</label>
					<label class="label-checkbox">
						<input type="checkbox" checked class="wishlist__accept" required>
						Я согласен на обработку <a href="/protect">персональных данных</a>
					</label>
					<div class="wishlist__form-button-wrapper">
						<button type="submit" v-text="button.text" :disabled="button.block" 
								class="btn wishlist__form-button"></button>
					</div>
				</form>
			</div>
		</section>
	</div>

<?php
	get_footer();