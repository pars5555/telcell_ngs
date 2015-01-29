ngs.BeelineLoad = Class.create(ngs.AbstractLoad, {
    initialize: function($super, shortCut, ajaxLoader) {
        $super(shortCut, "main", ajaxLoader);
    },
    getUrl: function() {
        return "beeline";
    },
    getMethod: function() {
        return "POST";
    },
    getContainer: function() {
        return "main_content_container";
    },
    getName: function() {
        return "beeline";
    },
    afterLoad: function() {
        jQuery('#back_to_home').click(function(){
            ngs.load('home', {});
        });
    }
});
