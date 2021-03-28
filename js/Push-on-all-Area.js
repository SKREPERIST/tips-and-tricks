jQuery(document).ready(function ($) {
  jQuery("#blog_one .post").click(function () {
    var data_link = $(this).find(".more-link").attr("href");
    window.location.href = data_link;
  });
});
