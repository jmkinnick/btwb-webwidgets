Recent Gym Activity

{{^is_public_gym}}
  The workouts for this Gym are set to Members only.  To display them here, adjust the Gym Privacy Settings on Beyond the Whiteboard to Show WODs to "Everyone."
{{/is_public_gym}}

{{#activities}}
<ul class="btwb-result-list">
  {{#workout_session}}
    <li>
    <img src="{{member_logo_url}}" class="athlete-image"/>
    <div class="btwb-result-container">
	    <div class="btwb-athlete-name">{{member_name}}</div>
            <div class="btwb-result-attributes">
	    <span><small>{{time_ago}}</small> via</span>
            <span> 
	    <a href="http://www.beyondthewhiteboard.com">
     	    <img src="https://s3.amazonaws.com/assets.beyondthewhiteboard.com/images/btwb-icon.png"/></a></span>
		{{#is_personal_record}}
<span><img src="https://s3.amazonaws.com/assets.beyondthewhiteboard.com/images/personal_record_icon_width_15.png"/></span>	
	        {{/is_personal_record}}
	    </div>
          
	    <hr/>
	    <div class="btwb-result">
		<div class="btwb-result-score">
			{{result}}
			{{#is_prescribed}} | Rx'd {{/is_prescribed}}
			{{^is_prescribed}} | Non Rx'd {{/is_prescribed}}
		</div>
		<div class="btwb-result-score-notes">{{notes}}</div>	      
	    </div>
    </div>
  </li>
  {{/workout_session}}
</ul>

{{/activities}}

{{^activities}}
  There are no recent results. Please check back later.
{{/activities}}

