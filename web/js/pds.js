$(document).ready(function() {
    var changePosition, commenting, refreshLineno, reorderPages, setLineno, showStar, stars, voting;
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
            return $.post(form.attr("action"), values, function(html) {
                commenting = false;
                button.removeClass("disabled");
                $("#comment_message").val("");
                loader.css("visibility", "hidden");
                return form.before(html);
            });
        }
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
                return $.post(form.attr("action"), values, function(rating) {
                    voting = false;
                    loader.css("visibility", "hidden");
                    $(".rating-value").html(rating);
                    $(".meta .star-rating").hide();
                    return showStar();
                });
            }
        });
    } else {
        showStar();
    }
    setLineno = function(page, lineno) {
        page.attr("data-page", lineno);
        $(".page-number", page).html(lineno);
        return $($("input", page)[0]).val(lineno);
    };
    refreshLineno = function() {
        return $("#story_Pages li").each(function(i, li) {
            return setLineno($(this), i + 1);
        });
    };
    reorderPages = function() {
        var cont, newOrder, page, _i, _len, _results;
        newOrder = [];
        $("#story_Pages li").each(function(i, li) {
            return newOrder[parseInt($(li).attr("data-page"))] = li;
        });
        cont = $("#story_Pages");
        _results = [];
        for (_i = 0, _len = newOrder.length; _i < _len; _i++) {
            page = newOrder[_i];
            _results.push(cont.append(page));
        }
        return _results;
    };
    refreshLineno();
    $(document).delegate(".story-page-header .page-number", "click", function() {
        var pageData;
        pageData = $(this).parent().siblings(".story-page-data");
        if (pageData.is(":visible")) {
            return pageData.slideUp();
        } else {
            return pageData.slideDown();
        }
    });
    $(document).delegate(".story-page-header .page-delete", "click", function() {
        $(this).parents("li").slideUp(function() {
            $(this).remove();
            return refreshLineno();
        });
        return false;
    });
    changePosition = function(page, delta) {
        var curLineno, toLineno;
        curLineno = parseInt(page.attr("data-page"));
        toLineno = curLineno + delta;
        if ((delta === -1 && curLineno === 1) || (delta === 1 && curLineno === page.siblings().length + 1)) {
            return;
        }
        setLineno($("li[data-page=" + toLineno + "]"), curLineno);
        setLineno(page, toLineno);
        return reorderPages();
    };
    $(document).delegate(".story-page-header .page-up", "click", function() {
        changePosition($(this).parents("li"), -1);
        return false;
    });
    $(document).delegate(".story-page-header .page-down", "click", function() {
        changePosition($(this).parents("li"), +1);
        return false;
    });
    $(".add-page").click(function() {
        var pages;
        pages = $("#story_Pages");
        pages.append(pages.attr("data-prototype").split("$$name$$").join(pages.children().length));
        refreshLineno();
        return false;
    });
    $(".add-video").click(function() {
        $("#video-upload").modal();
        return false;
    });
    $("#video-upload button").click(function() {
        var bar, progress, progressHelp;
        progress = $("#video-upload .progress").css({
            display: "block"
        });
        progressHelp = $("#video-upload .progress-help").css({
            display: "block"
        });
        bar = progress.children().css({
            width: "0%"
        });
        progress.removeClass("progress-info").addClass("progress-success");
        progressHelp.html("Uploading...");
        $("#video-upload form").ajaxSubmit({
            uploadProgress: function(e, position, total, percent) {
                if (percent > 98) {
                    percent = 100;
                    progressHelp.html("Sending to youtube...");
                    progress.removeClass("progress-success").addClass("progress-info");
                }
                return bar.css({
                    width: percent + "%"
                });
            },
            success: function(data) {
                console.log(arguments);
                progress.css({
                    display: "none"
                });
                progressHelp.css({
                    display: "none"
                });
                data = $.parseJSON(data);
                console.log(data);
                $(".videos").append('<li data-player="' + data.player + '"><a href="' + data.url + '"><img src="' + data.thumbnail + '"/></a></li>');
                return $("#video-upload").modal("hide");
            }
        });
        return false;
    });
    $("#myCarousel").carousel({
        interval: 10000
    }).carousel("next");
    return $("#story_date").datepicker({
        changeMonth: true,
        changeYear: true
    });
});