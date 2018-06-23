<?php
	/*  
		Размеры изображений для разной ширины
		_4K - 4000px
		_Retina - 2560px
		_1080p - 1920px
		_720p - 1440px
		_Phones - 800px

		mainStock - выделенная акция <- Главная
		frontStock - фото для акций <- Главная
		frontTeam - фото команды <- Главная
		shopMaster - фото директора компании <- Магазин
		shopGallery - фотогалерея <- Магазин
		shopTeam - фото команды <- Магазин
		frontPost - изображение поста <- Главная
		frontCategory - изображения категорий <- Главная
		blogSticky [frontPost] - фото закрепленной записи <- Блог
	*/
	if ( function_exists( 'add_image_size' ) ) {
		add_image_size( 'blurredPreview', 20, 9999);

		add_image_size( 'mainStock_4K', 4000, 9999);
		add_image_size( 'mainStock_Retina', 2560, 9999);
		add_image_size( 'mainStock_1080p', 1920, 9999);
		add_image_size( 'mainStock_720p', 1440, 9999);
		add_image_size( 'mainStock_Phones', 800, 9999);

		add_image_size( 'frontStock_4K', 790, 9999);
		//add_image_size( 'frontStock_1080p', 375, 9999); - shopMaster_1080p
		add_image_size( 'frontStock_Phones', 400, 9999);

		add_image_size( 'frontTeam_4K', 1470, 9999);
		//add_image_size( 'frontTeam_Retina', 940, 9999); - shopGallery_Retina
		//add_image_size( 'frontTeam_1080p', 705, 9999); - frontPost_1080p
		//add_image_size( 'frontTeam_720p', 530, 9999); - frontPost_720p

		add_image_size( 'shopMaster_4K', 880, 9999);
		add_image_size( 'shopMaster_1080p', 420, 9999);

		add_image_size( 'shopGallery_4K', 1530, 9999);
		add_image_size( 'shopGallery_Retina', 980, 9999);
		//add_image_size( 'shopGallery_1080p', 740, 9999); - frontPost_1080p
		//add_image_size( 'shopGallery_720p', 550, 9999); - frontPost_720p
		//add_image_size( 'shopGallery_Phones', 800, 9999); - mainStock_Phones

		add_image_size( 'shopTeam_4K', 3430, 9999);
		add_image_size( 'shopTeam_Retina', 2200, 9999);
		add_image_size( 'shopTeam_1080p', 1650, 9999);
		add_image_size( 'shopTeam_720p', 1240, 9999);
		//add_image_size( 'shopTeam_Phones', 800, 9999); - mainStock_Phones

		add_image_size( 'frontPost_4K', 1620, 9999);
		add_image_size( 'frontPost_Retina', 1040, 9999);
		add_image_size( 'frontPost_1080p', 780, 9999);
		add_image_size( 'frontPost_720p', 590, 9999);
		//add_image_size( 'frontPost_Phones', 800, 9999); - mainStock_Phones

		add_image_size( 'frontCategory_4K', 580, 9999);
		add_image_size( 'frontCategory_1080p', 280, 9999);
		//add_image_size( 'frontCategory_Phones', 800, 9999); - mainStock_Phones
	}
?>