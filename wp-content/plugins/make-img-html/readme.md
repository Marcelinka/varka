# Make Image HTML from ACF Plugin Array

Плагин нужно поместить в директорию **/wp-content/plugins**.

Подключение плагина делает доступной функцию **make_img_html($data, $images_tpl, $sizes, $class, $standart)**.

* **$data** - оригинальный массив изображений из ACF
* **$images_tpl** - шаблон для генерирования массива $images (массив вида $width_screen => $name_of_size от меньшего к большему)
* **$sizes** - маccив относительных размеров для картинок на разных разрешениях экрана
* **$class** - класс для изображения. По умолчанию: ''
* **$standart** - ширина экрана для стандартного изображения (запись в src). По умолчанию: '1920'

Пример использования

```
    echo make_img_html(
        // массив из acf
        get_field('towers_img', $id),
        // шаблон для массива $iamges
        array (
            '1440' => 'towers_720p',
            '1920' => 'towers_1080p',
            '2560' => 'towers_Retina',
            '4000' => 'towers_4K'
        ),
        // относительные размеры изорбажений
        array(
            '800'  => '100vw',
            '1440' => '100vw',
            '1920' => '100vw',
            '2560' => '100vw',
            '4000' => '100vw'
        )
    );
```