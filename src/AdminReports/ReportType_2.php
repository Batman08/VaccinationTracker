<?php
$totalPatients = GetTotalPatients();
$reportData = GetReportPatientsByVaccinationType();
?>

<div class="alert alert-primary" role="alert" style="font-weight: bold;">
    Total Number of Patients: <?= $totalPatients ?>
</div>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Vaccination Type</th>
            <th scope="col">Number of Patients</th>
            <th scope="col">% of Total Patients</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reportData as $i) { ?>
            <tr>
                <td>
                    <span style="font-size: larger;"><?= $i['Name'] ?></span>
                </td>
                <td>
                    <span style="font-size: larger;"><?= $i['NumberOfPatients'] ?></span>
                </td>
                <td>
                    <span style="font-size: larger;"><?= number_format((float)$i['PercentOfPatients'], 0, '.', '') ?>%</span>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>