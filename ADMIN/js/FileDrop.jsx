var React = require('react');
var Dropzone = require('react-dropzone');
import $ from "jquery";

function showMessage(msg){
	$("#message-text").stop().text(msg).fadeIn();
	$("#snackbar").stop().animate({height: "120px"});
	setTimeout(function(){
		$("#snackbar").stop().animate({height: "0px"});
		$("#message-text").stop().fadeOut();
	},3000);
}

var style = {
  height: "218px",
    width: "240px",
    border: "2px dashed #888"
}
var style2={
    position:"relative",
    top:"50%",
    transform:"translateY(-50%)"}
var style3={
    height: "auto",
    maxHeight: "214px",
    maxWidth: "236px",
}
var FileDrop = React.createClass({
    getInitialState: function () {
        return {
          files: []
        };
    },

    onDrop: function (file) {
        if (file[0].type=="image/jpeg"||file[0].type=="image/jpg"||file[0].type=="image/png")
            showMessage("Kuva "+file[0].name+" lisätty");
        else {
            showMessage("Tiedosto ei kelpaa");
            return;
        }
        document.getElementById("fd-txt").innerHTML = "";
        $("#fd-img").attr("data",file[0].name);
        this.setState({
            files: file
        });
        var form_data = new FormData();
        form_data.append("file",file[0]);
        $.ajax({
            url: "./php/upload_file.php", 
            type: "POST",             
            data: form_data,
            processData: false,
            contentType: false
        }).done(function(data){
            console.log(data);
            if(data=="Kuva lisätty")
                showMessage(data);
        });
    },

    onOpenClick: function () {
      this.dropzone.open();
    },

    render: function () {
        return (
            <div>
                <Dropzone style={style} ref={(node) => { this.dropzone = node; }} onDrop={this.onDrop}>
                    <div style={style2} id="fd-txt">Pudota kuvat tänne,<br/> tai klikkaa ja hae...
                    </div>
                    <div>{this.state.files.map((file) => <img key="fd-img" id="fd-img" data="null" style={style3} src={file.preview} /> )}</div>
                </Dropzone>
                {this.state.files.length > 0 ? <div>
                </div> : null}
            </div>
        );
    }
});

module.exports = FileDrop;