ngs.HomeLoad = Class.create(ngs.AbstractLoad, {
    initialize: function ($super, shortCut, ajaxLoader) {
        $super(shortCut, "main", ajaxLoader);
    },
    getUrl: function () {
        return "home";
    },
    getMethod: function () {
        return "POST";
    },
    getContainer: function () {
        return "main_content_container";
    },
    getName: function () {
        return "home";
    },
    afterLoad: function () {
        jQuery('#main_content_container').stop();
        jQuery('#main_content_container').css({'opacity':'1'});
        jQuery('#beelineBtn').click(function () {
            jQuery('#main_content_container').animate({opacity:'0'}, 500);
            ngs.load('beeline', {});
        });
        jQuery('#orangeBtn').click(function () {
            jQuery('#main_content_container').animate({opacity:'0'}, 50);
            ngs.load('orange', {});
        });
        //var audio = new Audio(SITE_PATH + '/audio/test.wav');
        //audio.play();
    }
});
