## KNVB Dataservice API Wrapper

** Under construction **

Use Composer to install this package and require the autoloader.

You can use the HttpClient to make requests to the API directly or use the Club object to get more abstracted results.


Simple example:

    require_once __DIR__ .'/../vendor/autoload.php';

    // Create a new Club instance
    $club = new Club('mypathname', 'asdf789ASD');

    // Initialize the API
    $club->initialize();
    
    echo $club->getName();

    foreach($club->getTeams() as $team){
        echo $team->teamname;   // or $team->getName();
    }
