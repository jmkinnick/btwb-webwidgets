Recent Gym Activity

{{^is_public_gym}}
  The workouts for this Gym are set to Members only.  To display them here, adjust the Gym Privacy Settings on Beyond the Whiteboard to Show WODs to "Everyone."
{{/is_public_gym}}

{{#activities}}
<ul>
  {{#workout_session}}
    <li>
      Member: {{member_name}}<br/>
      MemberImg: {{member_logo_url}}<br/>

      TimeAgo: {{time_ago}}<br/>
      PR: {{#is_personal_record}}
          http://assets.beyondthewhiteboard.com/images/personal_record_icon_width_25.png<br/>
      {{/is_personal_record}}
      RXD: {{#is_prescribed}}
          http://assets.beyondthewhiteboard.com/images/rxd_icon_width_25.png<br/>
      {{/is_prescribed}}
      Result: {{result}}<br/>
      Notes: {{notes}}<br/>
    </li>
  {{/workout_session}}
</ul>
{{/activities}}

{{^activities}}
  There are no recent results. Please check back later.
{{/activities}}
