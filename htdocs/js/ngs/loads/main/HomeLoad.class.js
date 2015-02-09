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
        jQuery('#screen-blocker').css({display: 'none'});
        jQuery('#beelineBtn').click(function () {
            jQuery('#screen-blocker').css({display: 'block'});
            ngs.load('beeline', {});
        });
        jQuery('#orangeBtn').click(function () {
            jQuery('#screen-blocker').css({display: 'block'});
            ngs.load('orange', {});
        });
        //var audio = new Audio(SITE_PATH + '/audio/test.wav');
        //audio.play();
    }
});
