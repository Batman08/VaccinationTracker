<?php
$reportData = GetReportPatientsByVaccinationType();
?>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Vaccination Type</th>
            <th scope="col">Number of Patients</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reportData as $i) { ?>
            <tr>
                <td>
                    <span style="font-size: larger;"><?= $i['Name'] ?></span>
                </td>
                <td>
                    <span style="font-size: larger;"><?= $i['NumberofPatients'] ?></span>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>