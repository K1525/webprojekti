import React from 'react';

export default class SnackBar extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      open: false,
    };
  }

  render() {
    return (
      <div id="snackbar">
          <p id="message-text">Test</p>
      </div>
    );
  }
}