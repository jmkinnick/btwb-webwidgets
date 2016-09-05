import React from 'react';
import Base from './Base';
import * as U from '../consts/uris';
import * as I from '../consts/images';

class Activites extends Base {

  api_path() {
    return U.ACTIVITIES_PATH;
  }

   renderSuccess() {
    return (
      <div>
        {this.renderActivities()}
      </div>
    );
  }

  renderError() {
    return (
      <div>
        {this.renderActivitiesError()}
      </div> 
    ); 
  }

  renderPrIcon(activity) {
    if (activity.workout_session.is_personal_record) {
      return (
        <span><img src={I.PR_ICON} role="presentation"/></span>
      );
    } else {
      return null;
    }
  }

  renderRxdSpan(activity) {
    if (activity.workout_session.is_prescribed) {
      return (<span> Rxd </span>);
    } else {
      return (<span> Not-Rxd </span>);
    }
  }

  renderActivities() {
    return this.state.data.activities.map((activity,i) => (
      <ul className="btwb-result-list" key={'activity_' + i}>
        <li className="clearfix">
          <img src={activity.workout_session.member_logo_url} className="athlete-image" role="presentation"/>
          <div className="btwb-result-container">
            <div className="btwb-athlete-name">{activity.workout_session.member_name}</div>
            <div className="btwb-result-attributes">
              <span><small>{activity.workout_session.time_ago}</small> via</span>
              <span>
                <a href={activity.workout_session.result_url}>
                  <img src={I.BTWB_ICON} role="presentation"/>
                </a>
              </span>
              {this.renderPrIcon(activity)}
            </div>
            <hr/>
            <div className="btwb-result">
            <div className="btwb-workout-name">{activity.workout_session.workout_name}</div>
            <div className="btwb-result-score">
              <a href={activity.workout_session.result_url}>{activity.workout_session.result}
                {this.renderRxdSpan(activity)}
              </a>
            </div>
            <div className="btwb-result-score-notes">{activity.workout_session.notes}</div>
            </div>
          </div>
        </li>
      </ul>
    ));
  }


  renderActivitiesError() {
    console.log(this.state.error)
    var myStyle={
      padding:"2em", 
      textAlign:"center", 
      backgroundColor:"black", 
      color:"white"
    }

    return ( 
      <div style={myStyle}>
         <i className="fa fa-exclamation-triangle fa-4x" aria-hidden="true"></i>
         <title>beyond the whiteboard - Forbidden (403)</title>
         <h1>Access Denied</h1> 
         <p>You do not have permission to access this resource.</p>
         <a href={"http://support.beyondthewhiteboard.com/"}>
         <img src={"//s3.amazonaws.com/assets.beyondthewhiteboard.com/images/btwb-logo-footer.png"} role="presentation"/>
         </a> 
      </div>
    ) 
  }

}

export default Activites;