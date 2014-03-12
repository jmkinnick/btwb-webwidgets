var BTWB_GYM_WOD_URL = "//localhost:3000/webwidgets/gyms/wods";
var BTWB_GYM_ACTIVITIES_URL = "//localhost:3000/webwidgets/gyms/activities";
var BTWB_GYM_LEADERBOARD_URL = "//localhost:3000/webwidgets/gyms/leaderboard";

// Uses JSONP to load HTML into an element.
function btwbLoadHtml($, apiKey, element, url, params) {
  $.ajax({
    dataType: "jsonp",
    url: url,
    data: params,
    success: function(data) {
      $(element).html(data.html);
    },
    complete: function(jqxhr, textStatus) {
      console.log(textStatus);
    }
  });
}

function btwbLoadElement($, apiKey, selector, url) {
  $.each($(selector), function(i, e) {
    var element = $(e);
    var params = element.data("params");
    params.api_key = apiKey;

    // Trigger the load
    btwbLoadHtml($, apiKey, element, url, params);

    // Update the landing page anchor
    $.each(element.find('a.btwb_landing_page'), function(i, anchor) {
      $(anchor).attr('href', url.concat('?', $.param(params)));
    });
  });
}

// btwbInitialize starts our btwb loading process
function btwbInitialize($, config) {
  var apiKey = config.apiKey
  $(function() {
    btwbLoadElement($, apiKey, ".btwb_gym_wod", BTWB_GYM_WOD_URL);
    btwbLoadElement($, apiKey, ".btwb_gym_activities", BTWB_GYM_ACTIVITIES_URL);
    btwbLoadElement($, apiKey, ".btwb_gym_leaderboard", BTWB_GYM_LEADERBOARD_URL);
  });
};
