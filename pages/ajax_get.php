<?php
require_once('../lib/TwitterAPIExchange.php');

$settings = array(
    'oauth_access_token' => "XXX",
    'oauth_access_token_secret' => "XXX",
    'consumer_key' => "XXX",
    'consumer_secret' => "XXX"
);

$url = 'https://api.twitter.com/1.1/followers/ids.json';
$getfield = '?username=undertaleES';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$result = $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();    


$info = json_decode($result);
$total = count($info->ids);

$followers_sliced = array_slice($info->ids, 0, 2000);

$winner_id = $followers_sliced[array_rand($followers_sliced, 1)];

$url = 'https://api.twitter.com/1.1/users/lookup.json';
$getfield = '?user_id='.$winner_id;
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$result = $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();

$winner_data = json_decode($result);
$winner_data = $winner_data[0];
echo json_encode(array('user'=>$winner_data->name,'account'=>$winner_data->screen_name,'image'=>str_replace('_normal','',$winner_data->profile_image_url)));
?>