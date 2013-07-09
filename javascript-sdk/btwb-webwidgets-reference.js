var BTWB_GYM_WOD_URL = "//localhost:3000/webwidgets/gyms/wods";
var BTWB_GYM_WOD_LIST_URL = "//localhost:3000/webwidgets/gyms/wods_list";
var BTWB_GYM_ACTIVITIES_URL = "//localhost:3000/webwidgets/gyms/activities";
var BTWB_GYM_LEADERBOARD_URL = "//localhost:3000/webwidgets/gyms/leaderboard";

// Uses JSONP to load HTML into an element.
function btwbLoadHtml($, apiKey, element, url, params) {
  $.getJSON(url + "?jsonp=?", params, function(data) {
    $(element).html(data.html);
  });
}

function btwbLoadElement($, apiKey, selector, url) {
  $.each($(selector), function(i, e) {
    var element = $(e);
    var params = element.data("params");
    params.api_key = apiKey;
    btwbLoadHtml($, apiKey, element, url, params);
  });
}

// btwbInitialize starts our btwb loading process
function btwbInitialize($, config) {
  var apiKey = config.apiKey
  $(function() {
    btwbLoadElement($, apiKey, ".btwb_gym_wod", BTWB_GYM_WOD_URL);
    btwbLoadElement($, apiKey, ".btwb_gym_wod_list", BTWB_GYM_WOD_LIST_URL);
    btwbLoadElement($, apiKey, ".btwb_gym_activities", BTWB_GYM_ACTIVITIES_URL);
    btwbLoadElement($, apiKey, ".btwb_gym_leaderboard", BTWB_GYM_LEADERBOARD_URL);
  });
};
