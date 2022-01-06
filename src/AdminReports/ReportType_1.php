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
        <?php
        $previous = "";
        $currentArea = "";
        $totalItems = count($reportData);
        for ($i = 0; $i < $totalItems; $i++) {
            $item = $reportData[$i];
            $currentArea = $item['Area']; ?>
            <tr>
                <td>
                    <span style="font-size: larger;"><?= $item['Area'] ?></span>
                </td>
                <td>
                    <span style="font-size: larger;"><?= $item['TotalVax'] ?></span>
                </td>
                <td>
                    <span style="font-size: larger;"><?= $item['Vaccine'] ?></span>
                </td>
                <td>
                    <span style="font-size: larger;"><?= $item['NumVaxByArea'] ?></span>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>