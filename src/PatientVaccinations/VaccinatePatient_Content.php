<?php
$medicalPerson = GetMedicalPerson($_SESSION['medicalPersonId'])[0];
$vaccinationCentres = GetVaccinationCentres();
$vaccinationTypes = GetVaccinationTypes();
$currentDateTime = date("Y-m-d\TH:i");
?>

<?php if ($_GET['SavedPatient'] == "success") { ?>
    <div class="alert alert-success" role="alert">
        <i class="fas fa-check fa-lg"></i>
        Successfully saved patient vaccination.
    </div>
<?php } elseif ($_GET['SavedPatient'] == "failed") { ?>
    <div class="alert alert-danger" role="alert">
        <i class="fas fa-times fa-lg"></i>
        Failed to save patient vaccination, pleast try again.
    </div>
<?php } ?>

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

    <!-- Choose Vaccination Centre -->
    <div class="row padBottom10">
        <div class="col-md-3">
            <label for="ddlVaccinationCentre"><i class="fas fa-clinic-medical fa-fw"></i> Vaccination Centre:</label>
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
            <label for="txtDateTime"><i class="fas fa-calendar-day fa-fw"></i> Date:</label>
        </div>
        <div class="col-md-9">
            <input type="datetime-local" class="form-control" name="txtDateTime" value="<?= $currentDateTime; ?>" required>
        </div>
    </div>

    <!-- Vaccination Type -->
    <div class="row padBottom10">
        <div class="col-md-3">
            <label for="ddlVaccinationType"><i class="fas fa-syringe"></i> Vaccination Type:</label>
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
            <label for="txtPatientUniqueId"><i class="fas fa-id-card-alt fa-fw"></i> Patient Identifier:</label>
        </div>
        <div class="col-md-9">
            <input type="text" class="form-control" name="txtPatientUniqueId" placeholder="Enter Unique Patient Identifier" maxlength="256" required>
        </div>
    </div>

    <!-- Patient First Name -->
    <div class="row padBottom10">
        <div class="col-md-3">
            <label for="txtPatientFirstName"><i class="fas fa-user fa-fw"></i> Patient First Name:</label>
        </div>
        <div class="col-md-9">
            <input type="text" class="form-control" name="txtPatientFirstName" placeholder="Enter Patient First Name" maxlength="256" required>
        </div>
    </div>

    <!-- Patient Last Name -->
    <div class="row padBottom10">
        <div class="col-md-3">
            <label for="txtPatientLastName"><i class="fas fa-user fa-fw"></i> Patient Last Name:</label>
        </div>
        <div class="col-md-9">
            <input type="text" class="form-control" name="txtPatientLastName" placeholder="Enter Patient Last Name" maxlength="256" required>
        </div>
    </div>

    <!-- Date of Birth -->
    <div class="row padBottom10">
        <div class="col-md-3">
            <label for="txtPatientDOB"><i class="fas fa-calendar-day fa-fw"></i>Patient Date of Birth:</label>
        </div>
        <div class="col-md-9">
            <input type="date" class="form-control" name="txtPatientDOB" required>
        </div>
    </div>

    <!-- Patient Address -->
    <div class="row padBottom10">
        <div class="col-md-3">
            <label for="txtPatientAddress"><i class="fas fa-map-marker-alt fa-fw"></i> Patient Address</label>
        </div>
        <div class="col-md-9">
            <input type="text" class="form-control" name="txtPatientAddress" placeholder="Enter Patient Address" maxlength="256" required>
        </div>
    </div>

    <!-- Patient Postcode -->
    <div class="row padBottom10">
        <div class="col-md-3">
            <label for="txtPatientPostcode"><i class="fas fa-map-pin fa-fw"></i> Patient Postcode</label>
        </div>
        <div class="col-md-9">
            <input type="text" class="form-control" name="txtPatientPostcode" placeholder="Enter Patient Postcode" maxlength="10" required>
        </div>
    </div>

    <!-- Patient Phone Number -->
    <div class="row padBottom10">
        <div class="col-md-3">
            <label for="txtPatientTelephone"><i class="fas fa-phone-alt fa-fw"></i> Patient Phone Number</label>
        </div>
        <div class="col-md-9">
            <input type="tel" class="form-control" name="txtPatientTelephone" placeholder="Enter Patient Phone Number" maxlength="15" required>
        </div>
    </div>

    <!-- Add Patient Button -->
    <div class="row padBottom10" style="margin-top: 20px;">
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary mb-3"><i class="fas fa-save"></i> Save Patient Vaccination</button>
        </div>
    </div>
</form>