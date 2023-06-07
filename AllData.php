<div class="container mt-3 text-center">
    <div class="row">
        <?php

        $rest_api_url = 'https://restcountries.com/v3.1/all';

        $json_data = file_get_contents($rest_api_url);

        $response_data = json_decode($json_data);

        foreach ($response_data as $value) {

            echo (
                '<div class=" col-sm-6 col-md-4 col-lg-3 p-2" >
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Country: ' . $value->name->common . '</h5>
                            <p class="card-text">Country code: ' . $value->cca3 .  '</p>
                            <a href="http://localhost/CountrySE/Submitted.php?name=&code=' . $value->cca3 .'"'
                            . 'class="btn btn-primary">Show Details</a>
                        </div>
                    </div>
                </div>'
            );
        }
        ?>
    </div>
</div>