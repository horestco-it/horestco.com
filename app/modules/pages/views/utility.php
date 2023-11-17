<?php
$user = 'irnovi@horestco.com';
$pass = 'wahid@satu@siji';
$scriptUri = "http://".$_SERVER["HTTP_HOST"].$_SERVER['PHP_SELF'];

// $client = new Google_Client();
// $client->setApplicationName("horestco-product");
// $client->setDeveloperKey("AIzaSyDxuxx1Cmxv-RWdA8pt9uavpQNX0VHiTw4");
// $client->setAccessType('online'); // default: offline
// $client->setClientId('653775770186-t4h0hp8v00oeh1ddj9qskhdfcnlchnf7.apps.googleusercontent.com');
// $client->setClientSecret('1AXhTDOXKYmQWzlfq8czRDEI');
// $client->setRedirectUri($scriptUri);

$client = new Google_Client();
/************************************************
  ATTENTION: Fill in these values, or make sure you
  have set the GOOGLE_APPLICATION_CREDENTIALS
  environment variable. You can get these credentials
  by creating a new Service Account in the
  API console. Be sure to store the key file
  somewhere you can get to it - though in real
  operations you'd want to make sure it wasn't
  accessible from the webserver!
 ************************************************/

// Access Token is used for Steps 2 and beyond
$tokenArray = $client->getAccessToken();
$accessToken = $tokenArray["access_token"];
$fileId = '1mpmypwVBstccBosOMflDYv98k1AgNFRPEYxTlWPqzKE';

// Section 3: Uncomment to get the table data
$url = "https://www.googleapis.com/drive/v2/files/";
$method = 'GET';
$httpClient = new GuzzleHttp\Client(['base_uri'=>$url]);
$resp = $httpClient->request($method, $fileId);
// $body = $resp->getBody()->getContents();
// $code = $resp->getStatusCode();
// $reason = $resp->getReasonPhrase();
// echo "$code : $reason\n\n";
// echo "$body\n";
// Section 4: Uncomment to add a row to the sheet
// $url = "https://spreadsheets.google.com/feeds/list/$fileId/od6/private/full";
// $method = 'POST';
// $headers = ["Authorization" => "Bearer $accessToken", 'Content-Type' => 'application/atom+xml'];
// $postBody = '<entry xmlns="http://www.w3.org/2005/Atom" xmlns:gsx="http://schemas.google.com/spreadsheets/2006/extended"><gsx:gear>more gear</gsx:gear><gsx:quantity>44</gsx:quantity></entry>';
// $httpClient = new GuzzleHttp\Client(['headers' => $headers]);
// $resp = $httpClient->request($method, $url, ['body' => $postBody]);
// $body = $resp->getBody()->getContents();
// $code = $resp->getStatusCode();
// $reason = $resp->getReasonPhrase();
// echo "$code : $reason\n\n";
// echo "$body\n";
// Section 5: Uncomment to edit a row
// You'll need to get the etag and row ID, and send a PUT request to the edit URL
// $rowid = 'cre1l';                 // got this and the etag from the table data output from section 3
// $etag = 'NQ8SVE8fDSt7ImA.';
// $url = "https://spreadsheets.google.com/feeds/list/$fileId/od6/private/full/$rowid";
// $method = 'PUT';
// $headers = ["Authorization" => "Bearer $accessToken", 'Content-Type' => 'application/atom+xml', 'GData-Version' => '3.0'];
// $postBody = "<entry xmlns=\"http://www.w3.org/2005/Atom\" xmlns:gsx=\"http://schemas.google.com/spreadsheets/2006/extended\" xmlns:gd=\"http://schemas.google.com/g/2005\" gd:etag='&quot;$etag&quot;'><id>https://spreadsheets.google.com/feeds/list/$fileid/od6/$rowid</id><gsx:gear>phones</gsx:gear><gsx:quantity>6</gsx:quantity></entry>";
// $httpClient = new GuzzleHttp\Client(['headers' => $headers]);
// $resp = $httpClient->request($method, $url, ['body' => $postBody]);
// $body = $resp->getBody()->getContents();
// $code = $resp->getStatusCode();
// $reason = $resp->getReasonPhrase();
// echo "$code : $reason\n\n";
// echo "$body\n";
// Section 6: Uncomment to parse table data with SimpleXML
// $url = "https://spreadsheets.google.com/feeds/list/$fileId/od6/private/full";
// $method = 'GET';
// $headers = ["Authorization" => "Bearer $accessToken", "GData-Version" => "3.0"];
// $httpClient = new GuzzleHttp\Client(['headers' => $headers]);
// $resp = $httpClient->request($method, $url);
// $body = $resp->getBody()->getContents();
// $tableXML = simplexml_load_string($body);
// echo "Rows:\n";
// foreach ($tableXML->entry as $entry) {
//   $etag = $entry->attributes('gd', TRUE);
//   $id = $entry->id;
//   echo "etag: $etag\n";
//   echo "id: $id\n";
//   foreach ($entry->children('gsx', TRUE) as $column) {
//     $colName = $column->getName();
//     $colValue = $column;
//     echo "$colName : $colValue\n";
//   }
// }