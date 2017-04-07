import React from 'react';
import Dialog from 'material-ui/Dialog';
import FlatButton from 'material-ui/FlatButton';
import RaisedButton from 'material-ui/RaisedButton';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';

export default class DialogBox extends React.Component {
  state = {
    open: false,
  };

  render() {
    const actions = [
      <div id="cancel-btn"><FlatButton
        label="Peruuta"
        primary={true}
        onTouchTap={this.handleClose}
      /></div>,
      <div id="ok-btn"><FlatButton
        label="Ok"
        primary={true}
        onTouchTap={this.handleClose}
      /></div>,
    ];

    return (
      <MuiThemeProvider>
          <div>
            <Dialog
            actions={actions}
            modal={false}
            open={this.props.open}
            onRequestClose={this.handleClose}
            >
            {this.props.msg}
            </Dialog>
            </div>
      </MuiThemeProvider>
    );
  }
}