<?php
require_once 'php/operation.php'; //connection to the operation file to connect to db_connection and components

//Get the result set from the database with a SQL query
$result = mysqli_query($conn, "SELECT * FROM contact")
or die(mysqli_error());

//Loop through the result to create a custom array
$contact=[];
while($row = mysqli_fetch_assoc($result)){
    $contact[] =
        [
            'id' => $row['id'],
            'firstname' => $row['firstname'],
            'lastname' => $row['lastname'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'adress' => $row['adress'],
            'zipcode' => $row['zipcode'],
            'city' => $row['city'],
            'state' => $row['state'],
            'products' => $row['products'],
            'date' => $row['date'],
            'time' => $row['time']
            ];
}

//Close connection
$conn->close();
?>
<!doctype html>
<html>
<head>
<!--    Connect to bootstrap font awesome and style.css for the looks -->
    <script src="https://kit.fontawesome.com/587a279f36.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <link href = 'Styles/style.css' type = "text/css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables/responsive.bootstrap4.min.css">
    <script type="text/javascript" src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="plugins/datatables/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="plugins/datatables/responsive.bootstrap4.min.js"></script>
</head>
<body>
<script>
    function GetSelectedValue(){
        var e = document.getElementById("state");
        var result = e.options[e.selectedIndex].value;

        document.getElementById("result").innerHTML = result;
    }
    function GetSelectedText(){
        var e = document.getElementById("state");
        var result = e.options[e.selectedIndex].text;

        document.getElementById("result").innerHTML = result;
    }
</script>
<main>
    <div>
        <!-- Making the form -->
        <div class="container">
            <!-- title of the Form -->
            <h1 class="py-4 text-center"><i class="far fa-calendar-check"></i> Afspraken Toevoegen</h1>
            <div class="d-flex justify-content-center">
                <form action="" method="post" class="w-50">
                    <div class="row g-2">
                        <!-- Using the Function inputElements out of thecomponents.php file for the form inputs -->
                        <? inputElement("col-md-6", "text", "firstname", "Voornaam", "First name"); ?>
                        <? inputElement("col-md-6", "text","lastname", "Achternaam", "Last name"); ?>
                        <? inputElement("col-md-12", "email","email", "Email", "Email"); ?>
                        <? inputElement("col-md-12", "varchar","phone", "Telefoonnumer", "Phone"); ?>
                        <? inputElement("col-md-12", "varchar","adress", "Adres", "Adres"); ?>
                        <? inputElement("col-md-7", "text","city", "Plaats", "City"); ?>
                        <? inputElement("col-md-5", "text","zipcode", "Postcode", "Zipcode"); ?>
                        <!-- Making the dropdown menu for the states in the Netherlands -->
                        <div class="col-md-7">
                            <select id="inputState" class="form-select" placeholder="Provincie"  name="state"">
                                <option selected disabled>Kies...</option>
                                <option value="Drenthe">Drenthe</option>
                                <option value="Flevoland">Flevoland</option>
                                <option value="Friesland">Friesland</option>
                                <option value="Gelderland">Gelderland</option>
                                <option value="Groningen">Groningen</option>
                                <option value="Limburg">Limburg</option>
                                <option value="Noord-Brabant">Noord-Brabant</option>
                                <option value="Noord-Holland">Noord-Holland</option>
                                <option value="Overijssel">Overijssel</option>
                                <option value="Utrecht">Utrecht</option>
                                <option value="Zeeland">Zeeland</option>
                                <option value="Zuid-Holland">Zuid-Holland</option>
                            </select>
                        </div>
                        <!-- setting up the cell for how many products -->
                        <div class="col-md-5">
                            <input type="number" min="0" class="form-control" placeholder="Testen" aria-label="Products" name="products">
                        </div>
                        <!-- setting up the cell for the date -->
                        <div class="col-md-7">
                            <input type="date" class="form-control" placeholder="Datum" aria-label="Date" name="date">
                        </div>
                        <!-- setting up the cell for the time -->
                        <div class="col-md-5">
                            <input type="time" class="form-control" placeholder="Tijd" aria-label="Time" name="time">
                        </div>
                    </div>
                    <div class="row">
                        <!-- setting up the buttons to create, read, update and delete -->
                        <div class="d-flex justify-content-center">
                        <? buttonElement("btn-create", "btn btn-success", "<i class='fas fa-plus'></i>", "create", "dat-toggle='tooltip' data-placement='buttom' title='Toevoegen'");?>
                        <? buttonElement("btn-read", "btn btn-primary", "<i class='fas fa-sync'></i>", "read", "dat-toggle='tooltip' data-placement='buttom' title='Verversen'");?>
                        <? buttonElement("btn-update", "btn btn-light border", "<i class='fas fa-pen-alt'></i>", "update", "dat-toggle='tooltip' data-placement='buttom' title='Updaten'");?>
                        <? buttonElement("btn-delete", "btn btn-danger", "<i class='fas fa-trash-alt'></i>", "delete", "dat-toggle='tooltip' data-placement='buttom' title='Verwijderen'");?>
                    </div>
                </form>
            </div>
        </div>
            <!-- Bootstrap table -->
            <div class="card-body">
                <table id="appointments" class="table dataTable table-striped table-light" width="100%">
                    <thead>
                        <tr>
                            <th colspan="13">Contact Informatie</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Voornaam</th>
                            <th>Achternaam</th>
                            <th>Email</th>
                            <th>Telefoon nummer</th>
                            <th>adres</th>
                            <th>Postcode</th>
                            <th>Plaats</th>
                            <th>Provincie</th>
                            <th>Hoeveel Producten</th>
                            <th>Datum</th>
                            <th>Tijd</th>
                            <th>Aanpassen</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contact as $index => $costumers) { ?>
                            <tr>
                                <td data-id="<?= $costumers['id'] ?>"> <?= $costumers['id'] ?></td>
                                <td data-id="<?= $costumers['id'] ?>"> <?= $costumers['firstname'] ?> </td>
                                <td data-id="<?= $costumers['id'] ?>"> <?= $costumers['lastname'] ?> </td>
                                <td data-id="<?= $costumers['id'] ?>"> <?= $costumers['email'] ?> </td>
                                <td data-id="<?= $costumers['id'] ?>"> <?= $costumers['phone'] ?> </td>
                                <td data-id="<?= $costumers['id'] ?>"> <?= $costumers['adress'] ?> </td>
                                <td data-id="<?= $costumers['id'] ?>"> <?= $costumers['zipcode'] ?> </td>
                                <td data-id="<?= $costumers['id'] ?>"> <?= $costumers['city'] ?> </td>
                                <td data-id="<?= $costumers['id'] ?>"> <?= $costumers['state'] ?> </td>
                                <td data-id="<?= $costumers['id'] ?>"> <?= $costumers['products'] ?> </td>
                                <td data-id="<?= $costumers['id'] ?>"> <?= $costumers['date'] ?> </td>
                                <td data-id="<?= $costumers['id'] ?>"> <?= $costumers['time'] ?> </td>
                                <td><i class="fas fa-edit btnedit" id="edit"></i></td>
                            </tr>
                        <?php }; ?>
                    </tbody>
                </table>
            </div>
        </div>
</main>
<script src="php/main.js"></script>
</body>
</html>
</body>
</html>
