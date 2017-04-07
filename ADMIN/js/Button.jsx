import React from 'react';
import RaisedButton from 'material-ui/RaisedButton';

const style = {
  margin: 6,
  marginTop: 50,
};

const Button = React.createClass({
    render() {
        return (
            <div>
                <RaisedButton label={this.props.label} primary={this.props.primary}
                secondary={this.props.secondary} fullWidth={true} disabled={false} 
                style={style} />
            <br />
            </div>
        );
    }
});

export default Button;

/* <RaisedButton label="Secondary" secondary={true} style={style} />
    <RaisedButton label="Disabled" disabled={true} style={style} /> */