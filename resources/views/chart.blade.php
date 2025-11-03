@extends('admintemplate')
@section('title', 'Chart')

@section('content')
    <div class="chart-container">
        <h2 class="chart-title">Number of Orders in October</h2>
        <div id="container"></div>
    </div>

    <script>
        var datakeys = @json(array_keys($order));
        var datavalues = @json(array_values($order));

        Highcharts.chart('container', {
            chart: {
                type: 'column',
                backgroundColor: '#1a1a1a'
            },
            title: {
                text: null
            },
            xAxis: {
                categories: datakeys,
                crosshair: true,
                labels: {
                    style: {
                        color: '#e0e0e0',
                        fontWeight: '600'
                    }
                },
                lineColor: '#DAA520',
                tickColor: '#DAA520'
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Orders',
                    style: {
                        color: '#e0e0e0',
                        fontWeight: '600'
                    }
                },
                labels: {
                    style: {
                        color: '#e0e0e0'
                    }
                },
                gridLineColor: '#333'
            },
            tooltip: {
                valueSuffix: ' orders',
                backgroundColor: '#222',
                style: {
                    color: '#e0e0e0'
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0,
                    color: '#DAA520'
                }
            },
            series: [{
                name: 'Orders',
                data: datavalues
            }]
        });
    </script>

    <style>


        .chart-container {
            background: #111;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        .chart-title {
            text-align: center;
            font-family: 'Great Vibes', cursive;
            color: #DAA520;
            margin-bottom: 20px;
            font-size: 1.5rem;
            font-weight: 700;

        }

        #container {
            width: 100%;
            height: 500px;
        }
    </style>
@endsection
