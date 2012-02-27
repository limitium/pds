$(document).ready(function() {
    var commenting, showStar, stars, voting;
    commenting = false;
    $("#form_comment").submit(function() {
        var button, form, loader, values;
        if (!commenting) {
            commenting = true;
            button = $("#form_comment button");
            loader = $("#form_comment .ajax-loader");
            button.addClass("disabled");
            values = {};
            form = $(this);
            $.each(form.serializeArray(), function(i, field) {
                return values[field.name] = field.value;
            });
            loader.css("visibility", "visible");
            $.post(form.attr("action"), values, function(html) {
                commenting = false;
                button.removeClass("disabled");
                $("#comment_message").val("");
                loader.css("visibility", "hidden");
                return form.before(html);
            });
        }
        return false;
    });
    showStar = function() {
        return $(".meta .icon-star").css({
            display: "inline-block"
        });
    };
    stars = $(".star-rating li a");
    if (stars.length) {
        voting = false;
        $(".star-rating li a").click(function() {
            var form, loader, values;
            if (!voting) {
                voting = true;
                loader = $(".meta .ajax-loader");
                form = $("#form_vote");
                values = {};
                loader.css("visibility", "visible");
                $.each(form.serializeArray(), function(i, field) {
                    return values[field.name] = field.value;
                });
                values["vote[value]"] = $(this).html();
                $.post(form.attr("action"), values, function(rating) {
                    voting = false;
                    loader.css("visibility", "hidden");
                    $(".rating-value").html(rating);
                    $(".star-rating").hide();
                    return showStar();
                });
            }
            return false;
        });
    } else {
        showStar();
    }
    $(".carousel-inner").html("<div class='item'>" + $(".carousel-inner").html().split("[pagebreak]").join("</div><div class='item'>") + "</div>");
    return $("#myCarousel").carousel({
        interval: 10000000
    }).carousel("next");
});