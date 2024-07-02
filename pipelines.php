<!DOCTYPE html>
<html lang="en">
<head>
    <title>DBT-CMI: Pipelines</title>
    <?php include_once 'head_links.php'; ?>
    <?php $page = 'pipelines';?>
</head>
<body>
    <!-- Navbar -->
    <?php include_once 'navbar.php'; ?>
    
    <!-- Main Content -->
    <main class="container py-5 mt-4">
        <div class="row px-4 pt-5 mt-5 text-center text-uppercase">
            <p class="fs-5 fw-bold mb-0">Analysis</p>
            <h2 class="text-accent2 fw-bold mb-3">Pipelines</h2>
            <p class="text-secondary">(Under Development)</p>
        </div>
        <hr class="w-50 mx-auto">
        <div class="row px-4 py-5 my-5 gap-5">
            <div class="col-lg-5 mx-auto p-5 bg-secondary-subtle rounded-1 special-list-item">
                <h4 class="text-uppercase fw-bold opacity-75">Metagenome Analysis</h4>
                <hr>
                <p>
                    <a class="btn btn-secondary disabled" href="#">Amplicon NGS</a>
                    
                </p>
                <p>
                    <a class="btn btn-secondary disabled" href="#">Shotgun Metagenome</a>
                </p>
            </div>
            <div class="col-lg-5 mx-auto p-5 bg-secondary-subtle rounded-1 special-list-item">
                <h4 class="text-uppercase fw-bold opacity-75">Bacterial Genome Analysis</h4>
                <hr>
                <p>
                    <a class="btn btn-secondary disabled" href="#"><em>de novo</em> Assembly</a>
                    
                </p>
                <p>
                    <a class="btn btn-secondary disabled" href="#">Reference based Assembly</a>
                </p>
            </div>
        </div>
    </main>

    
    <!-- Footer -->
    <?php include_once 'footer.php'; ?>
    
</body>
</html>