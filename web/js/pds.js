$(document).ready(function () {
    $(".star-rating li a").click(function () {
        console.log($(this).html());
        $.post("/vote/create", {

        }, function () {
            console.log(arguments)
        });
        return false;
    });

    var story = $('.story .body');
    var pages = story.html().split("[pagebreak]");
    story.html(pages.join("<br><br>"));


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
});
