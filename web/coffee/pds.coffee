$(document).ready ->
  commenting = false
  $("#form_comment").submit ->
    unless commenting
      commenting = true
      button = $("#form_comment button")
      loader = $("#form_comment .ajax-loader")
      button.addClass "disabled"
      values = {}
      form = $(this)
      $.each form.serializeArray(), (i, field) ->
        values[field.name] = field.value

      loader.css "visibility", "visible"
      $.post form.attr("action"), values, (html) ->
        commenting = false
        button.removeClass "disabled"
        $("#comment_message").val ""
        loader.css "visibility", "hidden"
        form.before html
    false

  showStar = -> $(".meta .icon-star").css display: "inline-block"
  stars = $(".star-rating li a")
  if stars.length
    voting = false
    $(".star-rating li a").click ->
      unless voting
        voting = true
        loader = $(".meta .ajax-loader")
        form = $("#form_vote")
        values = {}
        loader.css "visibility", "visible"
        $.each form.serializeArray(), (i, field) ->
          values[field.name] = field.value

        values["vote[value]"] = $(this).html()
        $.post form.attr("action"), values, (rating) ->
          voting = false
          loader.css "visibility", "hidden"
          $(".rating-value").html rating
          $(".star-rating").hide()
          showStar()
      false
  else
    showStar()

  $(".add-page").click ->
    pages = $("#story_Pages")
    pages.append pages.attr("data-prototype").split("$$name$$").join(pages.children().length)
    return false

  $(".carousel-inner").html "<div class='item'>"+$(".carousel-inner").html().split("[pagebreak]").join("</div><div class='item'>")+"</div>"
  $("#myCarousel").carousel(interval: 10000000).carousel "next"
