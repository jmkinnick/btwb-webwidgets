import React from 'react';
import Base from './Base';
import * as U from '../consts/uris';
import * as I from '../consts/images';

class Wods extends Base {

  api_path() {
    return U.WODS_PATH;
  }

  renderSuccess() {
    return (
      <div className="myContainer">
        {this.renderWods()}
      </div>
    );
  }

  renderError() {
    return super.renderError();
  }

  renderMaleLeaders(wod_entries) {
    return wod_entries.workout.wod_leaderboard.male_results.map((male_leader, i) => (
      <li className="clearfix" key={'male_leader_'+i}>
        <img src={male_leader.member_logo_url} className="athlete-image" role="presentation"/>
        <div className="btwb-result-container">
          <div className="btwb-athlete-name">{male_leader.member_name}</div>
            <div className="btwb-result-attributes">
              <span><small>{male_leader.session_time}</small> via</span>
              <span>
                <a href={male_leader.result_url}>
                  <img src={I.BTWB_ICON} role="presentation"/>
                </a>
              </span>
              {male_leader.is_personal_record ? <span><img src={I.PR_ICON} role="presentation"/></span> : null}
            </div>
            <hr/>
            <div className="btwb-result">
              <div className="btwb-result-score">
                <a href={male_leader.result_url}>{male_leader.result}
                  {male_leader.is_prescribed ? <span> "Rxd" </span> : <span> "Non-Rxd" </span> }
                </a>
              </div>

            <div className="btwb-result-score-notes">{male_leader.notes}</div>
          </div>
        </div>
      </li>
    ));
  }

  renderFemaleLeaders(wod_entries) {
    return wod_entries.workout.wod_leaderboard.female_results.map((female_leader, i) => (
    <li className="clearfix" key={'female_leader_'+i}>
      <img src={female_leader.member_logo_url} className="athlete-image" role="presentation"/>
      <div className="btwb-result-container">
        <div className="btwb-athlete-name">{female_leader.member_name}</div>
        <div className="btwb-result-attributes">
          <span><small>{female_leader.session_time}</small> via</span>
          <span>
            <a href={female_leader.result_url}>
              <img src={I.BTWB_ICON} role="presentation"/>
            </a>
          </span>
          {female_leader.is_personal_record ? <span><img src={I.PR_ICON} role="presentation"/></span> : null}
        </div>
        <hr/>
        <div className="btwb-result">
          <div className="btwb-result-score">
            <a href={female_leader.result_url}>{female_leader.result}
              {female_leader.is_prescribed ? <span> "Rxd" </span> : <span> "Non-Rxd" </span> }
            </a>
          </div>
          <div className="btwb-result-score-notes">{female_leader.notes}</div>
        </div>
      </div>
    </li>
    ));
  }

  renderRecentResults(wod_entries) {
    return wod_entries.workout.wod_recent_results.map((recent_results, i) => (
    <li className="clearfix" key={'recent_results_'+i}>
      <img src={recent_results.member_logo_url} className="athlete-image" role="presentation"/>
      <div className="btwb-result-container">
        <div className="btwb-athlete-name">{recent_results.member_name}</div>
          <div className="btwb-result-attributes">
            <span><small>{recent_results.session_time}</small> via</span>
            <span>
            <a href={recent_results.result_url}>
              <img src={I.BTWB_ICON} role="presentation"/></a></span>
              {recent_results.is_personal_record ? <span><img src={I.PR_ICON} role="presentation"/></span> :null }
          </div>
          <hr/>
          <div className="btwb-result">
            <div className="btwb-result-score">
              <a href={recent_results.result_url}>{recent_results.result}
                {recent_results.is_prescribed ?  "Rxd" : "Non-Rxd" }
              </a>
            </div>
            <div className="btwb-result-score-notes">{recent_results.notes}</div>
        </div>
      </div>
    </li>
    ));
  }

  renderWodLinks(wod_entries) {
    return wod_entries.workout.wod_recent_results.map((links, i) => (
      <ul className="btwb-wod-links" key={'links_'+i}>
        <li><a href={links.url} target="_blank">{links.title}</a></li>
      </ul>
    ));
  }

  renderWodEntries(wod_activity) {
    return wod_activity.entries.map((wod_entries,i) => (
    <li key={'wod_entries_'+i}>
      <h5>{wod_entries.wod_title}</h5>
      <small><u>{wod_entries.wod_section}:</u> {wod_activity.track_name} - {wod_activity.date_string}</small>
      { wod_entries.workout ?
        <div>
          <h6>{wod_entries.workout.workout_name}</h6>
          <p className="btwb-workout-description">{wod_entries.workout.workout_description}</p>
        </div>
      : null }
      <p><i>{wod_entries.wod_instructions}</i></p>
      { wod_entries.wod_links.length ?
        <span>
          {this.renderWodLinks(wod_entries)}
        </span>
      : null }
      <hr/>

      <div className="btwb-leaderboard">
        <div className="btwb-mens-leaderboard">
          <h5>Mens Leaderboard</h5>
          <hr/>
          { wod_entries.workout.wod_leaderboard.male_results.length ?
            <ol className="btwb-result-list">
              {this.renderMaleLeaders(wod_entries)}
            </ol>
          : null }
        </div>
        <div className="btwb-womens-leaderboard">
          <h5>Womens Leaderboard</h5>
          <hr/>
          { wod_entries.workout.wod_leaderboard.female_results.length ?
            <ol className="btwb-result-list">
              {this.renderFemaleLeaders(wod_entries)}
            </ol>
          : null }
        </div>
        <div className="align"></div>
      </div>

      <hr />
      { wod_entries.workout.wod_recent_results_show ?
        <div className="btwb-recent-results">
          <h5><a href={wod_entries.workout.wod_results_url}>Recent WOD Results</a></h5>
          <small>Total: {wod_entries.workout.wod_results_count}</small>
            <ul className="btwb-result-list">
              { wod_entries.workout.wod_recent_results.length ?
                <span>
                  {this.renderRecentResults(wod_entries)}
                </span>
              : null }
            </ul>
          <hr/>
        </div>
      : null }
    </li>
    ));
  }

  renderWods() {
    console.log(this.state.data);
    return this.state.data.wodsets.map((wod_activity,i) => (
      <ul className="btwb-wod-list" key={'wod_activity_' + i}>
        { wod_activity.entries.length ?
          <span>
            {this.renderWodEntries(wod_activity)}
          </span>
        : 'Nothing Assigned for This Track for this Date' }
      </ul>
    ));
  }

}

export default Wods;