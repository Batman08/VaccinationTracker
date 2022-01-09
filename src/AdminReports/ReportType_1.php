<?php
$totalCovidVaccinations = GetTotalCovidVaccinations();
$reportData = GetReportCovidVaccinationsByArea();
?>

<div class="alert alert-primary" role="alert" style="font-weight: bold;">
    <h5>1. Covid Vaccinations by Area</h5>
    Total Number of Covid Vaccinations: <?= $totalCovidVaccinations ?>
</div>

<table class="table table-striped table-hover">
    <colgroup>
        <col style="width: 30%;" />
        <col style="width: 20%;" />
        <col style="width: 50%;" />
    </colgroup>
    <thead>
        <tr>
            <th scope="col">Area</th>
            <th scope="col">Total Administered</th>
            <th scope="col">Vaccine Breakdown</th>
            <!-- <th scope="col">Number Administered</th> -->
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

            <?php if ($currentArea != $previous) { ?>
                <tr>
                    <?php $previous = $currentArea; ?>
                    <td>
                        <span style="font-size: larger;"><?= $item['Area'] ?></span>
                    </td>
                    <td>
                        <span style="font-size: larger;"><?= $item['TotalVax'] ?></span>
                    </td>
                    <td>
                        <?php $p = $i;
                        while ($currentArea == $reportData[$p]['Area']) { ?>
                            <span style="font-size: larger;"><?= $reportData[$p]['Vaccine'] ?>: <?= $reportData[$p]['NumVaxByArea'] ?></span>
                            <?php $p++; ?>
                            <br />
                        <?php } ?>
                    </td>
                </tr>
        <?php }
        } ?>
    </tbody>
</table>