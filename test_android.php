<?php 
require_once  '/vendor/autoload.php' ;
$client = new Google\Client();
$client->setApplicationName("Client_Library_Examples");
$client->setDeveloperKey("YOUR_APP_KEY");
$service = new Google_Service_Books($client);
$optParams = array(
  'filter' => 'free-ebooks',
  'q' => 'Henry David Thoreau'
);
$results = $service->volumes->listVolumes($optParams);

foreach ($results->getItems() as $item) {
  echo $item['volumeInfo']['title'], "<br /> \n";
}
 ?>