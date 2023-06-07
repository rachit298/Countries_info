<?php 

    foreach ($response_data as $value) {

        echo (
            '<div>
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Country: ' . $value->name->common . '</h5>
                        <p class="card-text">Country code: ' . $value->cca3 .  '</p>
                        <a href="http://localhost/CountrySE/Submitted.php?name=&code=' 
                        . $value->cca3 .'"'
                        . ' class="btn btn-primary">Show Details</a>
                    </div>
                </div>
            </div>'
        );
    }
