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
            <th scope="col">Total Administered</th>
            <th scope="col">Vaccine</th>
            <th scope="col">Number Administered</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reportData as $i) { ?>
            <tr>
                <td>
                    <span style="font-size: larger;"><?= $i['Area'] ?></span>
                </td>
                <td>
                    <span style="font-size: larger;"><?= $i['TotalVax'] ?></span>
                </td>
                <td>
                    <span style="font-size: larger;"><?= $i['Vaccine'] ?></span>
                </td>
                <td>
                    <span style="font-size: larger;"><?= $i['NumVaxByArea'] ?></span>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>