import React from 'react';
import DividerForm from './DividerForm.jsx';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import PopoverMenu from './PopoverMenu.jsx';
import Button from './Button.jsx';

export default class AddUserPage extends React.Component {
    constructor() {
        super();
    }
    render() {
        var hintTexts = ["Käyttäjänimi", "Salasana", "Etunimi", "Sukunimi", "Email", "Puhelin nro."];
        var hintTexts2 = ["Lähiosoite","Postinumero","Kaupunki","Maa"];
        var dropDownOptions = ["Peruskäyttäjä", "Työntekijä", "Admin"];
        var buttonLabel = "Lisää Käyttäjä";
        return (
            <MuiThemeProvider>
                <div id="add-user-page">
                    <h1 className="h1">Lisää Käyttäjä</h1>
                        <div className="col-md-10 col-md-offset-1">
                            <div className="col-md-5 col-md-offset-1">
                                <DividerForm hintTexts={hintTexts} multiLine={false} pre={"u1_"} /><br/>
                            </div>
                            <div className="col-md-5">
                                <DividerForm hintTexts={hintTexts2} multiLine={false} pre={"u2_"} /><br/>
                                <PopoverMenu options={dropDownOptions} label={"Käyttäjätaso"} />
                            </div>
                        </div>
                    <div id="add-user-btn" className="row col-md-offset-1 col-md-10">
                        <Button label={buttonLabel} secondary={false} primary={true} />
                    </div>
                </div>
            </MuiThemeProvider>
        );
    }
}