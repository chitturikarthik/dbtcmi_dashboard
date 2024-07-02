<!DOCTYPE html>
<html lang="en">
<head>
    <title>DBT-CMI: Services</title>
    <?php include_once 'head_links.php'; ?>
    <?php $page = 'services';?>
</head>
<body>
    <!-- Navbar -->
    <?php include_once 'navbar.php'; ?>
    
    <!-- Main Content -->
    <main class="container py-5 mt-4">
        <div class="row px-4 pt-5 mt-5 text-center text-uppercase">
            <p class="fs-5 fw-bold mb-0">Offered</p>
            <h2 class="text-accent2 fw-bold mb-3">Services</h2>
        </div>
        <hr class="w-50 mx-auto">
        <div class="row px-4 py-5 my-5 rounded-3 shadow">
            <div class="col-lg-10 mx-auto">
                <div class="special-list-item p-5 rounded mr-0 me-lg-4">
                    <div class="d-block d-sm-flex align-items-center m-2">
                        <div class="icon me-4 mb-4 mb-sm-0 bg-info shadow"> 
                            <i class="fa-solid fa-server mt-4" style="font-size:36px"></i>
                        </div>
                        <div class="block">
                            <h4 class="mb-3">High Performance Computing (HPC) Cluster</h4>
                            <p class="mb-0 text-muted">
                                Launching Soon...
                            </p>
                        </div>
                    </div>
                </div>
                <div class="special-list-item p-5 rounded mr-0 me-lg-4">
                    <div class="d-block d-sm-flex align-items-center m-2">
                        <div class="icon me-4 mb-4 mb-sm-0 bg-accent3 shadow"> 
                            <i class="fa-solid fa-bacteria mt-4" style="font-size:36px"></i>
                        </div>
                        <div class="block">
                            <h4 class="mb-3">Metagenome Analysis</h4>
                            <p class="mb-0 text-muted">
                                Launching Soon...
                            </p>
                        </div>
                    </div>
                </div>
                <div class="special-list-item p-5 rounded mr-0 me-lg-4">
                    <div class="d-block d-sm-flex align-items-center m-2">
                        <div class="icon me-4 mb-4 mb-sm-0 bg-success opacity-50 shadow"> 
                            <i class="fa-solid fa-bacterium mt-4" style="font-size:36px"></i>
                        </div>
                        <div class="block">
                            <h4 class="mb-3">Bacterial Genome Analysis</h4>
                            <p class="mb-0 text-muted">
                                Launching Soon...
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <!-- Footer -->
    <?php include_once 'footer.php'; ?>
    
</body>
</html>