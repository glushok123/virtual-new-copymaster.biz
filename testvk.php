<?php

//foreach($obj['response'] as $photo) {
//  echo $photo['owner_id'] . '_' . $photo['pid']  . PHP_EOL;
//}


$params = array(
    'owner_id' => '-210965475',
    'album_id' => '283484773',
    'v' => '6.69',
    'access_token' => 'bea612cebea612cebea612ce66befdd80fbbea6bea612cee4ba2830bf89a26a4e2d4958' // SAK
);


$response = json_decode(file_get_contents('https://api.vk.com/method/photos.get?' . http_build_query($params)), true);

//var_dump($response);

$urls = array();
for ($i = 0; $i < $response['response']['count']; $i++) {
    array_push($urls, $response['response']['items'][$i]['sizes'][5]['url'] . PHP_EOL);
}
$kol = count($urls);

?>

<?php echo $urls[$kol-1]; ?>
echo "<img src=".$urls[$kol-1]." >";
echo "<img src=".$urls[$kol-2]." >";
echo "<img src=".$urls[$kol-3]." >";
echo "<img src=".$urls[$kol-4]." >";
echo "<img src=".$urls[$kol-5]." >";
