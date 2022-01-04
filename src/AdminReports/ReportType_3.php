<?php
$totalVaccinations = GetTotalVaccinations();
$reportData = GetReportVaccinationsByCentre();
?>

<div class="alert alert-primary" role="alert" style="font-weight: bold;">
    Total Number of Vaccinations: <?= $totalVaccinations ?>
</div>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Vaccination Centre</th>
            <th scope="col">Number of Vaccinations</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reportData as $i) { ?>
            <tr>
                <td>
                    <span style="font-size: larger;"><b><i class="fas fa-clinic-medical fa-fw"></i> <?= $i['Name'] ?></b></span>
                    <br />
                    <span class="text-muted"><i class="fas fa-map-marker-alt fa-fw"></i> <?= $i['Address'] ?></span>
                    <br />
                    <span class="text-muted"><i class="fas fa-map-pin fa-fw"></i> <?= $i['Postcode'] ?></span>
                    <br />
                    <span class="text-muted"><i class="fas fa-phone-alt fa-fw"></i> <?= $i['Telephone'] ?></span>
                </td>
                <td>
                <span style="font-size: larger;"><b><?= $i['NumberOfVaccinations'] ?></b></span>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>