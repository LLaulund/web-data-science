<?php
	/* URL til feed */
    $url = "http://orchidkarma.com/feed/";
     
    if(@simplexml_load_file($url)){
        $input = file_get_contents($url);
        $input = str_replace("<content:encoded>","<contentEncoded>",$input);
        $input = str_replace("</content:encoded>","</contentEncoded>",$input);
        $feeds = simplexml_load_string($input);
    }else{
        echo "<h2>Invalid RSS feed URL.</h2>";
    }
    
    $i=0;
    if(!empty($feeds)){

        $site = $feeds->channel->title;
        $sitelink = $feeds->channel->link;

        foreach ($feeds->channel->item as $item) {

            $title = $item->title;
            $url = $item->link;
            $description = $item->description;
            $postDate = $item->pubDate;
            $pubDate = date('d/m Y',strtotime($postDate));
            $content = $item->contentEncoded;

            // Nedenstående kode er inspireret Double You Media. (u.å.). PHP: Find and extract all links from a HTML string. ThisInterestsMe.com.:
            // https://thisinterestsme.com/php-find-links-in-html/

            //Instantiate the DOMDocument class.
            $htmlDom = new DOMDocument;

            //Parse the HTML of the page using DOMDocument::loadHTML
            @$htmlDom->loadHTML($content);

            //Extract the links from the HTML.
            $links = $htmlDom->getElementsByTagName('img');

            //Array that will contain our extracted links.
            $extractedLinks = array();

            //Loop through the DOMNodeList.
            //We can do this because the DOMNodeList object is traversable.
            foreach($links as $link){

                //Get the link in the src attribute.
                $linkSrc = $link->getAttribute('src');
         
                //If the link is empty, skip it and don't
                //add it to our $extractedLinks array
                if(strlen(trim($linkSrc)) == 0){
                    continue;
                }

                //Skip if it is a hashtag / anchor link.
                if($linkSrc[0] == '#'){
                    continue;
                }

                //Add the link to our $extractedLinks array.
                array_push($extractedLinks,$linkSrc);
                //$extractedLinks[] = array($linkHref);
            }
                        
            if($i>=4){break;} 
    
            echo '<article class="grid-item" ><br>
            <h3>'.$title.'</h3><br>
            <figure >
            <img class="img-grid-item" src="'.$extractedLinks[0].'" />
            </figure>
            <div class="content">
                <p>Udgivet: '.$pubDate.' på <a href="'.$sitelink.'">'.$site.'</a></p><br>
                <p>'.$description.'</p>
            </div>
            <button class="btn--block"><a href="'.$url.'"> Se blogpost </a></button>
            </article>';
            
            $i++;
        }
    }
?>
       
