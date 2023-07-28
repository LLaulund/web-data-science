
var NYT_url = "https://api.nytimes.com/svc/search/v2/articlesearch.json?";
var NYT_topic = "q=orchid";
var NYT_key = "&api-key=";

var nyt_request = NYT_url+NYT_topic+NYT_key;
var counter = 0;

//console.log(nyt_request);

$(document).ready(function(){
    $.getJSON(nyt_request, function(results){
        $.each(results.response.docs, function(idx){

            const NYT_date = new Date(results.response.docs[idx].pub_date);
            const day = NYT_date.getDate();
            const month = NYT_date.getMonth();
            const year = NYT_date.getFullYear();
            const hour = NYT_date.getUTCHours();
            // Her benyttes let, da const variabler ikke kan redefineres
            let minutes = NYT_date.getUTCMinutes();
            // vi laver en if formel så hele timetal vises med 00  frem for 0
            if (NYT_date.getUTCMinutes()== "0"){
                minutes = "00";
            };

            if(results.response.docs[idx].multimedia[0] != null && counter <4){
                
                $('div#artikler').append('<article class="grid-item"><br><h3>'+
                results.response.docs[idx].headline.main+
                '</h3><br><figure><img class="img-grid-item" src="https://www.nytimes.com/'+
                results.response.docs[idx].multimedia[0].url+
                '"></figure><div class="content">'+
                results.response.docs[idx].byline.original+'<br> Udgivet: '+
                day+'-'+month+'-'+year+' Klokken: '+hour+':'+minutes+'<br><br>'+
                results.response.docs[idx].abstract+
                '<br></div><button class="btn--block"><a href="'+
                results.response.docs[idx].web_url+
                '"> Læs artikel </a></button></article>');
            
                counter++                      
            };      
        });
    });
});

