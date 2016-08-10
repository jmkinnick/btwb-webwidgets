import React from 'react';
import ReactDOM from 'react-dom';

import _ from 'underscore';

import lookupWidget from './widgets/_lookup';

import * as D from './consts/dom';
import * as U from './consts/uris';

// We get our default configuration.
const config = document.getElementById(D.ELEMENT_ID);
const DEFAULT_CONFIG = {
  api_root: U.API_ROOT,
};
const api_key = config.getAttribute(D.ATTR_API_KEY);
const api_config = _.extend({}, DEFAULT_CONFIG, {api_key});

// We lookup the api params from the `data-` fields, and
// then pass them in to a react component.
const elements = document.getElementsByClassName(D.CLASS_BTWB_WEBWIDGET);
_.each(
  elements,
  (e, i, l) => {
    const widget_type = e.getAttribute(D.ATTR_WIDGET_TYPE);
    const api_params = _.reduce(
      e.attributes,
      (acc, attr) => {
        const name = attr.name;
        if (name.match(/^data-(.+)$/) && name !== D.ATTR_WIDGET_TYPE) {
          const paramName = name.substring(5);
          acc[paramName] = attr.value;
        }
        return acc;
      },
      {});
    const props = {
      widget_type,
      api_params,
      api_config,
    };
    const Component = lookupWidget(props.widget_type);
    ReactDOM.render(<Component {...props} />, e);
  });

