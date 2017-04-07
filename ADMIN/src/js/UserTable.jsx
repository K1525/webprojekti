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

export default class UserTable extends React.Component {

  constructor(props) {
    super(props);

    tableData = this.props.users;
    
    console.log(tableData);

    this.state = {
      fixedHeader: true,
      fixedFooter: true,
      stripedRows: true,
      showRowHover: false,
      selectable: false,
      multiSelectable: false,
      enableSelectAll: false,
      deselectOnClickaway: true,
      showCheckboxes: false,
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
              <TableHeaderColumn tooltip="">Käyttäjä-Id</TableHeaderColumn>
              <TableHeaderColumn tooltip="">Käyttäjänimi</TableHeaderColumn>
              <TableHeaderColumn tooltip="">Etunimi</TableHeaderColumn>
              <TableHeaderColumn tooltip="">Sukunimi</TableHeaderColumn>
              <TableHeaderColumn tooltip="">Email</TableHeaderColumn>
              <TableHeaderColumn tooltip="">Puhelin nro.</TableHeaderColumn>
              <TableHeaderColumn tooltip="">Käyttäjätaso</TableHeaderColumn>
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
                <TableRowColumn>{row.CustomerId}</TableRowColumn>
                <TableRowColumn>{row.Username}</TableRowColumn>
                <TableRowColumn>{row.First_name}</TableRowColumn>
                <TableRowColumn>{row.Last_name}</TableRowColumn>
                <TableRowColumn>{row.Email}</TableRowColumn>
                <TableRowColumn>{row.Phone}</TableRowColumn>
                <TableRowColumn>{row.User_level}</TableRowColumn>
              </TableRow>
              ))}
          </TableBody>
        </Table>
      </div>
    );
  }
}