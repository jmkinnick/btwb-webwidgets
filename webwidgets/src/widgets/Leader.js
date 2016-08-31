import React from 'react';
import Base from './Base';
import * as U from '../consts/uris';
import * as I from '../consts/images';

class Leaders extends Base {

  api_path() {
    return U.LEADERS_PATH;
  }

  renderSuccess() {
    return (
      <div>
        {this.renderLeaders()}
      </div>
    );
  }

  renderError() {
    return super.renderError();
  }

  renderMaleLeaders() {
    return this.state.data.male_leaderboard.map((male_leader,i) => (
      <li className="clearfix" key={'male_leader_' + i}>
        <img src={male_leader.member_logo_url} className="athlete-image" role="presentation"/>
        <div className="btwb-result-container">
          <div className="btwb-athlete-name">{male_leader.member_name}</div>
          <div className="btwb-result-attributes">
            <span><small>{male_leader.session_date_string}</small> via</span>
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

  renderFemaleLeaders() {
    return this.state.data.female_leaderboard.map((female_leader,i) => (
      <li className="clearfix" key={'female_leader_' + i}>
        <img src={female_leader.member_logo_url} className="athlete-image" role="presentation"/>
          <div className="btwb-result-container">
            <div className="btwb-athlete-name">{female_leader.member_name}</div>
            <div className="btwb-result-attributes">
              <span><small>{female_leader.session_date_string}</small> via</span>
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
                    {female_leader.is_prescribed ? <span> "Rxd" </span> : <span> "Non Rxd" </span> }
                </a>
              </div>
              <div className="btwb-result-score-notes">{female_leader.notes}</div>
            </div>
          </div>
      </li>
    ));
  }

  renderLeaders() {
    console.log(this.state.data);
    return (
      <div className="myContainer">
        <h4><a href={this.state.data.workout_url}>{this.state.data.workout_name}</a></h4>
        <p className="btwb-workout-description">{this.state.data.workout_description}</p>
        <div className="btwb-leaderboard">
          <div className="btwb-mens-leaderboard">
            <h5>Mens Leaderboard</h5>
            <hr/>
            <ol className="btwb-result-list">
              {this.renderMaleLeaders()}
            </ol>
          </div>
          <div className="btwb-womens-leaderboard">
            <h5>Womens Leaderboard</h5>
            <hr/>
            <ol className="btwb-result-list">
              {this.renderFemaleLeaders()}
            </ol>
          </div>
        </div>
      </div>
    )
  }
}

export default Leaders;
