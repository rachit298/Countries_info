<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Country source engine</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-4">
        <?php

        include 'mySqlConnection.php';

        $name = $_GET["name"];
        $code = $_GET["code"];

        if (!empty($name)) {

            //handles names with space in between 
            //For ex. hong kong
            $updated_name = str_replace(' ', '%20', $name);

            $rest_api_url = "https://restcountries.com/v3.1/name/" . $updated_name;

            $response_data = handlesResponse($rest_api_url);

            if (empty($response_data[0]->name->common)) {

                handlesWrongKeyword();
            } else {

                handlesDB($conn, $name, $response_data);

                require 'filteredList.php';
    
            }
        } elseif (!empty($code)) {

            $rest_api_url = "https://restcountries.com/v3.1/alpha/" . $code;

            $response_data = handlesResponse($rest_api_url);

            if (empty($response_data[0]->name->common)) {

                handlesWrongKeyword();
            } else {

                handlesDB($conn, $response_data[0]->name->common, $response_data);

                require 'ShowDetails.php';
                
            }
        }

        function handlesDB($conn, $name, $response_data)
        {

            //database related code
            $nameToUpper = strtoupper($name);

            $check_data = "SELECT name,count FROM country_detail WHERE name = '" . $nameToUpper . "'";

            $insert_new_data = "INSERT INTO country_detail (name, count) VALUES ('$nameToUpper',1)";

            $result = mysqli_query($conn, $check_data);

            // check data
            if ($result && mysqli_num_rows($result) > 0) {

                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];

                //update data
                $new_count = $count + 1;

                $update_data = "UPDATE country_detail SET count=" . $new_count . " WHERE name='" . $nameToUpper . "'";

                mysqli_query($conn, $update_data);
            } elseif (!empty($response_data[0]->name->common)) {
                //create new data
                mysqli_query($conn, $insert_new_data);
            }

            mysqli_close($conn);
        }

        function handlesResponse($rest_api_url)
        {

            $json_data = file_get_contents($rest_api_url);

            return json_decode($json_data);
        }

        function handlesWrongKeyword()
        {

            echo ('<h4 class="text-center">Your search keyword does not match any Country name.</h4>');
        }

        ?>
    </div>
</body>

</html>