var wikiUrl =".wikipedia.org/w/api.php?";
var action ="action=parse"
var format ="&format=json";
var query="&page=orchid";
var lang="en";
var parms="&redirects&prop=text&callback=?";

var url="https://"+lang+wikiUrl+action+format+query+parms;
//console.log(url);

$(document).ready(function(){
    $.getJSON(url, function(results){
        var rawtext = results.parse.text["*"]; 
               
        wikiHTML = rawtext.replace(
            new RegExp('"//upload.', 'g'),'"https://upload.'
        ); //wikimedia pictures
       
        $wikiDOM = $("<document>"+wikiHTML+"</document>");
        $("#infobox").append($wikiDOM.find('.infobox').html());
    });
});

