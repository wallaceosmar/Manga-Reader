/* MangaReader MangaReader.js
 * 
 * @Author  Wallace Osmar
 * @Support <https://github.com/wallaceosmar>
 * @Email   <wallaceosmar@r7.com>
 * @version 0.1.0
 * @license MIT <http://opensource.org/licenses/MIT>
 */

if ( typeof jQuery === 'undefined' ) {
    throw new Error("MangaReader requires jQuery");
}

/**
 * 
 */
$.MangaReader = {};

/**
 * MangaReader Options
 * 
 * @type type
 */
$.MangaReader.options = {
    
    URL_ADMIN_PAGE: '/admin/'
    
};

/**
 * 
 * @type type
 */
$.MangaReader = $.MangaReader.prototype = {
    
    init: function () {
        
    },
    
}

$(function(){
    
    //Extend options if external options exist
    if (typeof AdminLTEOptions !== "undefined") {
        $.extend(true, $.MangaReader.options, MangaReaderOptions);
    }
    
    $.MangaReader.init();
    
});