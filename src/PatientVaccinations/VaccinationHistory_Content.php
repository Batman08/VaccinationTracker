<?php
session_start();
$medicalPerson = GetMedicalPerson($_SESSION['medicalPersonId'])[0];
$vaccinationHistory = GetVaccinationHistory($_SESSION['medicalPersonId']);
?>

<div class="row padBottom10">
    <div class="col-sm-12">
        <h3><?= $medicalPerson['FirstName'] . ' ' . $medicalPerson['LastName'] . ' - ' . $medicalPerson['Profession']; ?></h3>
        <div class="text-muted"><?= $medicalPerson['Address'] . ', ' . $medicalPerson['Postcode'] . ', Tel:' . $medicalPerson['Telephone']; ?></div>
    </div>
</div>

<hr />

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Date & Time</th>
            <th scope="col">Vaccination Centre</th>
            <th scope="col">Patient Name</th>
            <th scope="col">Vaccination Type</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($vaccinationHistory as $vh) { ?>
            <tr>
                <td><?= $vh['RowNum'] ?></td>
                <td><?= $vh['DateTime'] ?></td>
                <td><?= $vh['VaccinationCentre'] ?></td>
                <td><?= $vh['PatientName'] ?></td>
                <td><?= $vh['VaccinationType'] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>