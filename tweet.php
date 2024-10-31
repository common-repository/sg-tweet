<?php
/*
Plugin Name: sg-tweet
Plugin URI: http://www.sureglass.com/plugins/sg-tweet/
Description: Display the latest tweet from a Twitter account. Put <code>&lt;?php sgLatestTweet('YOURTWITTERUSERNAME'); ?&gt;</code> anywhere in your template.
Version: 1.0
Author: sureglass
Author URI: http://www.sureglass.com/
*/

	function sgLatestTweet($username){

		$xml = simplexml_load_file("http://twitter.com/statuses/user_timeline/$username.xml?count=1") or die("Either <b>$username</b> is not a valid Twitter account or there was an error connecting to Twitter.");

		foreach($xml->status as $update){ $tweet = $update->text; }
	
		if($tweet == null){	
			echo "<b>$username</b> has not posted a single Tweet yet.";
		}
		else {
			preg_match('/(http:\/\/)(.*)/', $tweet, $link);
			if (empty($link[0])) {
				echo $tweet;
			} else {
				$url = "<a href=\"$link[0]\">$link[0]</a>";
				$tweet = str_replace($link[0], $url, $tweet);
				echo $tweet;
			}
		}

	}

?>