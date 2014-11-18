## KNVB Dataservice API Wrapper

** Under construction **

Use Composer to install this package and require the autoloader.

You can use the HttpClient to make requests to the API directly or use the API object to get more abstracted results.

All objects have public properties, matching the key/value from the API directly.


Simple example:

    require_once __DIR__ .'/../vendor/autoload.php';

    use KNVB\Dataservice\Api;

    // Create a new API instance
    $api = new Api();
    
    // Initialize the club
    $club = $api->initializeClub($pathname, $key);

    echo $club->getName();
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