// Add shadow to navbar on scroll
const navEl = document.querySelector('.navbar');

window.addEventListener('scroll', () => {
    if (window.scrollY >= 20) {
        navEl.classList.add('scrolled');
    } else if (window.scrollY < 70) {
        navEl.classList.remove('scrolled');
    }
});

// Enabling Tooltips
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

/* DataTables */
$(document).ready(function () {
    $('#mgStudiesTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: 'dashboard/mg_tables/studies.php',
        type: 'POST'
      },
    });
    $('#mgSamplesTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: 'dashboard/mg_tables/samples.php',
        type: 'POST'
      },
    });
    $('#mgAmpliconsTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: 'dashboard/mg_tables/amplicons.php',
        type: 'POST'
      },
    });
    $('#mgShotgunsTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: 'dashboard/mg_tables/shotguns.php',
        type: 'POST'
      },
    });
    $('#samplesTable').DataTable();
    $('#otuTable').DataTable();
    $('#envHumanTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: 'dashboard/env_tables/human.php',
        type: 'POST'
      },
    });
    $('#envPlantTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: 'dashboard/env_tables/plant.php',
        type: 'POST'
      },
    });
    $('#envAnimalTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: 'dashboard/env_tables/animal.php',
        type: 'POST'
      },
    });
    $('#envInsectTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: 'dashboard/env_tables/insect.php',
        type: 'POST'
      },
    });
    $('#envBirdTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: 'dashboard/env_tables/bird.php',
        type: 'POST'
      },
    });
    $('#envAquaticTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: 'dashboard/env_tables/aquatic.php',
        type: 'POST'
      },
    });
    $('#envMarineTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: 'dashboard/env_tables/marine.php',
        type: 'POST'
      },
    });
    $('#envTerrestrialTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: 'dashboard/env_tables/terrestrial.php',
        type: 'POST'
      },
    });
    $('#envGutTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: 'dashboard/env_tables/gut.php',
        type: 'POST'
      },
    });
    $('#envRhizosphereTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: 'dashboard/env_tables/rhizosphere.php',
        type: 'POST'
      },
    });
    $('#envIndustryTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: 'dashboard/env_tables/industry.php',
        type: 'POST'
      },
    });
    $('#envRefineryTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: 'dashboard/env_tables/refinery.php',
        type: 'POST'
      },
    });
    $('#envAnthropogenicTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: 'dashboard/env_tables/anthropogenic.php',
        type: 'POST'
      },
    });
    $('#envPoultryTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: 'dashboard/env_tables/poultry.php',
        type: 'POST'
      },
    });
    $('#envCattleTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: 'dashboard/env_tables/cattle.php',
        type: 'POST'
      },
    });
    $('#envFishTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: 'dashboard/env_tables/fish.php',
        type: 'POST'
      },
    });
});

/* Scroll to top */
let mybutton = document.getElementById("btn-back-to-top");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  if (
    document.body.scrollTop > 20 ||
    document.documentElement.scrollTop > 20
  ) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
// When the user clicks on the button, scroll to the top of the document
mybutton.addEventListener("click", backToTop);

function backToTop() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

