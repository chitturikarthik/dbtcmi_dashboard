<!DOCTYPE html>
<html lang="en">
<head>
    <title>DBT-CMI: Events</title>
    <?php include_once 'head_links.php';
     include 'log.php' ?>
    <?php $page = 'events';?>
</head>
<body>
    <!-- Navbar -->
    <?php include_once 'navbar.php'; ?>
    
    <!-- Upcoming Events -->
    <main class="container py-5 mt-4">
        <div class="row px-4 pt-5 mt-5 text-center text-uppercase">
            <p class="fs-5 fw-bold mb-0">Scheduled</p>
            <h2 class="text-accent2 fw-bold mb-3">Events</h2>
        </div>
        <hr class="w-50 mx-auto">
        <div class="row row-cols-1 row-cols-lg-2 align-items-md-center g-5 pb-5 my-3">
            <div class="col d-flex flex-column align-items-start gap-2 pe-5">
                <p class="text-success fs-5 fw-bold text-uppercase">Workshop - 2023</p>
                <h3 class="fw-bold">Indian Microbiome Research: Current Status and Future Prospects</h3>
                <p class="text-muted">
                    Under the aegis of DBT-BTISNet sponsored DBT-Centre for Microbial Informatics, School of Life Sciences, University of Hyderabad, we will be organizing a national workshop followed by a brain-storming meeting on Indian Microbiome Research: Current Status and Future Prospects in the School of Life Sciences, during the first quarter of 2023.
                </p>
            </div>
            <!-- Column List -->
            <div class="col ps-5">
                <div class="special-list-item p-3 rounded mr-0 me-lg-4">
                    <div class="d-block d-sm-flex align-items-center m-2">
                        <div class="icon me-4 mb-4 mb-sm-0 bg-accent3 opacity-75 shadow"> 
                            <i class="bi bi-clock-history mt-4" style="font-size:36px"></i>
                        </div>
                        <div class="block">
                            <h4 class="mb-3">First Quarter of 2023</h4>
                            <p class="mb-0">Tentative</p>
                        </div>
                    </div>
                </div>
                <div class="special-list-item p-3 rounded mr-0 me-lg-4">
                    <div class="d-block d-sm-flex align-items-center m-2">
                        <div class="icon me-4 mb-4 mb-sm-0 bg-info opacity-75 shadow"> 
                            <i class="bi bi-geo mt-4" style="font-size:36px"></i>
                        </div>
                        <div class="block">
                            <h4 class="mb-3">CMSD or CIS</h4>
                            <p class="mb-0">Tentative</p>
                        </div>
                    </div>
                </div>
                <div class="special-list-item p-3 rounded mr-0 me-lg-4">
                    <div class="d-block d-sm-flex align-items-center m-2">
                        <div class="icon me-4 mb-4 mb-sm-0 bg-primary opacity-50 shadow"> 
                            <i class="bi bi-building-check mt-4" style="font-size:36px"></i>
                        </div>
                        <div class="block">
                            <h4 class="mb-3">DBT-CMI</h4>
                            <p class="mb-0">Organizer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <hr class="w-50 mx-auto">
    <!-- Completed Events -->
    <section>
        <div class="container p-5 mt-5 bg-secondary-subtle">
            <h4 class="pb-2 text-uppercase text-center fw-bold text-muted">Completed Events</h4>
            <hr class="w-50 mx-auto">
            <div class="row row-cols-1 align-items-md-center g-5 py-4">
                <div class="col d-flex flex-column align-items-start gap-3">
                    <div class="nav nav-pills mb-3" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-dsws2022-tab" data-bs-toggle="tab" data-bs-target="#nav-dsws2022" type="button" role="tab" aria-controls="nav-dsws2022" aria-selected="true">DSWS 2022</button>
                        <!-- Change the content and NNP IDs to Workshop IDs 
                        <button class="nav-link" id="nav-nnp2-tab" data-bs-toggle="tab" data-bs-target="#nav-nnp2" type="button" role="tab" aria-controls="nav-nnp2" aria-selected="false">NNP2</button>
                        <button class="nav-link" id="nav-nnp3-tab" data-bs-toggle="tab" data-bs-target="#nav-nnp3" type="button" role="tab" aria-controls="nav-nnp3" aria-selected="false">NNP3</button>
                        <button class="nav-link" id="nav-nnp4-tab" data-bs-toggle="tab" data-bs-target="#nav-nnp4" type="button" role="tab" aria-controls="nav-nnp4" aria-selected="false">NNP4</button>-->
                    </div>
                    <div class="tab-content shadow-lg bg-white rounded-3 p-5 w-100" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-dsws2022" role="tabpanel" aria-labelledby="nav-dsws2022-tab">
                            <div class="row align-items-center">
                                <!-- Summary -->
                                <div class="col-lg-6 pe-5">
                                    <h4 class="mb-4"><a href="http://sls.uohyd.ac.in/dsws/" target="_blank">Statistical Machine Learning for Biologists</a></h4>
                                    <p class="text-muted">
                                        Workshop was successfully conducted between 19<sup>th</sup> and 22<sup>nd</sup> December 2022 with <strong>79</strong> participants from all over India<br>
                                        Sessions of the workshop included theoretical concepts and hands-on on the following topics:
                                        <ul class="text-muted">
                                            <li>Introduction to R & Population Genetics - Prof M B Rao</li>
                                            <li>Pediatric Clinical Diagnostics - Prof M B Rao</li>
                                            <li>Diagnostic Tests Based on Biomarkers - Prof M B Rao</li>
                                            <li>Basics of Survival Analysis & Neural Networks - Prof M B Rao</li>
                                            <li>Introduction to R - Dr P Manimaran</li>
                                            <li>Data Visualization & Meta-analysis in R - Dr Sailu Y</li>
                                            <li>Application of Data Analytics in Life Sciences Industry - Dr K Ramakumar, Tech Mahindra</li>
                                            <li>Application of Machine Learning in drug development - Dr Ravi S Ananthula, PharmaDEM</li>
                                        </ul> 
                                    </p>
                                </div>
                                <!-- Map -->
                                <div class="col-lg-6 mb-5 mt-lg-0">
                                    <p class="mb-0 text-center text-muted">Institutions Participated - 15</p>
                                    <div id="map" style="height: 350px;">
                                        <script type="text/javascript"> 
                                            let map = L.map('map').setView([22.5726, 88.3639], 3);
                                            L.tileLayer('https://api.maptiler.com/maps/basic/256/{z}/{x}/{y}.png?key=dVhthbXQs3EHCi0XzzkL',{
                                                attribution:
                                                '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
                                            }).addTo(map);
                                            let city = L.markerClusterGroup();
                                            // var Points = $.getJSON("get_location.php", function(data) {      
                                            let data = [
                                                {
                                                "Institution": "University of Hyderabad",
                                                "Number": "44",
                                                "Latitude": "17.45606354",
                                                "Longitude": "78.31511924"
                                                },
                                                {
                                                "Institution": "BJB Autonomous College, Bhubaneshwar",
                                                "Number": "10",
                                                "Latitude": "20.25297579",
                                                "Longitude": "85.8422753"
                                                },
                                                {
                                                "Institution": "Sree Vidyanikethan College of Pharmacy, Tirupati",
                                                "Number": "8",
                                                "Latitude": "13.6220078",
                                                "Longitude": "79.28920853"
                                                },
                                                {
                                                "Institution": "Indian Institute of Technology Roorkee",
                                                "Number": "3",
                                                "Latitude": "29.92494787",
                                                "Longitude": "77.89223689"
                                                },
                                                {
                                                "Institution": "CSIR-IHBT, Palampur",
                                                "Number": "2",
                                                "Latitude": "32.10532637",
                                                "Longitude": "76.55645354"
                                                },
                                                {
                                                "Institution": "ICGEB, New Delhi",
                                                "Number": "2",
                                                "Latitude": "28.5301448",
                                                "Longitude": "77.16830763"
                                                },
                                                {
                                                "Institution": "ICAR-NIVEDI, Bangalore",
                                                "Number": "1",
                                                "Latitude": "13.12645153",
                                                "Longitude": "77.56029363"
                                                },
                                                {
                                                "Institution": "EPDA, Hyderabad",
                                                "Number": "1",
                                                "Latitude": "17.44703428",
                                                "Longitude": "78.44402185"
                                                },
                                                {
                                                "Institution": "Govt. Jatashankar Trivedi College, MP",
                                                "Number": "1",
                                                "Latitude": "21.815427",
                                                "Longitude": "80.19245061"
                                                },
                                                {
                                                "Institution": "IIRR, Hyderabad",
                                                "Number": "1",
                                                "Latitude": "17.32026904",
                                                "Longitude": "78.39390857"
                                                },
                                                {
                                                "Institution": "IISER Pune",
                                                "Number": "1",
                                                "Latitude": "18.54594725",
                                                "Longitude": "73.80750367"
                                                },
                                                {
                                                "Institution": "JSS College of Pharmacy, Ooty",
                                                "Number": "1",
                                                "Latitude": "11.4013162",
                                                "Longitude": "76.70706731"
                                                },
                                                {
                                                "Institution": "LVPEI, Hyderabad",
                                                "Number": "2",
                                                "Latitude": "17.42453249",
                                                "Longitude": "78.42756222"
                                                },
                                                {
                                                "Institution": "University of Madras",
                                                "Number": "1",
                                                "Latitude": "13.06625921",
                                                "Longitude": "80.28312898"
                                                },
                                                {
                                                "Institution": "Uppaluri K&H Personalized Medicine Clinic, Hyderabad",
                                                "Number": "1",
                                                "Latitude": "17.42986852",
                                                "Longitude": "78.41251563"
                                                }
                                            ];
                                            for (let i = 0; i < data.length; i++) {
                                                let new_location = new L.LatLng(data[i].Latitude, data[i].Longitude);
                                                let Institution = data[i].Institution;
                                                let Number = data[i].Number;
                                                var marker = new L.Marker(new_location, {
                                                title: Institution
                                                });
                                                let message = Institution +' - ' +Number+' Participant(s)';
                                                marker.bindPopup(message);
                                                city.addLayer(marker);
                                            }
                                            map.addLayer(city);
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <!-- Carousel -->
                            <div class="row mt-5">
                                <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                                    </div>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="images/workshops/dsws2022/2.jpg" class="d-block w-100 mx-lg-auto img-fluid" alt="Speech by VC">
                                            <!-- If text needs to be displayed 
                                            <div class="container">
                                                <div class="carousel-caption text-start">
                                                    <h1>Example headline.</h1>
                                                    <p>Some representative placeholder content for the first slide of the carousel.</p>
                                                    <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>
                                                </div>
                                            </div> -->
                                        </div>
                                        <div class="carousel-item">
                                            <img src="images/workshops/dsws2022/9.jpg" class="d-block w-100 mx-lg-auto img-fluid" alt="Participants">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="images/workshops/dsws2022/11.jpg" class="d-block w-100 mx-lg-auto img-fluid" alt="Online Session by Prof M B Rao">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="images/workshops/dsws2022/13.jpg" class="d-block w-100 mx-lg-auto img-fluid" alt="Group Photo">
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                            <!-- Vote of Thanks -->
                            <div class="row mt-5">
                                <p class="text-muted">
                                    We thank the resource persons - 
                                    <a href="https://med.uc.edu/depart/eh/directory/entire-directory/Index/Pubs/raomb" target="_blank">Prof M B Rao</a>, 
                                    <a href="https://uohyd.irins.org/profile/75811" target="_blank">Dr. P Manimaran</a>, 
                                    <a href="https://aiimsbibinagar.edu.in/pdf/Sailu%20Yellaboina.pdf" target="_blank">Dr Sailu Y</a>, 
                                    Dr Ramakumar, and 
                                    <a href="https://www.linkedin.com/in/ravisa/?originalSubdomain=in" target="_blank">Dr Ravi S Ananthula</a> 
                                    - for sharing their valuable knowledge. <br>
                                    We thank our Co-organizers and Co-sponsors - 
                                    <a href="http://cmsd.uohyd.ac.in/" target="_blank">CMSD</a>, 
                                    <a href="https://crraoaimscs.res.in/" target="_blank">CR Rao AIMSCS</a>, 
                                    <a href="https://ikiminds.com/" target="_blank">Ikiminds</a> & 
                                    <a href="https://biofaba.org.in/" target="_blank">FABA</a>
                                </p>
                                <hr style="max-width: 50%;">
                                <p class="text-muted">
                                    <em>- Organizing Committee</em><br>
                                    <a href="http://sls.uohyd.ac.in/new/fac_details.php?fac_id=110" target="_blank">Dr Pankaj Singh</a>, <a href="http://sls.uohyd.ac.in/new/fac_details.php?fac_id=34" target="_blank">Dr Vivek</a> <br>
                                    <a href="http://sls.uohyd.ac.in/new/fac_details.php?fac_id=33" target="_blank">Prof H A Nagarajaram</a>, <a href="https://scis.uohyd.ac.in/~wankarcs/" target="_blank">Prof Rajeev Wankar</a><br>
                                    <a href="http://sls.uohyd.ac.in/new/dbtcmi/team.php">Dr Anwesh Maile, Ms Aishwarya Barik, Mr Abhishek Khatri</a><br>
                                    <a href="http://cmsd.uohyd.ac.in/?page_id=54" target="_blank">Mr Rajender Reddy, Mr Srinivas</a>
                                </p>
                            </div>
                        </div>
                        <!-- Change the content and NNP IDs to Workshop IDs
                        <div class="tab-pane fade" id="nav-nnp2" role="tabpanel" aria-labelledby="nav-nnp2-tab">
                            <div class="row gx-5">
                                <div class="col-lg-8">
                                    <p class="lead text-secondary fw-bold">NNP2</p>
                                    <p class="h5">Genome Analysis of the Screened Microbial isolates of Indian Origin for Better Insights into the Distribution of CAZymes</p>
                                </div>
                                <div class="col-lg-4">
                                    <p class="text-muted mb-0">Primary Collaborators</p>
                                    <p class="fw-bold fs-5 mb-0">Dr J Madhuprakash <br> Dr Vivek</p>
                                    <p>School of Life Sciences <br>
                                    UoH</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-nnp3" role="tabpanel" aria-labelledby="nav-nnp3-tab">
                            <div class="row gx-5">
                                <div class="col-lg-6">
                                    <p class="lead text-secondary fw-bold">NNP3</p>
                                    <p class="h5">A Novel Computational Approach to Generate Genome Based Barcode Intended to Catalog Indian Microbial Species</p>
                                </div>
                                <div class="col-lg-3">
                                    <p class="text-muted mb-0">Primary Collaborators</p>
                                    <p class="fw-bold fs-5 mb-0">Dr Pankaj Singh <br> Dr Manjari Kiran</p>
                                    <p>School of Life Sciences <br>
                                    UoH</p>
                                </div>
                                <div class="col-lg-3">
                                    <br>
                                    <p class="fw-bold fs-5 mb-0">Dr Suresh Babu</p>
                                    <p>SRKR College <br>
                                    Bhimavaram</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-nnp4" role="tabpanel" aria-labelledby="nav-nnp4-tab">
                            <div class="row gx-5">
                                <div class="col-lg-6">
                                    <p class="lead text-secondary fw-bold">NNP4</p>
                                    <p class="h5">Deciphering the Interrelation Between Gut Microbiome Dysbiosis, Host Genetic Susceptibility, and Diet in the Pathogenesis of Indian NAFLD</p>
                                </div>
                                <div class="col-lg-3">
                                    <p class="text-muted mb-0">Primary Collaborators</p>
                                    <p class="fw-bold fs-5 mb-0">Dr M Sasikala <br> Dr V V Ravikanth <br>Dr P N Rao</p>
                                    <p>Asian Health Foundation</p>
                                </div>
                                <div class="col-lg-3">
                                    <br>
                                    <p class="fw-bold fs-5 mb-0">Prof H A Nagarajaram <br>Dr Vivek</p>
                                    <p>School of Life Sciences<br>
                                    UoH</p>
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <?php include_once 'footer.php'; ?>
    
</body>
</html>