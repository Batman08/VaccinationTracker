<?php
$vaccinationsByCentreReport = GetVaccinationsByCentreReport();
?>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Vaccination Centre</th>
            <th scope="col">Number of Vaccinations</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($vaccinationsByCentreReport as $i) { ?>
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
                <span style="font-size: larger;"><b><?= $i['NumberofVaccinations'] ?></b></span>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>