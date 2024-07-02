// Home page of Dashboard
// State wise sample distribution Bar Chart

var statesBarOptions = {
    series: [
      {
        name: "Metagenomes",
        // data: [3722, 3528, 1918, 1850, 1377, 899, 753, 654, 550, 408, 395, 320, 307, 229, 208, 149, 143, 141, 125, 97, 82, 77, 66, 64, 63, 53, 48, 46, 41, 38, 18, 16, 15, 7, 2, 1, 28, 789],
        data: sample_no,
      },

    ],
    chart: {
      type: "bar",
      height: 500,
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "85%",
        endingShape: "rounded",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent"],
    },
    xaxis: {
      categories: y_axis,
      title: {
        text: "States",
      },
    },
    yaxis: {
      title: {
        text: "Number of Samples",
      },
    },
    fill: {
      opacity: 1,
    },
    tooltip: {
      y: {
        formatter: function (val) {
          return val
        },
      },
    },
  }

var statesBar = new ApexCharts(document.querySelector("#statesBar"), statesBarOptions)
statesBar.render()
