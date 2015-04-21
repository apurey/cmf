/**
 * Created with JetBrains PhpStorm.
 * User: krok
 * Date: 21.04.14
 * Time: 15:43
 */

jQuery(function () {

    /* highslide */

    hs.registerOverlay({
        html: '<div class="closebutton" onclick="return hs.close(this)" title="Close"></div>',
        position: 'top right',
        fade: 2
    });

    hs.graphicsDir = '/based/assets/dist/highslide/graphics/';
    hs.outlineType = 'rounded-white';
    hs.wrapperClassName = 'draggable-header no-footer';
    hs.showCredits = false;

    $('.highslide').click(function (e) {
        e.preventDefault();
        hs.expand(this);
    });

    /* /highslide */
});
