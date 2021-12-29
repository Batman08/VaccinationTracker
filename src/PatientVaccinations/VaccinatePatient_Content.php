<?php
session_start();
$medicalPersonName = GetMedicalPersonName($_SESSION['MedicalPersonId']);
$vaccinationCentres = GetVaccinationCentre();
?>

<html>
<body>
    <?php foreach ($medicalPersonName as $name) { ?>
        <?php echo $name['MedicalPersonName']; ?>
    <?php } ?>


    <select name="txtUsername" class="form-select" aria-label="select user">
        <option selected disabled="disabled">-- Select User --
            <?php foreach ($vaccinationCentres as $vaccinationCentre) { ?>
        <option value="<?= $vaccinationCentre['VaccinationCentreId'] ?>"><?= $vaccinationCentre['VaccinationCentreName'] ?></option>
    <?php } ?>
    </select>
</body>
</html>