import React from 'react';
import UserTable from './UserTable.jsx';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';

export default class ListUsersPage extends React.Component {
    constructor() {
        super();
    }
    render() {
        return (
            <MuiThemeProvider>
                <div id="list-users-page">
                    <h1 className="h1">Käyttäjät</h1>
                    <div className="form-group">
                        <input type="text" className="form-control" id="search-users" placeholder="Haku"/>
                    </div>
                    <UserTable users={this.props.users} />
                </div>
            </MuiThemeProvider>
        );
    }
}