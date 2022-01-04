<div class="row">
    <div class="col-sm">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary"><i class="fas fa-play"></i> Run Report</a>
            </div>
        </div>
    </div>
    <div class="col-sm">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Vaccination Type Report</h5>
                <p class="card-text">A report on the number of patients for each type of vaccination.</p>
                <a href="#" class="btn btn-primary"><i class="fas fa-play"></i> Run Report</a>
            </div>
        </div>
    </div>
    <div class="col-sm">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Vaccinations by Centre</h5>
                <p class="card-text">Displays the number of vaccinations carried out by each centre.</p>
                <a href="#" class="btn btn-primary"><i class="fas fa-play"></i> Run Report</a>
            </div>
        </div>
    </div>
</div>

<br />
<br />

<?php
$reportType = "1";

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