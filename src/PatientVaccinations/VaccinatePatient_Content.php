<?php
session_start();
$medicalPersonName = GetMedicalPersonName($_SESSION['MedicalPersonId']);
$vaccinationCentres = GetVaccinationCentres();
?>

<html>

<body>
    <?php foreach ($medicalPersonName as $name) { ?>
        <label><?= 'Medical Person: ' . $name['MedicalPersonName']; ?></label>
    <?php } ?>

    </br>
    </br>

    <label for="txtVaccinationCentre">Choose Vaccination Centre:</label>
    <select name="txtVaccinationCentre" class="form-select" aria-label="select user">
        <option selected disabled="disabled">-- Select Vaccination Centre --
            <?php foreach ($vaccinationCentres as $vaccinationCentre) { ?>
        <option value="<?= $vaccinationCentre['VaccinationCentreId'] ?>"><?= $vaccinationCentre['VaccinationCentreName'] ?></option>
    <?php } ?>
    </select>
</body>

</html>