## KNVB Dataservice API Wrapper

** Under construction **

Use Composer to install this package and require the autoloader.

You can use the Client to make requests to the API and get a Response/Result object back.
If you want to get the raw results, you can use the HttpClient directly.

A response consists of a Code, Message and List. It can also create Result objects,
either for the first result or all results.

Keys in a Result object are normalized (lowercased + dashes/underscores removed),
so it doesn't matter if you want to get 'clubId', 'club_id' or 'clubid'.
You can use $request->get('club_id') or $request->getClubId() for example

Simple example:

    require_once __DIR__ .'/../vendor/autoload.php';

    // Create a new Client
    $client = new KNVB\Dataservice\Client();

    // Initialize the API
    $response = $client->initialize($pathname, $key);

    // Get info from the API response
    $code = $response->getCode();
    $message = $response->getMessage();
    $list = $response->getList();

    // Use the Result object to get more information about the first result
    $result = $response->getResult();
    $club = $result->get('clubnaam');
    $logo = $result->getLogo();

    // Make a new request and get an array of Result objects
    $response = $client->get('teams');
    foreach($response->getResults() as $result){
        echo $result->getTeamName();
    }
