<nav id="sidebarMenu" class="col-md-3 col-xl-2 d-md-block bg-white sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column gap-3">
            <li class="nav-item">
                <a class="nav-link <?php if (str_contains($page, 'collections')) { echo 'active'; } ?>" aria-current="page" href="dashboard/collections.php">
                    <i class="bi bi-grid-fill mx-2 d-md-none d-xxl-inline"></i>
                    <span>Collections</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if (str_contains($page, 'mg')) { echo 'active'; } ?>" href="dashboard/mg_home.php">
                    <i class="fa-solid fa-bacteria mx-2 d-md-none d-xxl-inline"></i>
                    <span>Metagenomes</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled text-secondary" href="#">
                    <i class="fa-solid fa-bacterium mx-2 d-md-none d-xxl-inline"></i>
                    <span>Genomes</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled text-secondary" href="#">
                    <i class="bi bi-ui-checks mx-2 d-md-none d-xxl-inline"></i>
                    <span>Transcriptomes</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled text-secondary" href="#">
                    <i class="fa-solid fa-layer-group mx-2 d-md-none d-xxl-inline"></i>
                    <span>UoH Datasets</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if (str_contains($page, 'env')) { echo 'active'; } ?>" href="dashboard/environments.php">
                    <i class="fa-solid fa-tree-city mx-2 d-md-none d-xxl-inline"></i>
                    <span>Environments</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if (str_contains($page, 'geo')) { echo 'active'; } ?>" href="dashboard/distribution.php">
                    <i class="bi bi-globe-central-south-asia mx-2 d-md-none d-xxl-inline"></i>
                    <span>Distribution</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled text-secondary" href="#">
                    <i class="bi bi-capsule-pill mx-2 d-md-none d-xxl-inline"></i>
                    <span>AMR Status</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if (str_contains($page, 'env')) { echo 'active'; } ?>" href="dashboard/submit">
                    <i class="bi bi-cloud-arrow-up-fill mx-2 d-md-none d-xxl-inline"></i>
                    <span>Data Submission</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
