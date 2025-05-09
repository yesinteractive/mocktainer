<?php
/*
 *
 *   Sample controller functions showcased on FSL Launch Page
 *
*/

function process_time() {
    $time = number_format(microtime(true) - LIM_START_MICROTIME, 6);
    return ($time);
}

/*
 *
 * function
 *
*/

function api() {

    status(200);
 
    if ((!empty(params('uri_param'))) && (file_exists(__DIR__ ."/../endpoints/".params('uri_param').".csv"))) {
        return json(mockdata(params('uri_param').".csv") , JSON_UNESCAPED_SLASHES);
    }
     else if ((empty(params('uri_param')))) {
     //  return html("test"); uncomment to return html by default on root request rather than json

                $arr = array(
            'Welcome to Mocktainer' => "Mock various api responses accross various endpoints spanning various verticals and applications",
            "Git Hub" => "https://github.com/yesinteractive/mocktainer",
            "Version" => "v".option('app_version'),
              'Usage' => ["Endpoints" => ["/accounts"=>"Returns mock bank accounts ",
                                          "/customers"=>"Returns mock customer list with customer details.",
                                          "/employees"=>"Returns mock employees .",
                                          "/inventory"=>"Returns mock product inventory",
                                          "/orders"=>"Returns mock product orders",
                                          "/portfolio"=>"Returns mock investment portfolio",
                                          "/trades"=>"Returns list of mock brockerage trades",]     ,
                          "Records" => "You may specify number of records (up to 250) to return by specifying ?n=<number> in query string. otherwise 10 records returned.",
                  "Echo Service" => "Add a /echo in the URI after any of the endpoints supported to echo back in the incoming request information."

              ]
              
        );
        // status(202); //returns HTTP status code of 202
        status(200); //returns HTTP status code of 202
        return json($arr,JSON_UNESCAPED_SLASHES);
        
    }
    else {
        $arr = array(
            'Error' => "This is not a valid endpoint."
        );
        // status(202); //returns HTTP status code of 202
        status(404); //returns HTTP status code of 202
        return json($arr,JSON_UNESCAPED_SLASHES);
    }

}

/*
 *
 * function
 *
*/

function mockdata($file) {
    $results = array();
    if (isset($_REQUEST['n'])) {
        $num = $_REQUEST['n'];
      if ($num > 250){
        //if user requested more than 250 records
        status(500); //returns HTTP status code of 202
        $arr = array(
            'Error' => "You can only request up to 250 records at one time."
        );
        return $arr;
        // status(202); //returns HTTP status code of 202
        
      } else { }
    }
    else {
        $num = 10;
    }

    $f_contents = file(__DIR__ ."/../endpoints/". $file);
    $headers = explode(",", $f_contents[0]);

    $output = array();

    for ($x = 0;$x < $num;$x++) {
        $line = $f_contents[rand(0, count($f_contents) - 1) ];
        $line = str_getcsv($line, ",", '"');
        //$line = explode(",", $line);
        for ($y = 0;$y < count($headers);$y++) {
            $csvData[trim($headers[$y]) ] = trim($line[$y]);
        }

        array_push($output, $csvData);

    }

    $headers = getallheaders();

    if (option('behind_proxy') == TRUE || getenv("APP_BEHIND_PROXY") == "TRUE") {
        if (isset($headers['X-Forwarded-Host'])) {
            $headers['Host'] = $headers['X-Forwarded-Host'];
        }
    }

    if((!empty(params('echo')))&& (params('echo')=="echo")){
        $request = ["Request"=>["Headers"=>$headers,
        "Method"=>$_SERVER['REQUEST_METHOD'],
        "Origin"=>$_SERVER['REMOTE_ADDR'],
        "URI"=>(option('behind_proxy') == TRUE || getenv("APP_BEHIND_PROXY") == "TRUE" ? $_REQUEST['uri'] : preg_replace('/\?.*/', '', $_SERVER['REQUEST_URI'])),
        "HOST"=>(option('behind_proxy') == TRUE || getenv("APP_BEHIND_PROXY") == "TRUE" ? ($headers['X-Forwarded-Host'] ?? $_SERVER['HTTP_HOST']) : $_SERVER['HTTP_HOST']),
        "Arguments"=>$_REQUEST,
        "Data"=>file_get_contents('php://input'),
        "URL"=>(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://"
            . (option('behind_proxy') == TRUE || getenv("APP_BEHIND_PROXY") == "TRUE" ? ($headers['X-Forwarded-Host'] ?? $_SERVER['HTTP_HOST']).$_REQUEST['uri']: "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ),
    ]];
        status(200); //returns HTTP status code of 202
        $output = ["Results"=>$output];
        return array_merge($output,$request);
    } else{
        $output = ["Results"=>$output];
        return $output;
    }

    return $output;

}
?>
