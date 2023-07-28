//Her deklareres API url'en med relevante parametre 
var Guardian_url = 'https://content.guardianapis.com/search?q='; // Api url
var Guardian_topic = 'orchid'; // Søgeord
var Guardian_count ="&page-size=4" // antal resultater
var Guardian_key ='&api-key=';  // Api nøgle
var Guardian_params='&show-fields=all'; // vis alle felter
    
var Guardian_request = Guardian_url+Guardian_topic+Guardian_count+Guardian_key+Guardian_params;

////Her vises den fulde API-forespørgsel på konsollen, for at sikre denne er korrekt:
//console.log(Guardian_request);

//Vi forespørger The Guardian content API v3 og forbereder resultaterne til visning
$(document).ready(function(){
    //Send forespørgsel til API og gem resultaterne i "Guardian_results":
    $.getJSON(Guardian_request, function(Guardian_results){ 
         //loop for at vise hvert resultat:              
        $.each(Guardian_results.response.results, function(idx, item){ 
            // Gem den inledende sti i en variabel:
            var Guardian_article = Guardian_results.response.results; 
                        
            // Her formateres datoen for udgivelsen af artiklen, 
            // så vi kan udskrive den så den giver mening på dansk:
            const Guardian_date = new Date(Guardian_article[idx].webPublicationDate);
            const day = Guardian_date.getDate();
            const month = Guardian_date.getMonth();
            const year = Guardian_date.getFullYear();
            const hour = Guardian_date.getUTCHours();
            // Her benyttes let, da const variabler ikke kan redefineres
            let minutes = Guardian_date.getUTCMinutes();
            // vi laver en if formel så hele timetal vises med 00  frem for 0
            if (Guardian_date.getUTCMinutes()== "0"){
                minutes = "00";
            } 
            
            $('div#artikler').append('<article class="grid-item"><br><h3>'+
            Guardian_article[idx].fields.headline+
            '</h3><br><figure><img class="img-grid-item" src="'+
            Guardian_article[idx].fields.thumbnail+
            '"></figure><div class="content"> Skrevet af '+
            Guardian_article[idx].fields.bylineHtml+'<br> Udgivet: '+
            day+'-'+month+'-'+year+' Klokken: '+hour+':'+minutes+'<br><br>'+
            Guardian_article[idx].fields.trailText+
            '<br></div><button class="btn--block"><a href="'+
            Guardian_article[idx].webUrl+'"> Læs artikel </a></button></article>');
            
        });
    });
});
	