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
        <a href="/AdminReports/AdministrationReports.php" class="btn btn-primary"><i class="fas fa-file-medical"></i> View Reports</a>
        <a href="/PatientVaccinations/VaccinationHistory.php" class="btn btn-success"><i class="fas fa-book-medical"></i> Vaccination History</a>
    </div>
</div>

<form action="VaccinatePatient_Save.php" method="post">

    <!-- Choose Vaccination Centre -->
    <div class="row padBottom10">
        <div class="col-md-3">
            <label for="ddlVaccinationCentre">Choose Vaccination Centre:</label>
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

    <!-- Date -->
    <div class="row padBottom10">
        <div class="col-md-3">
            <label for="txtDateTime">Date:</label>
        </div>
        <div class="col-md-9">
            <input type="datetime-local" class="form-control" name="txtDateTime" required>
        </div>
    </div>

    <!-- Vaccination Type -->
    <div class="row padBottom10">
        <div class="col-md-3">
            <label for="ddlVaccinationType">Vaccination Type:</label>
        </div>
        <div class="col-md-9">
            <select name="ddlVaccinationType" class="form-select" aria-label="select user" required>
                <option value="">-- Select Vaccination Type --</option>
                <?php foreach ($vaccinationTypes as $vaccinationType) { ?>
                    <option value="<?= $vaccinationType['VaccinationTypeId'] ?>"><?= $vaccinationType['Name'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>

    <hr />

    <!-- Patient Identifier -->
    <div class="row padBottom10">
        <div class="col-md-3">
            <label for="txtPatientUniqueId">Patient Identifier:</label>
        </div>
        <div class="col-md-9">
            <input type="text" class="form-control" name="txtPatientUniqueId" placeholder="Enter Unique Patient Identifier" maxlength="256" required>
        </div>
    </div>

    <!-- Patient First Name -->
    <div class="row padBottom10">
        <div class="col-md-3">
            <label for="txtPatientFirstName">Patient First Name:</label>
        </div>
        <div class="col-md-9">
            <input type="text" class="form-control" name="txtPatientFirstName" placeholder="Enter Patient First Name" maxlength="256" required>
        </div>
    </div>

    <!-- Patient Last Name -->
    <div class="row padBottom10">
        <div class="col-md-3">
            <label for="txtPatientLastName">Patient First Name:</label>
        </div>
        <div class="col-md-9">
            <input type="text" class="form-control" name="txtPatientLastName" placeholder="Enter Patient Last Name" maxlength="256" required>
        </div>
    </div>

    <!-- Date of Birth -->
    <div class="row padBottom10">
        <div class="col-md-3">
            <label for="txtPatientDOB">Date of Birth:</label>
        </div>
        <div class="col-md-9">
            <input type="date" class="form-control" name="txtPatientDOB" required>
        </div>
    </div>

    <!-- Patient Address -->
    <div class="row padBottom10">
        <div class="col-md-3">
            <label for="txtPatientAddress">Patient Address</label>
        </div>
        <div class="col-md-9">
            <input type="text" class="form-control" name="txtPatientAddress" placeholder="Enter Patient Address" maxlength="256" required>
        </div>
    </div>

    <!-- Patient Postcode -->
    <div class="row padBottom10">
        <div class="col-md-3">
            <label for="txtPatientPostcode">Patient Postcode</label>
        </div>
        <div class="col-md-9">
            <input type="text" class="form-control" name="txtPatientPostcode" placeholder="Enter Patient Postcode" maxlength="10" required>
        </div>
    </div>

    <!-- Patient Phone Number -->
    <div class="row padBottom10">
        <div class="col-md-3">
            <label for="txtPatientTelephone">Patient Phone Number</label>
        </div>
        <div class="col-md-9">
            <input type="tel" class="form-control" name="txtPatientTelephone" placeholder="Enter Patient Phone Number" maxlength="15" required>
        </div>
    </div>

    <!-- Add Patient Button -->
    <div class="row padBottom10" style="margin-top: 20px;">
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary mb-3"><i class="fas fa-user-plus"></i> Add Patient</button>
        </div>
    </div>
</form>