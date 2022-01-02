<?php
session_start();
$medicalPerson = GetMedicalPerson($_SESSION['medicalPersonId'])[0];
$vaccinationCentres = GetVaccinationCentres();
$vaccinationTypes = GetVaccinationTypes();
?>

<div class="row">
    <div class="col-sm-12">
        <h3><i class="fas fa-user"></i> <?= $medicalPerson['FirstName'] . ' ' . $medicalPerson['LastName'] . ' - ' . $medicalPerson['Profession']; ?></h3>
        <div class="text-muted"><?= $medicalPerson['Address'] . ', ' . $medicalPerson['Postcode'] . ', Tel:' . $medicalPerson['Telephone']; ?></div>
    </div>
</div>

<div class="row padBottom30">
    <div class="col-sm-12" style="text-align: right;">
        <a href="/PatientVaccinations/VaccinationHistory.php" class="btn btn-success"><i class="fas fa-book-medical"></i> Vaccination History</a>
    </div>
</div>

<form action="VaccinatePatient_Save.php" method="post">

    <div class="row padBottom10">
        <div class="col-md-3">
            Choose Vaccination Centre:
        </div>
        <div class="col-md-9">
            <select name="ddlVaccinationCentre" class="form-select" aria-label="select vaccination centre" required>
                <option value="">-- Select Vaccination Centre --</option>
                <?php foreach ($vaccinationCentres as $vaccinationCentre) { ?>
                    <option value="<?= $vaccinationCentre['VaccinationCentreId'] ?>"><?= $vaccinationCentre['Name'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group padBottom10">
        <label for="vaccination_datetime">Date</label>
        <input type="datetime-local" class="form-control" name="txtDateTime" required>
    </div>
    <div class="form-group padBottom10">
        <label for="vaccination_type">Vaccination Type</label>
        <select name="ddlVaccinationType" class="form-select" aria-label="select user" required>
            <option value="">-- Select Vaccination Type --</option>
            <?php foreach ($vaccinationTypes as $vaccinationType) { ?>
                <option value="<?= $vaccinationType['VaccinationTypeId'] ?>"><?= $vaccinationType['Name'] ?></option>
            <?php } ?>
        </select>
    </div>

    <hr/>
    
    <div class="form-group padBottom10">
        <label for="patient_first_name">Patient Identifier</label>
        <input type="text" class="form-control" name="txtPatientUniqueId" placeholder="Enter Unique Patient Identifier" maxlength="256" required>
    </div>
    <div class="form-group padBottom10">
        <label for="patient_first_name">Patient First Name</label>
        <input type="text" class="form-control" name="txtPatientFirstName" placeholder="Enter Patient First Name" maxlength="256" required>
    </div>
    <div class="form-group padBottom10">
        <label for="patient_last_name">Patient Last Name</label>
        <input type="text" class="form-control" name="txtPatientLastName" placeholder="Enter Patient Last Name" maxlength="256" required>
    </div>
    <div class="form-group padBottom10">
        <label for="patient_dob">Date of Birth</label>
        <input type="date" class="form-control" name="txtPatientDOB" required>
    </div>
    <div class="form-group padBottom10">
        <label for="patient_address">Patient Address</label>
        <input type="text" class="form-control" name="txtPatientAddress" placeholder="Enter Patient Address" maxlength="256" required>
    </div>
    <div class="form-group padBottom10">
        <label for="patient_postcode">Patient Postcode</label>
        <input type="text" class="form-control" name="txtPatientPostcode" placeholder="Enter Patient Postcode" maxlength="10" required>
    </div>
    <div class="form-group padBottom10">
        <label for="patient_phone_number">Patient Phone Number</label>
        <input type="tel" class="form-control" name="txtPatientTelephone" placeholder="Enter Patient Phone Number" maxlength="15" required>
    </div>
    <div class="form-group padBottom10">
        <button type="submit" class="btn btn-primary mb-3"><i class="fas fa-user-plus"></i> Add Patient</button>
    </div>
</form>