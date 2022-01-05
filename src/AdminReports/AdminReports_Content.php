<div class="row">
    <div class="col-sm">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Covid Vaccinations by Area</h5>
                <p class="card-text">Displays the total number of covid vaccinations carried out by area.</p>
                <a href="?ReportType=1" class="btn btn-primary"><i class="fas fa-play"></i> Run Report</a>
            </div>
        </div>
    </div>
    <div class="col-sm">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Vaccination Type Report</h5>
                <p class="card-text">A report on the number of patients for each type of vaccination.</p>
                <a href="?ReportType=2" class="btn btn-primary"><i class="fas fa-play"></i> Run Report</a>
            </div>
        </div>
    </div>
    <div class="col-sm">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Vaccinations by Centre</h5>
                <p class="card-text">Displays the number of vaccinations carried out by each centre.</p>
                <a href="?ReportType=3" class="btn btn-primary"><i class="fas fa-play"></i> Run Report</a>
            </div>
        </div>
    </div>
</div>

<br />
<br />

<?php
$reportType = $_GET['ReportType'];

switch ($reportType) {
    case "1":
        include("ReportType_1.php");
        break;
    case "2":
        include("ReportType_2.php");
        break;
    case "3":
        include("ReportType_3.php");
        break;
}
?>