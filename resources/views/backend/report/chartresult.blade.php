@extends('backend.layouts.app')
@section('content')
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="row mb-4">
                <div class="col-md-7">
                    <h4 class="mb-0">Application Name({{ $application->name }}) -> Report</h4>

                </div>
                <div class="col-md-5">
                    <select name="changedatatype" onchange="changedatatype(this.value)" id="" class="form-control">
                        <option value="dataonly">Data Only</option>
                        <option value="chartonly">Chart Only</option>
                        <option value="chart_data">Chart and Date</option>
                    </select>

                </div>



            </div>

            <h3>Line Graph</h3>
            <canvas id="lineChart" height="100px"></canvas>

            <h3>Pie Graph</h3>
            <canvas id="pieChart" height="100px"></canvas>

            <h3>Bar Graph</h3>
            <canvas id="barChart" height="100px"></canvas>

            <h3>Vertical Bar Graph</h3>
            <canvas id="vbarChart" height="100px"></canvas>

            <h3>Radar Graph</h3>
            <canvas id="radarChart" height="100px"></canvas>

            <h3>Doughnut Graph</h3>
            <canvas id="doughnutChart" height="100px"></canvas>

            <h3>Funnel Graph</h3>
            <div id="chartContainer" style="height: 300px; width: 100%;"></div>

            <h3>TreeMap Graph</h3>
            <canvas id="chartJSContainer" width="600" height="400"></canvas>


            {{-- table --}}
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Field Name</th>
                            <th scope="col">Count</th>
                            {{-- <th scope="col">Updated At</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        {{-- {{dd($matchedfieldids)}} --}}
                        @foreach ($matchedfieldids as $value)
                            @foreach ($value as $item => $ss)
                                <tr>
                                    <td>{{ $item }}</td>
                                    <td>{{ $ss }}</td>
                                </tr>
                            @endforeach
                        @endforeach

                    </tbody>
                </table>
            </div>


        </div>
    </div>
    <!-- Recent Sales End -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-chart-treemap@2.0.1/dist/chartjs-chart-treemap.js"></script>

    <script type="text/javascript">
        var labels = {{ Js::from($labels) }};
        var users = {{ Js::from($data) }};

        const data = {
            labels: labels,
            datasets: [{
                label: 'My First dataset',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: users,
            }]
        };

        //line graph

        const lineconfig = {
            type: 'line',
            data: data,
            options: {}
        };

        const lineChart = new Chart(
            document.getElementById('lineChart'),
            lineconfig
        );

        //pie graph

        const pieconfig = {
            type: 'pie',
            data: data,
            options: {}
        };

        const pieChart = new Chart(
            document.getElementById('pieChart'),
            pieconfig
        );

        //bar graph
        const barconfig = {
            type: 'bar',
            data: data,
            options: {}
        };

        const barChart = new Chart(
            document.getElementById('barChart'),
            barconfig
        );

        //vertical bar graph
        const vbarconfig = {
            type: 'bar',
            data: data,
            options: {
                indexAxis: 'y',
            }
        };

        const vbarChart = new Chart(
            document.getElementById('vbarChart'),
            vbarconfig
        );

        //radar graph
        const radarconfig = {
            type: 'radar',
            data: data,
            options: {}
        };

        const radarChart = new Chart(
            document.getElementById('radarChart'),
            radarconfig
        );

        //doughnut  graph
        const doughnutconfig = {
            type: 'doughnut',
            data: data,
            options: {}
        };

        const doughnutChart = new Chart(
            document.getElementById('doughnutChart'),
            doughnutconfig
        );


        //funnel  graph
        var chart = new CanvasJS.Chart("chartContainer", {
            title: {
                // text: "Company Recruitment Process"
            },
            data: [{
                type: "funnel",
                indexLabel: "{label} [{y}%]",
                toolTipContent: "{label} - {y}%",
                dataPoints: [{
                        y: 100,
                        label: "Candidates Applied"
                    },
                    {
                        y: 63,
                        label: "Aptitude Test"
                    },
                    {
                        y: 35,
                        label: "Technical Interview"
                    },
                    {
                        y: 15,
                        label: "HR Interview"
                    },
                    {
                        y: 100,
                        label: "Candidates Recruited"
                    }
                ]
            }]
        });
        chart.render();

        // treemap  graph
        const options = {
            type: 'treemap',
            data: {
                datasets: [{
                    label: '# of Votes',
                    tree: [12, 19, 3, 5, 2, 3],
                    backgroundColor: 'pink',
                    labels: {
                        display: true,
                        formatter(ctx) {
                            const data = ctx.chart.data;
                            return `Custom Text: ${data.datasets[ctx.datasetIndex].tree[ctx.dataIndex]}`;
                        }
                    },
                }]
            },
            options: {}
        }

        const ctx = document.getElementById('chartJSContainer').getContext('2d');
        new Chart(ctx, options);
    </script>
@endsection
