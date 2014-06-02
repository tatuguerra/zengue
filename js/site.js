jQuery(document).ready(function($) {

    jQuery.fn.center = function () {
        x = $(this).parent();
        this.css("top", Math.max(0, ((x.height() - $(this).outerHeight()) / 2)) + "px");
        return this;
    }

    $(".tweets > .orbit-container").center();
    $(".links-list").center();

});
