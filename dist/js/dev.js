/**
 * Created with JetBrains PhpStorm.
 * User: krok
 * Date: 21.04.14
 * Time: 15:43
 */
jQuery(function () {
    jQuery('img').error(function () {
        jQuery(this).attr({
            'data-src': jQuery(this).attr('src'),
            'src': '/dist/img/broken-image.png',
            'title': 'Broken image'
        });
    });
});
