## KNVB Dataservice API Wrapper

** Under construction **

Use Composer to install this package (`"fruitcakestudio/knvb-dataservice-api": "0.1.x@dev",`) and require the autoloader.

You can use the HttpClient to make requests to the API directly or use the API object to get more abstracted results.

All objects have public properties, matching the key/value from the API directly.

See the documentation on http://api.knvbdataservice.nl/v2/

Simple example:

```php
require_once __DIR__ .'/../vendor/autoload.php';

use KNVB\Dataservice\Api;

// Create a new API instance
$api = new Api($pathname, $key);

// Initialize the club
$club = $api->getClub();

echo $club->getName();
echo $club->getBanner()->getOutput('leaderboard');

$matches = $club->getMatches();
$competitions = $club->getCompetitions();

foreach($club->getTeams() as $team){
    echo $team->getName();
    $results = $team->getResults();
    $schedule = $team->getSchedule();
    
    foreach($team->getCompetitions() as $competition){
        echo $competition->getName();
        $results = $competition->getResults();
        $schedule = $competition->getSchedule();
        $ranking = $competition->getRanking();
    }
}
```