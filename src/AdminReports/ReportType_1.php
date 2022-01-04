<?php
$totalCovidVaccinations = GetTotalCovidVaccinations();
$reportData = GetReportCovidVaccinationsByArea();
?>

<div class="alert alert-primary" role="alert" style="font-weight: bold;">
Total Number of Covid Vaccinations: <?= $totalCovidVaccinations ?>
</div>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Area</th>
            <th scope="col">Number of Covid Vaccinations</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reportData as $i) { ?>
            <tr>
                <td>
                    <span style="font-size: larger;"><?= $i['Area'] ?></span>
                </td>
                <td>
                    <span style="font-size: larger;"><?= $i['NumberOfCovidVaccinations'] ?></span>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>