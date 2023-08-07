<?php 
/**
 * Twitter API SEARCH
 * Selim Hallaç
 * selimhallac@gmail.com
 * 
 * Modified from tutorial https://www.youtube.com/watch?v=iPnGB7a7dO0 
 */

include "twitteroauth/twitteroauth.php";

$consumer_key = "";
$consumer_secret = "";
$access_token = "";
$access_token_secret = "";

$twitter = new TwitterOAuth($consumer_key,$consumer_secret,$access_token,$access_token_secret);
	
	$tweets = $twitter->get(
		'https://api.twitter.com/1.1/search/tweets.json?q=%23orchids+filter:media+-filter:retweets&include_entities=true&lang=en'
	);
	
	$counter = 0;
	foreach ($tweets->statuses as $key => $tweet) {
		
		if ($tweet->text!=''&& array_key_exists("media",$tweet->entities)){
			$dateT = date_create($tweet->created_at);
			
			echo 
			'<article class="grid-item" ><br>
				<figure >
					<img class="profileImg" src="'.$tweet->user->profile_image_url_https.'" />
					
				</figure>
				
				<div class="content">
					<p>'.$tweet->user->name.'<br> Postet: '.date_format($dateT,"d/m/Y H:i").'</p><br>
					<p>'.$tweet->text.'</p>
				</div>
				<figure>
				<img class="img-grid-item" src="'.$tweet->entities->media[0]->media_url_https.'" />
				</figure>
			</article>';
			$counter++;
		}
		if($counter==4){ break;}	
	}		
?>

