{{^is_public_gym}}
  <p>The workouts for this Gym are set to Members only.  To display them here, adjust the Gym Privacy Settings on Beyond the Whiteboard to Show WODs to "Everyone."</p>
{{/is_public_gym}}

<h4>{{workout.name}}</h4>
{{workout_url}}<br/>
{{workout_description}}<br/>

<div class="btwb-leaderboard">

<div class="btwb-mens-leaderboard">
<h5>Men's Leaderboard</h5>
<hr/>
<ul class="btwb-result-list">
{{#male_leaderboard}}
<li>
    <h6>1</h6>
    <img src="{{member_logo_url}}" class="athlete-image"/>
    <div class="btwb-result-container">
	    <div class="btwb-athlete-name">{{member_name}}</div>
            <div class="btwb-result-attributes">
	    <span><small>{{session_date_string}}</small> via</span>
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
{{/male_leaderboard}}
</ul>
</div>
<div class="btwb-womens-leaderboard">
<h5>Women's Leaderboard</h5>
<hr/>
<ul class="btwb-result-list">
{{#female_leaderboard}}
  <li>
    <h6>1</h6>
    <img src="{{member_logo_url}}" class="athlete-image"/>
    <div class="btwb-result-container">
	    <div class="btwb-athlete-name">{{member_name}}</div>
            <div class="btwb-result-attributes">
	    <span><small>{{session_date_string}}</small> via</span>
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
{{/female_leaderboard}}
</ul>
</div>
<div style="clear:both;"></div>
</div>
