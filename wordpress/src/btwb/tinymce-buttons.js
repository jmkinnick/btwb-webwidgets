(function() {

  var date_prompt =
    "Enter Date (Format YYYY-MM-DD, eg 2013-02-29)";
  var workoutid_prompt =
    "Enter Numeric WorkoutId for Leaderboard (eg 1)";

  var shortcode_adder = function(shortcode, promptStr, attrName) {
    return function() {
      var attrValue = '';
      if(promptStr && attrName) {
        attrValue = ' '.concat(attrName, '="', prompt(promptStr), '"');
      }
      var selected = tinyMCE.activeEditor.selection.getContent();
      content = selected.concat('[', shortcode, attrValue, ']');
      tinymce.execCommand('mceInsertContent', false, content);
    };
  }

  tinymce.create('tinymce.plugins.BtwbTinyMceButtonsPlugin', {
    init : function(ed, url) {
      // Register commands for each short code
      ed.addCommand('btwb_insert_shortcode_wod',
        shortcode_adder('wod', date_prompt, 'date'));
      ed.addCommand('btwb_insert_shortcode_wod_list',
        shortcode_adder('wod_list', date_prompt, 'date'));
      ed.addCommand('btwb_insert_shortcode_activities',
        shortcode_adder('activities', null, null));
      ed.addCommand('btwb_insert_shortcode_leaderboard',
        shortcode_adder('leaderboard', workoutid_prompt, 'workout_id'));

      // Register buttons to trigger the above commands
      ed.addButton(
        'btwb_button_wod',
        {
          title: 'Insert wod',
          cmd: 'btwb_insert_shortcode_wod',
          image: url + '/images/button_wod.png'
        });
      ed.addButton(
        'btwb_button_wod_list',
        {
          title: 'Insert wod_list',
          cmd: 'btwb_insert_shortcode_wod_list',
          image: url + '/images/button_wod_list.png'
        });
      ed.addButton(
        'btwb_button_activities',
        {
          title: 'Insert activities',
          cmd: 'btwb_insert_shortcode_activities',
          image: url + '/images/button_activities.png'
        });
      ed.addButton(
        'btwb_button_leaderboard',
        {
          title: 'Insert leaderboard',
          cmd: 'btwb_insert_shortcode_leaderboard',
          image: url + '/images/leaderboard.png'
        });
    },
  });

  tinymce.PluginManager.add(
      'btwb_tinymce_buttons',
      tinymce.plugins.BtwbTinyMceButtonsPlugin);
})();
