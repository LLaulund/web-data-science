var YT_url = "https://youtube.googleapis.com/youtube/v3/search?";
var YT_parms = "part=snippet";
var YT_results ="&maxResults=4"
var YT_topic = "&q=orchid%20care";
var YT_key = "&key=";

var youtube_request = YT_url+YT_parms+YT_results+YT_topic+YT_key;

//console.log(youtube_request)

$(document).ready(function(){
    $.getJSON(youtube_request, function(results){
        $.each(results.items, function(idx){
            
        $('div#video')
        .append('<article class="grid-item">'+
        '<div class="content"><h3>'+
        results.items[idx].snippet.title+
        '</h3><br></div>'+
        '<iframe class="img-grid-item" width="100%" align-self="end"'+
        'src=https://www.youtube.com/embed/'+results.items[idx].id.videoId+
        '?controls=0&showinfo=1" frameborder="1" allowfullscreen></iframe></article>');  
        });
    });
});
