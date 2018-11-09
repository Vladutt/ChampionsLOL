<?php
//HERE we get the last virsion of the game
$getVersion = file_get_contents('https://ddragon.leagueoflegends.com/api/versions.json');
$version = json_decode($getVersion, true);
// ↑ $version[0] is the last version

// Now we need to search the all champions
$url = "http://ddragon.leagueoflegends.com/cdn/".$version[0]."/data/en_US/champion.json";
$ch =  curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_TIMEOUT, 3);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
$result = curl_exec($ch);
$result = json_decode($result, true);
// All Champ are here ↑ $result['data']

$Champions = []; // New array , because we need to create a new structure
    foreach($result['data'] as $data){
        $Champions[$data['key']] = [
            'name' => $data['name'],
            'image' => $data['image']['full']
        ];
    }
    
//the structure of $Champions will be like this
/* 266 is the id of champion
Array
(
    [266] => Array
        (
            [name] => Aatrox
            [image] => Aatrox.png
        )
)
*/

//Here we verify the ID and show the name - 40 its the champ ID 
    if(isset($Champions['40'])){
        echo $Champions['40']['name'];
    }
