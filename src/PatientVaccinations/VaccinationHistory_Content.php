<?php
session_start();
$medicalPerson = GetMedicalPerson($_SESSION['medicalPersonId'])[0];
$totalMedicalPersonVaccinations = GetTotalMedicalPersonVaccinations($_SESSION['medicalPersonId']);
$vaccinationHistory = GetVaccinationHistory($_SESSION['medicalPersonId']);
?>

<div class="row">
    <div class="col-sm-12">
        <h3><i class="fas fa-user"></i> <?= $medicalPerson['FirstName'] . ' ' . $medicalPerson['LastName'] . ' - ' . $medicalPerson['Profession']; ?></h3>
        <div class="text-muted"><?= $medicalPerson['Address'] . ', ' . $medicalPerson['Postcode'] . ', Tel:' . $medicalPerson['Telephone']; ?></div>
    </div>
</div>

<div class="row padBottom30">
    <div class="col-sm-12" style="text-align: right;">
        <a href="VaccinatePatient.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
</div>

<div class="alert alert-primary" role="alert" style="font-weight: bold;">
    <h5>Vaccination History</h5>
    Total Number of Vaccinations: <?= $totalMedicalPersonVaccinations ?>
</div>

<table class="table table-striped table-hover">
    <colgroup></colgroup>
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