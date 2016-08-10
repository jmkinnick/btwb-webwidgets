import React from 'react';
import './Wods.css';

import Base from './Base';

import * as U from '../consts/uris';


class Wods extends Base {

  api_path() {
    return U.WODS_PATH;
  }

  renderSuccess() {
    return super.renderSuccess();
  }

  renderError() {
    return super.renderError();
  }

}

export default Wods;

