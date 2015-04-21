/**
 * Created with JetBrains PhpStorm.
 * User: krok
 * Date: 21.04.14
 * Time: 15:43
 */
jQuery(window).error(function (msg, url, line) {
    jQuery.post('/page/error.html', { msg: msg, url: url, line: line });
});
