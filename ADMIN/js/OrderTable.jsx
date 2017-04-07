import React from 'react';
import {Table, TableBody, TableFooter, TableHeader, TableHeaderColumn, TableRow, TableRowColumn}
  from 'material-ui/Table';
import TextField from 'material-ui/TextField';


const styles = {
  propContainer: {
    width: 200,
    overflow: 'hidden',
    margin: '20px auto 0',
  },
  propToggleHeader: {
    margin: '20px auto 10px',
  },
};

var tableData = [];

export default class OrderTable extends React.Component {

  constructor(props) {
    super(props);

    /*
    for (var i=0; i<3; i++) {
        tableData.push(
        {
            id: '1',
            user: 'asd',
            street: '',
            date: 'date'
        });
    }
    */

    tableData = this.props.orders;
    
    console.log(tableData);

    this.state = {
      fixedHeader: true,
      fixedFooter: true,
      stripedRows: true,
      showRowHover: false,
      selectable: true,
      multiSelectable: true,
      enableSelectAll: false,
      deselectOnClickaway: true,
      showCheckboxes: true,
      height: '470px',
    };
  }
  
  handleToggle = (event, toggled) => {
    this.setState({
      [event.target.name]: toggled,
    });
  };

  handleChange = (event) => {
    this.setState({height: event.target.value});
  };
  
  render() {
    return (
      <div>
        <Table
          height={this.state.height}
          fixedHeader={this.state.fixedHeader}
          fixedFooter={this.state.fixedFooter}
          selectable={this.state.selectable}
          multiSelectable={this.state.multiSelectable}
        >
          <TableHeader
            displaySelectAll={this.state.showCheckboxes}
            adjustForCheckbox={this.state.showCheckboxes}
            enableSelectAll={this.state.enableSelectAll}
          >
            
            <TableRow>
              <TableHeaderColumn tooltip="">Tilaus ID</TableHeaderColumn>
              <TableHeaderColumn tooltip="">Tilaaja</TableHeaderColumn>
              <TableHeaderColumn tooltip="">Lähiosoite</TableHeaderColumn>
              <TableHeaderColumn tooltip="">Pvm.</TableHeaderColumn>
            </TableRow>
          </TableHeader>
          <TableBody
            displayRowCheckbox={this.state.showCheckboxes}
            deselectOnClickaway={this.state.deselectOnClickaway}
            showRowHover={this.state.showRowHover}
            stripedRows={this.state.stripedRows}
          >
            {tableData.map( (row, index) => (
              <TableRow key={index} selected={row.selected}>
                <TableRowColumn>{row.OrderId}</TableRowColumn>
                <TableRowColumn>{row.Username}</TableRowColumn>
                <TableRowColumn>{row.street}</TableRowColumn>
                <TableRowColumn>{row.Date}</TableRowColumn>
              </TableRow>
              ))}
          </TableBody>
        </Table>
      </div>
    );
  }
}