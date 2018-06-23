<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package varka25.ru
 */
?>

	</div><!-- #content -->
	
	<footer id="colophon" class="footer">
        <div class="footer__hrefs">
            <div class="container">     
                <?php wp_nav_menu( array(
                    'theme_location' => 'footer'
                ) ); ?>
            </div>
        </div>
        <div class="container footer__bottom">
            <div class="footer__bottom-part footer__review">
                <div class="footer__review-title">Оставить отзыв</div>
                <div class="footer__review-links">
                    <?php while ( have_rows('global_review_links', 'options') ) : the_row(); ?>
                        
                    <div class="footer__review-link"><a class="footer__review-href" href="<?= the_sub_field('global_review_href') ?>"><?= the_sub_field('global_review_name') ?></a></div>

                    <?php endwhile; ?>
                </div>
            </div>
            <div class="footer__bottom-part footer__contacts">
                <div class="footer__contact"><a href="tel:<?= get_field('global_phone', 'options') ?>">
                    <div class="footer__icon"></div>
                    <?= get_field('global_phone', 'options') ?>
                    </a></div>
                <div class="footer__contact">
                    <a href="https://api.whatsapp.com/send?phone=<?= preg_replace('~\D+~','',get_field('global_whatsapp', 'options')) ?>">
                        <?= get_field('global_whatsapp', 'options') ?>
                    </a>
                </div>
                <div class="footer__contact"><a href="mailto:<?= get_field('global_email', 'options') ?>">
                    <?= get_field('global_email', 'options') ?>
                    </a></div>
            </div>
            <div class="footer__bottom-part footer__buttons">
                <div class="footer__button-wrapper"><button class="btn btn_black footer__button">Оставить заявку</button></div>
                <div class="footer__button-wrapper"><button class="btn btn_black footer__button back-call-button">Заказать звонок</button></div>
                <div class="footer__button-wrapper"><button class="btn btn_black footer__button gift-button">Подарочный сертификат</button></div>
            </div>
        </div>
	</footer><!-- #colophon -->

    <div id="map" class="map"></div>
</div><!-- #page -->

<div class="modal-wrapper back-call back-call_hidden">
    <div class="modal-wrapper__overlay back-call__overlay"></div>
    <div class="footer__form back-call__content">
        <button class="back-call__close" id="back-call-close"><?= file_get_contents( get_template_directory_uri().'/img/svg/close-button.svg' ) ?></button>
        <h2 class="footer__form-title">Обратная связь</h2>
        <?= do_shortcode('[contact-form-7 id="4" title="Обратный звонок"]') ?>
    </div>
</div>

<div class="modal-wrapper gift gift_hidden">
    <div class="modal-wrapper__overlay gift__overlay"></div>
    <div class="footer__form back-call__content">
        <button class="back-call__close" id="gift-close"><?= file_get_contents( get_template_directory_uri().'/img/svg/close-button.svg' ) ?></button>
        <h2 class="footer__form-title">Подарочный<br>сертификат</h2>
        <?= do_shortcode('[contact-form-7 id="8432" title="Подарочный сертификат"]') ?>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwIVTdeHYcTX47wZAmB3v7d3Lc9E8QiqQ&callback=initMap" async defer></script>
<script>
    var dvmotors = { lat: 43.166794, lng: 131.908669 }; 
    var map;
    var styles = [
    {
        "featureType": "water",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#d3d3d3"
            }
        ]
    },
    {
        "featureType": "transit",
        "stylers": [
            {
                "color": "#808080"
            },
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#b3b3b3"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#ffffff"
            },
            {
                "weight": 1.8
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "color": "#d7d7d7"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#ebebeb"
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#a7a7a7"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#efefef"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#696969"
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#737373"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "color": "#d6d6d6"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {},
    {
        "featureType": "poi",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#dadada"
            }
        ]
    }
]
  function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      center: dvmotors,
      zoom: 17,
      zoomControl: true,
      mapTypeControlOptions: {
        mapTypeIds: ['Styled']
      },
      disableDefaultUI: true,
      mapTypeId: 'Styled',
    });
    var styledMapType = new google.maps.StyledMapType(styles, { name: 'Styled' });
    map.mapTypes.set('Styled', styledMapType);  
    var marker = new google.maps.Marker({
	    position: dvmotors,
	    map: map,
	    title: 'Varka'
	  });
    var contentString = '<div class="map__popup"><p>Владивосток, ул. Русская 9Б</p><p>Varka</p></div>';
    var infowindow = new google.maps.InfoWindow({
        content: contentString
      });
    marker.addListener('click', function() {
        infowindow.open(map, marker);
      });
  }
</script>

<?php wp_footer(); ?>

</body>
</html>
