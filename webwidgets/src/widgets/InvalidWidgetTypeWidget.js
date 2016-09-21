import React, { Component } from 'react';

class InvalidWidgetTypeWidget extends Component {

  render() {
    return (
   	<div className="error_style">
    	<i className="fa fa-exclamation-triangle fa-4x" aria-hidden="true"></i>
        <title>beyond the whiteboard</title>
        <h1> Error: Btwb Web Widgets was passed an invalid Widget Type: {this.props.widget_type} </h1> 
         <p>Please see customer support at </p> 
         <a href={"http://support.beyondthewhiteboard.com/"}>
         <img src={"//s3.amazonaws.com/assets.beyondthewhiteboard.com/images/btwb-logo-footer.png"} role="presentation"/>
         </a> 
      </div>
    );
  }
}

export default InvalidWidgetTypeWidget;