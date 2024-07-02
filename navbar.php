
<?php

if (!function_exists('str_contains')) {
    function str_contains($haystack, $needle) {
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }
}
?>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid mx-5">
        <a class="navbar-brand text-uppercase my-auto" href="index.php">
            <img src="images/logos/logo_white.png" alt="Logo" class="img-fluid">
        </a>
        <div>
            <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-database-fill-add fs-2 m-auto"></i>
            </button>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-menu-button-wide-fill fs-2 m-auto"></i>
            </button>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
            <ul class="navbar-nav mb-2 mb-md-0">
                <li class="nav-item">
                <a class="nav-link <?php if ($page == 'home') { echo 'active'; } ?>" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?php if (str_contains($page, 'db')) { echo 'active'; } ?>" href="dashboard/collections.php">DB Collections</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?php if ($page == 'pipelines') { echo 'active'; } ?>" href="pipelines.php">Pipelines</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?php if ($page == 'services') { echo 'active'; } ?>" href="services.php">Services</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?php if ($page == 'research') { echo 'active'; } ?>" href="research.php">Research</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?php if ($page == 'events') { echo 'active'; } ?>" href="events.php">Events</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?php if ($page == 'team') { echo 'active'; } ?>" href="team.php">Team</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?php if ($page == 'contact') { echo 'active'; } ?>" href="contact.php">Contact Us</a>
                </li>
            </ul>
            <!--
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            -->
            <?php include 'snippet.php';?>

        </div>
    </div>
</nav>