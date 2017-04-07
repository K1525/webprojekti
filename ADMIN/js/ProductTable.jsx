import React from 'react';
import {Table, TableBody, TableFooter, TableHeader, TableHeaderColumn, TableRow, TableRowColumn}
  from 'material-ui/Table';
import TextField from 'material-ui/TextField';
import $ from 'jquery';


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
var selectedRows = [];

export default class ProductTable extends React.Component {

  constructor(props) {
    super(props);
    tableData = this.props.products;

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

  handleCellClick = (rows,column) => {
      selectedRows = rows;
      console.log($("#ids").data());
      if ($("#ids").length){
          $("#ids").data(selectedRows);
      }
      else {
          var selected = "<input type='hidden' id='ids' data='"+selectedRows+"'/>";
          $("#page").append(selected);
      }
  }
  
  render() {
    console.log(tableData);
    return (
      <div>
        <Table onRowSelection={this.handleCellClick}
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
              <TableHeaderColumn tooltip="">Tuote-Id</TableHeaderColumn>
              <TableHeaderColumn tooltip="">Tuotenimi</TableHeaderColumn>
              <TableHeaderColumn tooltip="">Hinta</TableHeaderColumn>
              <TableHeaderColumn tooltip="">Varastossa</TableHeaderColumn>
              <TableHeaderColumn tooltip="">Sukupuoli</TableHeaderColumn>
              <TableHeaderColumn tooltip="">Kategoria</TableHeaderColumn>
            </TableRow>
          </TableHeader>
          <TableBody
            displayRowCheckbox={this.state.showCheckboxes}
            deselectOnClickaway={this.state.deselectOnClickaway}
            showRowHover={this.state.showRowHover}
            stripedRows={this.state.stripedRows}
          >
            {tableData.map( (row, index) => (
              <TableRow key={index} selected={row.selected} >
                <TableRowColumn id={"row_"+index}>{row.ProductId}</TableRowColumn>
                <TableRowColumn>{row.Name}</TableRowColumn>
                <TableRowColumn>{row.Price}</TableRowColumn>
                <TableRowColumn>{row.Stock}</TableRowColumn>
                <TableRowColumn>{row.Gender}</TableRowColumn>
                <TableRowColumn>{row.Category_name}</TableRowColumn>
              </TableRow>
              ))}
          </TableBody>
        </Table>
        
      </div>
    );
  }
}