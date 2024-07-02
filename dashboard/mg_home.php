<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Initiating DB connection -->
    <?php include("../conn.php"); ?>
    <title>DBT-CMI: Metagenomes</title>
    <base href="../">
    <?php include_once '../head_links.php'; ?>
    <?php $page = 'db > mg'; ?>
</head>
<body>
    <!-- Navbar -->
    <?php include_once '../navbar.php'; ?>

    <div class="container-fluid pt-4 mt-3">
        <div class="row">
            <!-- Sidebar -->
            <?php include_once "sidebar.php"; ?>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-xl-10 px-md-4 bg-secondary-subtle">
                <div class="row px-5 pt-3 mt-5">
                    <!-- Breadcrumb -->
                    <nav class="navbar navbar-expand-lg bg-transparent mb-3 justify-content-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb shadow-sm rounded">
                                <li class="breadcrumb-item"><a href="dashboard/collections.php">Collections</a></li>
                                <li class="breadcrumb-item active"><a href="dashboard/mg_home.php">Metagenomes</a></li>
                            </ol>
                        </nav>
                    </nav>
                    <h2 class="text-accent2 fw-bold mb-2 text-uppercase">Metagenomes</h2>
                    <p class="mb-0 text-muted">Collection of Indian Metagenomes available at various resources</p>
                </div>
                <hr class="w-25 ms-5">
                <!-- Total Counts -->
                <div class="row px-4 mt-5 text-center text-muted" id="countBoxes">
                    <!-- Total Studies -->
                    <div class="col-md-6 col-xxl-3 mx-auto p-4">
                        <div class="special-list-item p-2 bg-white rounded mr-0 me-lg-4 shadow">
                            <div class="d-block d-sm-flex align-items-center m-2">
                                <div class="icon me-4 mb-4 mb-sm-0 bg-info shadow"> 
                                    <i class="fa-solid fa-microscope mt-4" style="font-size:36px"></i>
                                </div>
                                <div class="block text-start">
                                    <h5>Studies</h5>
                                    <p class="mb-0 fs-4">
                                        <?php 
                                            $sql= "SELECT COUNT(CMIM_ID) AS count_cmim_id FROM new_meta_studies";
                                            $result = mysqli_query($conn,$sql) or die(mysqli_error ($conn) );
                                            while($rows = mysqli_fetch_array($result)) {
                                        ?>
                                        <a href="dashboard/mg_home.php#studiesTab" class="text-accent1">
                                            <?php echo $rows ["count_cmim_id"];?>
                                        </a>
                                        <?php } ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Total Samples -->
                    <div class="col-md-6 col-xxl-3 mx-auto p-4 gx-5">
                        <div class="special-list-item p-2 bg-white rounded mr-0 me-lg-4 shadow">
                            <div class="d-block d-sm-flex align-items-center m-2">
                                <div class="icon me-4 mb-4 mb-sm-0 bg-accent3 shadow"> 
                                    <i class="fa-solid fa-vials mt-4" style="font-size:36px"></i>
                                </div>
                                <div class="block text-start">
                                    <h5>Samples</h5>
                                    <p class="mb-0 fs-4 ">
                                        <?php 
                                            $sql= "SELECT COUNT(*) AS count_study_id FROM new_meta_samples";
                                            $result = mysqli_query($conn,$sql) or die(mysqli_error ($conn) );
                                            while($rows = mysqli_fetch_array($result)) {
                                        ?>
                                        <a href="dashboard/mg_home.php#samplesTab" class="text-accent1">
                                            <?php echo $rows ["count_study_id"];?>
                                        </a>
                                        <?php } ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Total Amplicon NGS -->
                    <div class="col-md-6 col-xxl-3 mx-auto p-4 gx-5">
                        <div class="special-list-item p-2 bg-white rounded mr-0 me-lg-4 shadow">
                            <div class="d-block d-sm-flex align-items-center m-2">
                                <div class="icon me-4 mb-4 mb-sm-0 bg-success opacity-50 shadow"> 
                                    <i class="bi bi-list-columns-reverse mt-4" style="font-size:36px"></i>
                                </div>
                                <div class="block text-start">
                                    <h5>Amplicon NGS</h5>
                                    <p class="mb-0 fs-4">
                                        <?php 
                                            $sql= "SELECT COUNT(Sequence_stratergy) AS count_amplicon FROM new_meta_samples WHERE Sequence_stratergy='amplicon'";
                                            $result = mysqli_query($conn,$sql) or die(mysqli_error ($conn) );
                                            while($rows = mysqli_fetch_array($result)) {
                                        ?>
                                        <a href="dashboard/mg_home.php#ampliconsTab" class="text-accent1">
                                            <?php echo $rows ["count_amplicon"];?>
                                        </a>
                                        <?php } ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Total Shotgun MG -->
                    <div class="col-md-6 col-xxl-3 mx-auto p-4 gx-5">
                        <div class="special-list-item p-2 bg-white rounded mr-0 me-lg-4 shadow">
                            <div class="d-block d-sm-flex align-items-center m-2">
                                <div class="icon me-4 mb-4 mb-sm-0 bg-danger opacity-50 shadow"> 
                                    <i class="bi bi-body-text mt-4" style="font-size:36px"></i>
                                </div>
                                <div class="block text-start">
                                    <h5>Shotgun MGs</h5>
                                    <p class="mb-0 fs-4">
                                        <?php 
                                            $sql= "SELECT COUNT(Sequence_stratergy) AS count_wgs FROM new_meta_samples WHERE Sequence_stratergy='wgs'";
                                            $result = mysqli_query($conn,$sql) or die(mysqli_error ($conn) );
                                            while($rows = mysqli_fetch_array($result)) {
                                        ?>
                                        <a href="dashboard/mg_home.php#shotgunsTab" class="text-accent1">
                                            <?php echo $rows ["count_wgs"];?>
                                        </a>
                                        <?php } ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tables -->
                <div id="allTables">
                    <div class="row px-4 mt-3">
                        <div class="col mx-auto p-4">
                            <div class="p-5 bg-white rounded mr-0 me-lg-4 shadow">
                                <div class="mb-3" id="studiesTab">
                                    <h5 class="mb-4">Studies</h5>
                                    <hr class="w-25 mb-5">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="mgStudiesTable">
                                            <thead>
                                                <tr>
                                                    <th>CMIM_ID</th>
                                                    <th>Study_ID</th>
                                                    <th>Study name</th>
                                                    <th>Environment</th>
                                                    <th>Sequenced region</th>
                                                    <th>Sample Size</th>
                                                    <th>State</th>
                                                    <th>Deposited at</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row px-4 mt-3">
                        <div class="col mx-auto p-4">
                            <div class="p-5 bg-white rounded mr-0 me-lg-4 shadow">
                                <div class="mb-3" id="samplesTab">
                                    <h5 class="mb-4">Samples</h5>
                                    <hr class="w-25 mb-5">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="mgSamplesTable">
                                            <thead>
                                                <tr>
                                                    <th>CMIS_ID</th>
                                                    <th>Sample</th>
                                                    <th>Biosample</th>
                                                    <th>Study ID</th>
                                                    <th>Source</th>
                                                    <th>State</th>
                                                    <th>Location</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row px-4 mt-3">
                        <div class="col mx-auto p-4">
                            <div class="p-5 bg-white rounded mr-0 me-lg-4 shadow">
                                <div class="mb-3" id="ampliconsTab">
                                    <h5 class="mb-4">Amplicon NGS</h5>
                                    <hr class="w-25 mb-5">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="mgAmpliconsTable">
                                            <thead>
                                                <tr>
                                                    <th>CMIS_ID</th>
                                                    <th>Sample</th>
                                                    <th>Biosample</th>
                                                    <th>Study ID</th>
                                                    <th>Environment</th>
                                                    <th>Source</th>
                                                    <th>State</th>
                                                    <th>Location</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row px-4 mt-3">
                        <div class="col mx-auto p-4">
                            <div class="p-5 bg-white rounded mr-0 me-lg-4 shadow">
                                <div class="mb-3" id="shotgunsTab">
                                    <h5 class="mb-4">Shotgun MGs</h5>
                                    <hr class="w-25 mb-5">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="mgShotgunsTable">
                                            <thead>
                                                <tr>
                                                    <th>CMIS_ID</th>
                                                    <th>Sample</th>
                                                    <th>Biosample</th>
                                                    <th>Study ID</th>
                                                    <th>Environment</th>
                                                    <th>Source</th>
                                                    <th>State</th>
                                                    <th>Location</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <hr>
                <!-- Footer -->
                <?php include_once "../footer.php"; ?>
            </main>
        </div>
    </div>
    
</body>
</html>