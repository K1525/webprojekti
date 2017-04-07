import React from 'react';
import Divider from 'material-ui/Divider';
import Paper from 'material-ui/Paper';
import TextField from 'material-ui/TextField';

const style = {
  marginLeft: 20,
  width: "90%"
};

const DividerForm = React.createClass({
    render() {
        const texts = this.props.hintTexts;
        var fields = [];
        for (var i=0; i<texts.length; i++) {
            fields.push(<div id={this.props.pre+(i+1)} key={i}><TextField multiLine={this.props.multiLine}
            floatingLabelText={texts[i]} key={texts[i]} style={style} 
            underlineShow={true} /*fullWidth={true}*/ /><Divider /></div>);
        }
        console.log();
        return (
            <Paper zDepth={2}>
                {fields}
            </Paper>
        );
    }
});

export default DividerForm;