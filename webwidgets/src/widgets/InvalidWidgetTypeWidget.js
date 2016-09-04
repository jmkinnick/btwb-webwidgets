import React, { Component } from 'react';

class InvalidWidgetTypeWidget extends Component {

  render() {
    return (
      <div>Error: Btwb Web Widgets was passed an invalid Widget Type: {this.props.widget_type}
      </div>
    );
  }

}

export default InvalidWidgetTypeWidget;