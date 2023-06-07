
<?php

foreach ($response_data as $value) {

    echo ('
        <div class="card" style="width: 100%;">
            <div class="card-header">Country name: ' . $value->name->common . '</div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"> Capital of country: ' . $value->capital[0] . '</li>
                <li class="list-group-item">Total Population: ' . $value->population . '</li>
                <li class="list-group-item">Total Area: ' . $value->area . '</li>
                <li class="list-group-item">Borders: '
        . borders($value)
        .   '</li>
                <li class="list-group-item">Languages spoken: '
        . languages($value->languages)
        .   '</li>
            </ul>
        </div>
        <br/>
    ');
}

function borders($obj)
{

    if (!isset($obj->borders)) {
        return "None";
    }

    $borders = $obj->borders;

    $allBorders = '';

    for ($index = 0; $index < sizeof($borders); $index++) {

        $rest_api_url = 'https://restcountries.com/v3.1/alpha/' . $borders[$index];

        $json_data = file_get_contents($rest_api_url);

        $response_data = json_decode($json_data);

        $allBorders .= $response_data[0]->name->common;

        $allBorders .= ($index == sizeof($borders) - 1) ? '' : ', ';
    }

    return $allBorders;
}

function languages($languages)
{
    $allLanguages = "";
    $count = 0;

    foreach ($languages as $key => $value) {

        $allLanguages .= $value;

        if (++$count != sizeof((array)$languages)) {
            $allLanguages .= ", ";
        }
    }

    return $allLanguages;
}

?>
