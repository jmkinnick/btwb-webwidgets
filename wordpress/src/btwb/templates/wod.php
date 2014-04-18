{{^is_public_gym}}
  <p>The workouts for this Gym are set to Members only.  To display them here, adjust the Gym Privacy Settings on Beyond the Whiteboard to Show WODs to "Everyone."</p>
{{/is_public_gym}}

<div>
  {{#wodsets}}
    <div>
      <ul class="btwb-wod-list">
      {{#wods}}
        <li>
          <h5>{{workout_name}}</h5>
	  <small><u>{{wod_section}}:</u> {{track_name}} - {{date_string}}</small>
          <p class="btwb-workout-description">{{workout_description}}</p>
          <p><i>{{wod_instructions}}</i></p>
          <hr/>

          {{#wod_leaderboard}}
          <div class="btwb-leaderboard">
		<div class="btwb-mens-leaderboard">
		<h5>Men's Leaderboard</h5>
			<hr/>
			<ol class="btwb-result-list">
			{{#male_results}}
				<li class="clearfix">
				    <img src="{{member_logo_url}}" class="athlete-image"/>
				    <div class="btwb-result-container">
				    <div class="btwb-athlete-name">{{member_name}}</div>
				            <div class="btwb-result-attributes">
					    <span><small>{{session_time}}</small> via</span>
				            <span> 
						    <a href="{{result_url}}">
		     	    <img src="https://s3.amazonaws.com/assets.beyondthewhiteboard.com/images/btwb-icon.png"/></a></span>
		{{#is_personal_record}}
<span><img src="https://s3.amazonaws.com/assets.beyondthewhiteboard.com/images/personal_record_icon_width_15.png"/></span>	
	        {{/is_personal_record}}
	    </div>
          
	    <hr/>
	    <div class="btwb-result">
		<div class="btwb-result-score">
			<a href="{{result_url}}">{{result}}
			{{#is_prescribed}} | Rx'd {{/is_prescribed}}
			{{^is_prescribed}} | Non Rx'd {{/is_prescribed}}
                        </a>
		</div>
		<div class="btwb-result-score-notes">{{notes}}</div>	      
	    </div>
    </div>
  </li>
{{/male_results}}
</ol>
</div>
<div class="btwb-womens-leaderboard">
<h5>Women's Leaderboard</h5>
<hr/>
<ol class="btwb-result-list">
{{#female_results}}
  <li class="clearfix">
    <img src="{{member_logo_url}}" class="athlete-image"/>
    <div class="btwb-result-container">
	    <div class="btwb-athlete-name">{{member_name}}</div>
            <div class="btwb-result-attributes">
	    <span><small>{{session_time}}</small> via</span>
            <span> 
	    <a href="{{result_url}}">
     	    <img src="https://s3.amazonaws.com/assets.beyondthewhiteboard.com/images/btwb-icon.png"/></a></span>
		{{#is_personal_record}}
<span><img src="https://s3.amazonaws.com/assets.beyondthewhiteboard.com/images/personal_record_icon_width_15.png"/></span>	
	        {{/is_personal_record}}
	    </div>
          
	    <hr/>
	    <div class="btwb-result">
		<div class="btwb-result-score">
			<a href="{{result_url}}">{{result}}
			{{#is_prescribed}} | Rx'd {{/is_prescribed}}
			{{^is_prescribed}} | Non Rx'd {{/is_prescribed}}
                        </a>
		</div>
		<div class="btwb-result-score-notes">{{notes}}</div>	      
	    </div>
    </div>
  </li>
{{/female_results}}
</ol>
</div>
<div style="clear:both;"></div>
</div>
     {{/wod_leaderboard}}
</div>


<div class="btwb-recent-results">
<hr/>
<h5><a href="{{wod_results_url}}">Recent WOD Results</a></h5>
<small>Total: {{wod_results_count}}</small>

<ul class="btwb-result-list">
  {{#wod_recent_results}}
    <li class="clearfix">
    <img src="{{member_logo_url}}" class="athlete-image"/>
    <div class="btwb-result-container">
	    <div class="btwb-athlete-name">{{member_name}}</div>
            <div class="btwb-result-attributes">
	    <span><small>{{session_time}}</small> via</span>
            <span> 
	    <a href="{{result_url}}">
     	    <img src="https://s3.amazonaws.com/assets.beyondthewhiteboard.com/images/btwb-icon.png"/></a></span>
		{{#is_personal_record}}
<span><img src="https://s3.amazonaws.com/assets.beyondthewhiteboard.com/images/personal_record_icon_width_15.png"/></span>	
	        {{/is_personal_record}}
	    </div>
          
	    <hr/>
	    <div class="btwb-result">
		<div class="btwb-result-score">
			<a href="{{result_url}}">{{result}}
			{{#is_prescribed}} | Rx'd {{/is_prescribed}}
			{{^is_prescribed}} | Non Rx'd {{/is_prescribed}}
                        </a>
		</div>
		<div class="btwb-result-score-notes">{{notes}}</div>	      
	    </div>
    </div>
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

