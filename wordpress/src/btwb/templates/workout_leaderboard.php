{{^is_public_gym}}
  <p>The workouts for this Gym are set to Members only.  To display them here, adjust the Gym Privacy Settings on Beyond the Whiteboard to Show WODs to "Everyone."</p>
{{/is_public_gym}}

{{workout.name}} Leaderboard<br/>
{{workout_url}}<br/>
{{workout_description}}<br/>

Male Leaderboard
<ul>
{{#male_leaderboard}}
  <li>
    {{member_name}}
    {{member_logo_url}}
    {{result}}
    {{notes}}
    {{session_date_string}}
    {{is_prescribed}}
    {{is_personal_record}}
  </li>
{{/male_leaderboard}}
</ul>

Female Leaderboard
<ul>
{{#female_leaderboard}}
  <li>
    {{member_name}}
    {{member_logo_url}}
    {{result}}
    {{notes}}
    {{session_date_string}}
    {{is_prescribed}}
    {{is_personal_record}}
  </li>
{{/female_leaderboard}}
</ul>
