$(function () {
  let regex = /[#|@](\w+)$/gi;

  $(document).on("keyup", ".status", function () {
    let content = $.trim($(this).val());
    let text = content.match(regex);
    let max = 140;

    if (text !== null) {
      let dataString = "hashtag=" + text;

      $.ajax({
        type: "POST",
        url: baseURL+"core/ajax/getHashtag.php",
        data: dataString,
        cache: false,
        success: function (data) {
          $(".hash-box ul").html(data);
          $(".hash-box li").click(function () {
            let value = $.trim($(this).find(".getValue").text());
            let oldContent = $(".status").val();
            let newContent = oldContent.replace(regex, "");

            $(".status").val(newContent + value + " ");
            $(".hash-box li").hide();
            $(".status").focus();

            $("#count").text(max - content.length);
          });
        },
      });
    } else {
      $(".hash-box li").hide();
    }
    $("#count").text(max - content.length);
    if (content.length >= max) {
      $("#count").css("color", "#f00");
    } else {
      $("#count").css("color", "#000");
    }
  });
});
