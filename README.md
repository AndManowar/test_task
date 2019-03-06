# EngineRoom Junction Box Connector
The EngineRoom Junction Box Connector's purpose is to connect to a 
third party API and fetch data.

The connector is a Laravel Package that will be used within the 
EngineRoom Junction Box.

## Building a Connector
You'll need to configure your own ServiceProvider under [src/YourServiceProvider](/src/YourServiceProvider.php) paying close
attention to the `register` method which allows you to bind your
connector.

You'll also need to build your connector class by implementing the 
`ConnectorInterface` interface.

> NOTE: The term `YourConnector` should be changed to the service
or API description, that ultimately identifies this package

## Usage Example
    $connector = new App\src\YourConnector();
    $responseTransformer = new \App\src\Services\ResponseTransformerService();

    $response = $connector->setRequestParams('/api/leads/view/5000702953')->getData()['leads'];

    $leadsData = [];

    foreach ($response as $responseData) {
      $leadsData[] = $responseTransformer->parse($responseData);
    }

    echo '<pre>';
    print_r($leadsData);
    die();

## Dump Example

    Array
    (
        [0] => Array
            (
                [name] => Array
                    (
                        [firstName] => Jane
                        [lastName] => Sampleton (sample)
                    )
    
                [company] => Widgetz.io (sample)
                [email] => janesampleton@gmail.com
                [phone] => 1-926-652-9503
                [address] => Array
                    (
                        [country] => USA
                        [state] => Arizona
                        [city] => Glendale
                        [address] => 604-5854 Beckford St.
                        [zipcode] => 100652
                    )
    
            )
    
        [1] => Array
            (
                [name] => Array
                    (
                        [firstName] => Dummy
                        [lastName] => Head
                    )
    
                [company] => Company Name
                [email] => zuwikir@test.test
                [phone] => 83232415
                [address] => Array
                    (
                        [country] => 
                        [state] => 
                        [city] => 
                        [address] => 
                        [zipcode] => 
                    )
    
            )

    )