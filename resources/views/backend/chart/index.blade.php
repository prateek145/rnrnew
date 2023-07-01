<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>JS Bin</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/0.2.0/Chart.min.js" type="text/javascript"></script>
</head>

<body>
    <script></script>

    <h1>Chart.js Sample</h1>
    <canvas id="myChart" width="600" height="400"></canvas>
</body>

<script>
    var pieData = [{
            value: 20,
            color: "#878BB6",

        },
        {
            value: 40,
            color: "#4ACAB4",

        },
        {
            value: 10,
            color: "#FF8153",

        },
        {
            value: 30,
            color: "#FFEA88",

        }
    ];
    // Get the context of the canvas element we want to select
    var myChart = document.getElementById("myChart").getContext("2d");
    new Chart(myChart).Pie(pieData);
</script>

</html>
