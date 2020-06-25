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
    if ((!empty(params('uri_param'))) && (params('uri_param') == "customers")) {
        return json(mockdata("customers.csv") , JSON_UNESCAPED_SLASHES);
    }
    else if ((!empty(params('uri_param'))) && (params('uri_param') == "portfolio")) {
        return json(mockdata("portfolio.csv") , JSON_UNESCAPED_SLASHES);
    }
    else if ((!empty(params('uri_param'))) && (params('uri_param') == "trades")) {
        return json(mockdata("trades.csv") , JSON_UNESCAPED_SLASHES);
    }
    else if ((!empty(params('uri_param'))) && (params('uri_param') == "employees")) {
        return json(mockdata("employees.csv") , JSON_UNESCAPED_SLASHES);
    }
      else if ((empty(params('uri_param')))) {
                $arr = array(
            'Welcome to Mocktainer.io' => "Choose a valid endpoint: customers, portfolio, trades, employees. By default 10 records will return, but you can specify more or less by specifying in querystring with ?n=<some_number>"
        );
        // status(202); //returns HTTP status code of 202
        status(200); //returns HTTP status code of 202
        return json($arr);
    }
    else {
        $arr = array(
            'Error' => "This is not a valid endpoint."
        );
        // status(202); //returns HTTP status code of 202
        status(404); //returns HTTP status code of 202
        return json($arr);
    }

}

/*
 *
 * function
 *
*/

function mockdata($file) {

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

    $f_contents = file("controllers/$file");
    $headers = explode(",", $f_contents[0]);

    $output = array();

    for ($x = 0;$x < $num;$x++) {
        $line = $f_contents[rand(0, count($f_contents) - 1) ];
        $line = explode(",", $line);
        for ($y = 0;$y < count($headers);$y++) {
            $csvData[trim($headers[$y]) ] = trim($line[$y]);
        }

        array_push($output, $csvData);

    }

    return $output;

}
?>
