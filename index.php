<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Country source engine</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <div class="text-center">
        <div class="container mt-4">
            <h4>Please fill any one field give below and click on submit.</h4>
            <span class="bg-info text-white py-2 px-1">
                <i><b> Note: If you fill both fields, it'll show information based on Country name.</b></i>
            </span>
            <form method="get" action="Submitted.php" class="mt-3">
                <div class="mb-3">
                    <label for="countryName" class="form-label">Country name</label>
                    <input type="text" class="form-control" id="countryName" name="name" placeholder="For ex. - India">
                </div>
                <div class="mb-3">
                    <label for="countryCode" class="form-label">Country code</label>
                    <input type="text" class="form-control" id="countryCode" name="code" placeholder="For ex. - IND">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <?php require 'AllData.php'; ?>
        </div>
</body>

</html>