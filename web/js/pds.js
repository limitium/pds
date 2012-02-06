$(document).ready(function () {

    /**
     * story format
     */

    var story = $('.story .body');
    var pages = story.html().split("[pagebreak]");
    story.html(pages.join("<br><br>"));

    /**
     * comments
     */

    var commenting = false;
    $("#form_comment").submit(function () {
        if (!commenting) {
            commenting = true;
            var button = $("#form_comment button");
            var loader = $("#form_comment .ajax-loader");
            button.addClass('disabled');
            var values = {};
            var form = $(this);
            $.each(form.serializeArray(), function (i, field) {
                values[field.name] = field.value;
            });
            loader.css("visibility", "visible");
            $.post(form.attr("action"), values, function (html) {
                commenting = false;
                button.removeClass('disabled');
                $("#comment_message").val("");
                loader.css("visibility", "hidden");
                form.before(html);
            });
        }
        return false;
    })

    /***
     * ratings
     */
    var voting = false;
    $(".star-rating li a").click(function () {
        if (!voting) {
            voting = true;
            var loader = $(".meta .ajax-loader");
            var form = $("#form_vote");
            var values = {};
            loader.css("visibility", "visible");
            $.each(form.serializeArray(), function (i, field) {
                values[field.name] = field.value;
            });

            values["vote[value]"] = $(this).html();

            $.post(form.attr("action"), values, function (rating) {
                voting = false;
                loader.css("visibility", "hidden");
                $(".rating-value").html(rating);
            });
        }
        return false;
    });

});
