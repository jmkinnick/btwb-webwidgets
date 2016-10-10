import React, { Component } from 'react';
import SuperAgent from 'superagent';
import URL from 'url';
import './style_light.css';

class Base extends Component {
  constructor(props, context, updater) {
    super(props, context, updater);
    this.state = {};
  }

  componentDidMount() {
    const props = this.props;
    const {
      api_key,
      api_root,
    } = props.api_config;
    const api_params = props.api_params;
    const url = URL.resolve(api_root, this.api_path());
    SuperAgent
      .get(url)
      .query({...api_params, api_key})
      .end((error, httpResponse) => {
        if (error || !httpResponse.ok) {
          this.setState({error, httpResponse});
        } else {
          this.setState({data: httpResponse.body});
        }
      });
  }

  api_path() {
    return null;
  }

  render() {
    var sizeMe={
      fontSize: "1.5em", marginLeft: ".5em"
    }
    if (this.state.data) {
      return this.renderSuccess();
    } else if (this.state.error) {
      return this.renderError();
    } else {
      return (
        <div className="myContainer">
          <i className="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
          <span className="sr-only" style={sizeMe}>Loading...</span>
        </div>
      );
    }
  }

  renderSuccess() {
    return (
      <div>{JSON.stringify(this.state.data)}</div>
    );
  }

  renderError() {
    return (
      <div className="error_style">
         <i className="fa fa-exclamation-triangle fa-4x" aria-hidden="true"></i>
         <title>beyond the whiteboard</title>
         <h1> Error: {this.state.error.message}</h1>
         <p>Unable to access this resource.</p>
         <p>Please see customer support at </p>
         <a href={"http://support.beyondthewhiteboard.com/"}>
         <img src={"//s3.amazonaws.com/assets.beyondthewhiteboard.com/images/btwb-logo-footer.png"} role="presentation"/>
         </a>
      </div>
    );
  }
}

export default Base;
