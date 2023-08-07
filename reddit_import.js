var reddit_request = "https://www.reddit.com/r/orchids.json?limit=4";
//console.log(reddit_request);

$(document).ready(function(){
    $.getJSON(reddit_request, function(results){
        $.each(results.data.children, function(idx){
            
            if (idx >= 2) {
                if (results.data.children[idx].data.hasOwnProperty('gallery_data')){
                    var imgId = results.data.children[idx].data.gallery_data.items[0].media_id;
                    var img = results.data.children[idx].data.media_metadata[imgId].p[4].u;
                    
                } else if (results.data.children[idx].data.hasOwnProperty("preview")){
                    var img = results.data.children[idx].data.preview.images[0].resolutions[3].url;
                } else {}

            function htmlDecode(input) {
                var doc = new DOMParser().parseFromString(input, "text/html");
                return doc.documentElement.textContent;
            }
                
            img = htmlDecode(img);
             
            $('div#reddit')
                .append('<article class="grid-item"><figure><img class="img-grid-item" src="'+
                img+'"></figure><div class="content"><p><b> Postet af:</b> '
                +results.data.children[idx].data.author+'<br><br>'
                +results.data.children[idx].data.title+
                '</p><br></div><button class="btn--block"><a href="https://www.reddit.com'
                +results.data.children[idx].data.permalink+
                '"> Se opslaget </a></button></article>');
            };
        });
    });
});

  
