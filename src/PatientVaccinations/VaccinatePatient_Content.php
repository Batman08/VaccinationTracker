<?php
session_start();
$medicalPerson = GetMedicalPerson($_SESSION['medicalPersonId'])[0];
$vaccinationCentres = GetVaccinationCentres();
$vaccinationTypes = GetVaccinationTypes();
?>

<div class="row padBottom10">
    <div class="col-sm-12">
        <h3><?= $medicalPerson['FirstName'] . ' ' . $medicalPerson['LastName'] . ' - ' . $medicalPerson['Profession']; ?></h3>
        <div class="text-muted"><?= $medicalPerson['Address'] . ', ' . $medicalPerson['Postcode'] . ', Tel:' . $medicalPerson['Telephone']; ?></div>
    </div>
</div>

<div class="row padBottom10">
    <div class="col-sm-3">
        Choose Vaccination Centre:
    </div>
    <div class="col-sm-9">
        <select name="ddlVaccinationCentre" class="form-select" aria-label="select vaccination centre">
            <option selected disabled="disabled">-- Select Vaccination Centre --</option>
                <?php foreach ($vaccinationCentres as $vaccinationCentre) { ?>
            <option value="<?= $vaccinationCentre['VaccinationCentreId'] ?>"><?= $vaccinationCentre['VaccinationCentreName'] ?></option>
        <?php } ?>
        </select>
    </div>
</div>

<hr />

<form action="ViewNewPatient_content.php" method="post">

    <div class="form-group padBottom10">
        <label for="vaccination_datetime">Date</label>
        <input type="datetime-local" class="form-control" id="vaccination_datetime" name="vaccination_datetime">
    </div>
    <div class="form-group padBottom10">
        <label for="patient_first_name">Patient First Name</label>
        <input type="text" class="form-control" id="patient_first_name" name="patient_first_name" placeholder="Enter Patient First Name">
    </div>
    <div class="form-group padBottom10">
        <label for="patient_last_name">Patient Last Name</label>
        <input type="text" class="form-control" id="patient_last_name" name="patient_last_name" placeholder="Enter Patient Last Name">
    </div>
    <div class="form-group padBottom10">
        <label for="patient_dob">Date of Birth</label>
        <input type="date" class="form-control" id="patient_dob" name="patient_dob">
    </div>
    <div class="form-group padBottom10">
        <label for="vaccination_type">Vaccination Type</label>
        <select name="ddlVaccinationType" class="form-select" aria-label="select user">
            <option selected disabled="disabled">-- Select Vaccination Type --</option>
                <?php foreach ($vaccinationTypes as $vaccinationType) { ?>
            <option value="<?= $vaccinationType['VaccinationTypeId'] ?>"><?= $vaccinationType['Name'] ?></option>
        <?php } ?>
        </select>
    </div>
    <div class="form-group padBottom10">
        <label for="patient_address">Patient Address</label>
        <input type="text" class="form-control" id="patient_address" name="patient_address" placeholder="Enter Patient Address">
    </div>
    <div class="form-group padBottom10">
        <label for="patient_postcode">Patient Postcode</label>
        <input type="text" class="form-control" id="patient_postcode" name="patient_postcode" placeholder="Enter Patient Postcode">
    </div>
    <div class="form-group padBottom10">
        <label for="patient_phone_number">Patient Phone Number</label>
        <input type="tel" class="form-control" id="patient_phone_number" name="patient_phone_number" placeholder="Enter Patient Phone Number">
    </div>
    <div class="form-group padBottom10">
    <button type="submit" class="btn btn-primary mb-3">Add Patient</button>
  </div>
</form>