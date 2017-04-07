import React from 'react';
import RaisedButton from 'material-ui/RaisedButton';
import Popover, {PopoverAnimationVertical} from 'material-ui/Popover';
import Menu from 'material-ui/Menu';
import MenuItem from 'material-ui/MenuItem';
import $ from 'jquery';

export default class PopoverMenu extends React.Component {

  constructor(props) {
    super(props);
    this.state = { open: false, item: 0, label:this.props.label };
    
  }
  
  handleTouchTap = (event) => {
    // This prevents ghost click
    
    event.preventDefault();

    this.setState({
      open: true,
      anchorEl: event.currentTarget,
    });
  };

  handleRequestClose = () => {
    this.setState({
      open: false,
    });
  };

  handleChange = (event,index) => {
    if ($("#"+this.props.label).length){
        $("#"+this.props.label).val(index);
    }
    else {
        var selected = "<input type='hidden' id='"+this.props.label+"' value='"+index+"'/>";
        $("#page").append(selected);
    }
    var label = this.props.options[index-1];
    this.setState({
      item: index,
      label: label,
      open: false,
    });
  }

  render() {
    var test = this.props.label;
    const options = this.props.options;
    var menu = [];
    for (var i=0; i<options.length; i++) {
        menu.push(<MenuItem key={i} value={i+1} primaryText={options[i]} />);
    }
    return (
      <div className="dropdown" >
        <RaisedButton 
          onTouchTap={this.handleTouchTap}
          label={this.state.label}
        />
        <Popover 
          open={this.state.open}
          anchorEl={this.state.anchorEl}
          anchorOrigin={{horizontal: 'left', vertical: 'bottom'}}
          targetOrigin={{horizontal: 'left', vertical: 'top'}}
          onRequestClose={this.handleRequestClose}
          animation={PopoverAnimationVertical}
        >
          <Menu onChange={this.handleChange}>
            {menu}
          </Menu>
        </Popover>
      </div>
    );
  }
}