<?php 
    $unsplashUrl ="https://api.unsplash.com/search/photos/?";
	$apiKey ="client_id=";
    $query ="&query=orchid";			
    $url = $unsplashUrl.$apiKey.$query;
      
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);  
    curl_setopt($ch, CURLOPT_HEADER, 0);  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 

    $output = curl_exec($ch);
    $array = json_decode($output, true);
    $resultater = $array['results'];
    
    for ($i=0; $i < 4; $i++) {
        ?>
            <article class="grid-item">
                <figure>
                    <img class="img-grid-item" src="
                        <?php echo $resultater[$i]['urls']['small'];?>
                    "/>
                    <br>
                    <figcaption class="content">
                        Billede af <a href="<?php echo $resultater[$i]['links']['html'];?>">
                        <?php echo $resultater[$i]['user']['name'];?></a> fra unsplash
                    </figcaption>
                </figure>
            </article>
        <?php
    };
?>
