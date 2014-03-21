{{^is_public_gym}}
  <p>The workouts for this Gym are set to Members only.  To display them here, adjust the Gym Privacy Settings on Beyond the Whiteboard to Show WODs to "Everyone."</p>
{{/is_public_gym}}

<div>
  {{#wodsets}}
    <div>
      {{track_name}} - {{date_string}}

      <ul>
      {{#wods}}
        <li>
          Workout: {{workout_name}}<br/>
          Description: {{workout_description}}</br>
          Section: {{wod_section}}<br/>
          Instructions: {{wod_instructions}}<br/>

          <div>
          Wod Leaderboard
          {{#wod_leaderboard}}
            Male Results:
            <ul>
              {{#male_results}}
                <li>
                  {{member_name}}
                  {{member_logo_url}}
                  {{result}}
                  {{notes}}
                  {{session_time}}
                  {{is_prescribed}}
                  {{is_personal_record}}
                </li>
              {{/male_results}}
            </ul>

            Female Results:
            <ul>
              {{#female_results}}
                <li>
                  {{member_name}}
                  {{member_logo_url}}
                  {{result}}
                  {{notes}}
                  {{session_time}}
                  {{is_prescribed}}
                  {{is_personal_record}}
                </li>
              {{/female_results}}
            </ul>
          {{/wod_leaderboard}}
          </div>

          <div>
          Recent Results
          Recent Results Count: {{wod_results_count}}
          Recent Results URL: {{wod_results_url}}
          <ul>
            {{#wod_recent_results}}
              <li>
                {{member_name}}
                {{member_logo_url}}
                {{result}}
                {{notes}}
                {{session_time}}
                {{is_prescribed}}
                {{is_personal_record}}
              </li>
            {{/wod_recent_results}}
          </ul>
          </div>
        </li>
      {{/wods}}
      </ul>
      {{^wods}}
        No Wods Assigned for this Track.
      {{/wods}}
    </div>
  {{/wodsets}}
  {{^wodsets}}
    No Wods Assigned to Any Tracks For Given Date Range.
  {{/wodsets}}
</div>
