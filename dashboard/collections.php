<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Initiating DB connection -->
    <?php include("../conn.php"); ?>
    <title>DBT-CMI: DB Collections</title>
    <base href="../">
    <?php include_once '../head_links.php'; ?>
    <?php $page = 'db collections'; ?>
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
                <div class="row px-4 pt-3 mt-5 text-center text-uppercase">
                    <!-- Breadcrumb -->
                    <nav class="navbar navbar-expand-lg bg-transparent mb-3 justify-content-end text-capitalize">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb shadow-sm rounded">
                                <li class="breadcrumb-item active"><a href="dashboard/collections.php">Collections</a></li>
                            </ol>
                        </nav>
                    </nav>
                    <p class="fs-5 fw-bold mb-0">Database</p>
                    <h2 class="text-accent2 fw-bold mb-2">Collections</h2>
                </div>
                <hr class="w-50 mx-auto">
                <!-- Total Counts -->
                <div class="row px-4 mt-5 text-center text-muted">
                    <!-- Metagenomes Total -->
                    <div class="col-md-6 col-xxl-3 mx-auto p-4">
                        <div class="special-list-item p-2 bg-white rounded mr-0 me-lg-4 shadow">
                            <div class="d-block d-sm-flex align-items-center m-2">
                                <div class="icon me-4 mb-4 mb-sm-0 bg-info shadow"> 
                                    <i class="fa-solid fa-bacteria mt-4" style="font-size:36px"></i>
                                </div>
                                <div class="block text-start">
                                    <h5>Metagenomes</h5>
                                    <p class="mb-0 fs-4">
                                        <?php 
                                            $sql= "SELECT COUNT(*) AS count_study_id FROM new_meta_samples";
                                            $result = mysqli_query($conn,$sql) or die(mysqli_error ($conn) );
                                            while($rows = mysqli_fetch_array($result)) {
                                        ?>
                                        <a href="dashboard/mg_home.php" class="text-accent1">
                                            <?php echo $rows ["count_study_id"];?>
                                        </a>
                                        <?php } ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Genomes Total -->
                    <div class="col-md-6 col-xxl-3 mx-auto p-4 gx-5">
                        <div class="special-list-item p-2 bg-white rounded mr-0 me-lg-4 shadow">
                            <div class="d-block d-sm-flex align-items-center m-2">
                                <div class="icon me-4 mb-4 mb-sm-0 bg-accent3 shadow"> 
                                    <i class="fa-solid fa-bacterium mt-4" style="font-size:36px"></i>
                                </div>
                                <div class="block text-start">
                                    <h5>Genomes</h5>
                                    <p class="mb-0 fs-4">
                                        <a href="dashboard/collections.php" class="text-accent1">...</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Transcriptomes Total -->
                    <div class="col-md-6 col-xxl-3 mx-auto p-4 gx-5">
                        <div class="special-list-item p-2 bg-white rounded mr-0 me-lg-4 shadow">
                            <div class="d-block d-sm-flex align-items-center m-2">
                                <div class="icon me-4 mb-4 mb-sm-0 bg-success opacity-50 shadow"> 
                                    <i class="bi bi-ui-checks mt-4" style="font-size:36px"></i>
                                </div>
                                <div class="block text-start">
                                    <h5>Transcriptomes</h5>
                                    <p class="mb-0 fs-4">
                                        <a href="dashboard/collections.php" class="text-accent1">...</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- UoH Total -->
                    <div class="col-md-6 col-xxl-3 mx-auto p-4 gx-5">
                        <div class="special-list-item p-2 bg-white rounded mr-0 me-lg-4 shadow">
                            <div class="d-block d-sm-flex align-items-center m-2">
                                <div class="icon me-4 mb-4 mb-sm-0 bg-danger opacity-50 shadow"> 
                                    <i class="fa-solid fa-layer-group mt-4" style="font-size:36px"></i>
                                </div>
                                <div class="block text-start">
                                    <h5>UoH Datasets</h5>
                                    <p class="mb-0 fs-4">
                                        <a href="dashboard/collections.php" class="text-accent1">...</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- State-wise Distribution Plot -->
                <div class="row px-4 mt-3">
                    <div class="col mx-auto p-4">
                        <div class="p-4 bg-white rounded mr-0 me-lg-4 shadow">
                            <h5><a href="dashboard/distribution.php">State-wise Distribution</a></h5>
                            <div id="statesBar">

                            <?php
                                $rows = array();
                                $exclude_states = array('other', 'unknown');
                                $exclude_states_sql = "'" . implode("', '", $exclude_states) . "'";
                                $result = mysqli_query($conn,"SELECT n.state_id, s.state_name, count(*) as sample_count 
                                                        FROM new_meta_samples n 
                                                        INNER JOIN states s ON n.state_id=s.state_id 
                                                        GROUP BY state_id 
                                                        ORDER BY 
                                                        case WHEN s.state_name
                                                         IN ($exclude_states_sql) THEN 1 ELSE 0 END,  sample_count desc"); // -- sort "Other" and "Unknown" last
                                
                                while($row = mysqli_fetch_array($result)) {
                                    #$rows[] = $row;
                                    $state_name[] = $row["state_name"];
                                    $sample_count[] = $row["sample_count"];
                                    
                                }
                                
                            ?>
                            </div>  <!-- State-bar call by id state bar plot -->
                        </div>
                    </div>
                </div>
                <!-- Other DBs -->
                <div class="row px-4 mt-3">
                    <!-- Indigenous Resources -->
                    <div class="col-xl-9 mx-auto p-4">
                        <div class="p-4 bg-white rounded">
                            <h6>Other Microbial Resources of India</h6>
                            <div class="table-responsive">
                                <table class="table table-hover table-xs">
                                    <tbody>
                                        <tr>
                                            <td class="col-3">
                                                NBAIM
                                            </td>
                                            <td class="col-auto">
                                                <a href="http://www.indiamicrobiome.org.in/#:~:text=The%20Indian%20Soil%20Microbiome%20Project,of%20Agricultural%20Research%20(ICAR)." target="_blank">Indian Soil Microbiome Project</a> | 
                                                <a href="http://www.mgrportal.org.in/" target="_blank">Microbial Genome Resource</a> | 
                                                <a href="https://nbaim.icar.gov.in/microveda/" target="_blank">Micro Veda</a> | 
                                                <a href="http://webapp.cabgrid.res.in/Stressmicrobs/stressdb.html" target="_blank">StressmicrobesInfo</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-3">
                                                DBT Collaborations
                                            </td>
                                            <td class="col-auto">
                                                <a href="https://ibdc.rcb.res.in/" target="_blank">IBDC</a> | 
                                                <a href="https://inda.rcb.ac.in/insacog/statisticsinsacog" target="_blank">INSACOG</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-3">
                                                Culture Collections
                                            </td>
                                            <td class="col-auto">
                                                <a href="https://mtccindia.res.in/" target="_blank">MTCC</a> | 
                                                <a href="http://210.212.161.138/" target="_blank">NCMR</a> | 
                                                <a href="https://www.ncl-india.org/files/ncim/Default.aspx" target="_blank">NCIM</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-3">
                                                Other DBs
                                            </td>
                                            <td class="col-auto">
                                                <a href="https://pubmed.ncbi.nlm.nih.gov/24714636/" target="_blank">NEMiD</a> | 
                                                <a href="https://pubmed.ncbi.nlm.nih.gov/29905762/" target="_blank">LeptoDB</a> | 
                                                <a href="https://feamrudbt-amrlab.mu.ac.in/" target="_blank">FEAMR</a> | 
                                                <a href="https://www.nbair.res.in/sites/default/files/2019-01/dbonmicrobes-MY.pdf" target="_blank">NBAIR</a> | 
                                                <a href="http://www.niobioinformatics.in/index.php" target="_blank">Marine Microbial DB</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Global Resources -->
                    <div class="col-xl-3 mx-auto p-4">
                        <div class="p-4 h-100 bg-white rounded mr-0 me-xl-4">
                            <h6>Global Resources</h6>
                            <div class="table-responsive">
                                <p>
                                    <a href="https://www.ncbi.nlm.nih.gov/sra/?term=metagenome%5BOrganism%5D+OR+metagenome%5BAll+Fields%5D+AND+India%5BAll+Fields%5D" target="_blank">NCBI SRA</a> | 
                                    <a href="https://www.mg-rast.org/mgmain.html?mgpage=search&search=India" target="_blank">MG-RAST</a> | 
                                    <a href="https://www.ebi.ac.uk/metagenomics/search/studies?query=India" target="_blank">MGnify</a> | <br>
                                    <a href="https://microbiomedb.org/mbio/app" target="_blank">MicrobiomeDB</a> | 
                                    <a href="https://img.jgi.doe.gov/cgi-bin/m/main.cgi" target="_blank">JGI</a> | <br>
                                    <a href="https://qiita.ucsd.edu/" target="_blank">QIITA</a> | 
                                    <a href="https://earthmicrobiome.org/" target="_blank">EMP</a> | <br>
                                    <a href="https://www.ddbj.nig.ac.jp/index-e.html" target="_blank">DDBJ</a> | 
                                    <a href="https://www.bv-brc.org/" target="_blank">BV-BRC</a> |
                                    <a href="https://gisaid.org/" target="_blank">GISAID</a>
                                </p>
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


    <!-- apexCharts & Plots -->
    <script>
        var sample_no = <?php  echo JSON_encode($sample_count); ?>;
        var y_axis = <?php  echo JSON_encode($state_name); ?>;
    </script>
    <script src="js/apexcharts/apexcharts.min.js"></script>
    <script src="js/plots.js"></script>

    
</body>
</html>