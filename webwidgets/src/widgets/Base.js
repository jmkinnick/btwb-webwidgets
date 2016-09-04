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
      fontSize: "1.5em",
      marginLeft: ".5em"
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
      <div>
        <h3>Request Error</h3>
        <p>{JSON.stringify(this.state.error)}</p>
        <h3>HTTP Response</h3>
        <p>{JSON.stringify(this.state.httpResponse)}</p>
      </div>
    );
  }

}

export default Base;