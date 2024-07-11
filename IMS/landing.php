<?php
if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION['login'] != 'success') {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/highcharts.js"></script>
    <script src="js/highcharts-more.js"></script>
    <script src="js/solid-gauge.js"></script>
    <script src="js/exporting.js"></script>
    <script src="js/export-data.js"></script>
    <script src="js/accessibility.js"></script>
    <title>Home</title>
</head>
<style>
    body {
        background-image: url('./img/Landing.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        /*min-height: 100vh;
padding-bottom: 50px; /* To accommodate the footer */
    }

    .card {
        border-radius: 10px;
        transition: transform 0.3s;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .container {
        margin-top: 150px;
    }

    .footer {
        background-color: #f8f9fa;
        padding: 20px;
        text-align: center;
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
    }
</style>

<body>
    <header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="./landing.php"><img src="./img/logo.PNG" alt="Logo" height="50px"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="./landing.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./products.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./customer_orders.php">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./customers.php">Customers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./add_orders.php">Add Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./add_products.php">Add Product</a>
                    </li>
                </ul>
                <button class="btn btn-outline-danger my-2 my-sm-0" id="logoutButton" onclick="window.location.href = 'logout.php'">Logout</button>
            </div>
        </nav>
    </header>
    <?php
    require_once("database.php");
    $dashboardResult = $databaseHandler->getDashboardReport();
    $products = $databaseHandler->getTopSellingProducts();
    ?>
    <div class="container">
        <div class="row" style="width: 50%; float: left; margin-right: 50px; display: block;">
            <div class="col-xxl-2 mb">
                <div id = "card0" style = "height:370px">
                </div>
                </div>
            </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div id="card1" style="height: 180px">
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div id="card2" style="height: 180px">
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div id="card3" style="height: 180px">
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div id="card4" style="height: 180px">
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="footer">
<p>Random Information &copy; 2023</p> -->
    </div>





    <script type="text/javascript">
        var gaugeOptions = {
            chart: {
                type: 'solidgauge'
            },

            title: "null",

            pane: {
                center: ['50%', '85%'],
                size: '140%',
                startAngle: -90,
                endAngle: 90,
                background: {
                    backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#EEE',
                    innerRadius: '60%',
                    outerRadius: '100%',
                    shape: 'arc'
                }
            },

            exporting: {
                enabled: false
            },

            tooltip: {
                enabled: false
            },

            // the value axis
            yAxis: {
                stops: [
                    [0.1, '#DF5353'], // green
                    [0.5, '#DDDF0D'], // yellow
                    [0.9, '#55BF3B'] // red
                ],
                lineWidth: 0,
                tickWidth: 0,
                minorTickInterval: null,
                tickAmount: 2,
                title: {
                    y: -60,
                    text: ''
                },
                labels: {
                    y: 16
                },
                min: 0,
                max: 200
            },

            plotOptions: {
                solidgauge: {
                    dataLabels: {
                        y: 5,
                        borderWidth: 0,
                        useHTML: true
                    }
                }
            },
            credits: {
                enabled: false
            },
            series: [{
                name: '',
                data: [],
                dataLabels: {
                    format: '<div style="text-align:center">' +
                        '<span style="font-size:25px">{y}</span><br/>' +
                        '</div>'
                },
                tooltip: {
                    valueSuffix: ''
                }
            }]
        };

        var dayOrders = JSON.parse(JSON.stringify(gaugeOptions));
        dayOrders.yAxis.max = 10;
        dayOrders.yAxis.title.text = "Today's Orders";
        dayOrders.series[0].name = "Today's Orders";
        dayOrders.series[0].tooltip.valueSuffix = "Today's Orders";
        dayOrders.series[0].data[0] = <?php echo $dashboardResult->dailyOrders; ?>;
        var dayOrdersChart = Highcharts.chart('card1', dayOrders);

        var weekOrders = JSON.parse(JSON.stringify(gaugeOptions));
        weekOrders.yAxis.max = 50;
        weekOrders.yAxis.title.text = "Week Orders";
        weekOrders.series[0].name = "Week Orders";
        weekOrders.series[0].tooltip.valueSuffix = "Week Orders";
        weekOrders.series[0].data[0] = <?php echo $dashboardResult->weeklyOrders; ?>;
        var weekOrdersChart = Highcharts.chart('card2', weekOrders);


        var monthOrders = JSON.parse(JSON.stringify(gaugeOptions));
        monthOrders.yAxis.max = 200;
        monthOrders.yAxis.title.text = "Month Orders";
        monthOrders.series[0].name = "Month Orders";
        monthOrders.series[0].tooltip.valueSuffix = "Month Orders";
        monthOrders.series[0].data[0] = <?php echo $dashboardResult->monthlyOrders; ?>;
        var monthOrdersChart = Highcharts.chart('card3', monthOrders);

        var totalCustomers = JSON.parse(JSON.stringify(gaugeOptions));
        totalCustomers.yAxis.max = 200;
        totalCustomers.yAxis.title.text = "Total Customers";
        totalCustomers.series[0].name = "Total Customers";
        totalCustomers.series[0].tooltip.valueSuffix = "Total Customers";
        totalCustomers.series[0].data[0] = <?php echo $dashboardResult->totalCustomers; ?>;
        var totalCustomersChart = Highcharts.chart('card4', totalCustomers);
    </script>
    <script type="text/javascript">
        const columnChart = {
            chart: {
                type: 'column'
            },
            title: {
                align: 'center',
                text: 'Top Selling Products'
            },
            accessibility: {
                announceNewData: {
                    enabled: true
                }
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Sold Units'
                }

            },
            legend: {
                enabled: false
            },
            
            credits: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:.1f}'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b><br/>'
            },

            series: [{
                name: 'Product',
                colorByPoint: true,
                data: []
            }]
        };

        var topProducts = JSON.parse(JSON.stringify(columnChart));
        <?php
        $index = 0;
        foreach ($products as $product) {
            echo "topProducts.series[0].data[$index] = {};";
            echo "topProducts.series[0].data[$index].name ='$product->name';";
            echo "topProducts.series[0].data[$index].y = $product->quantity;";
            $index ++;
        }?>
        var topProductsChart = Highcharts.chart('card0', topProducts);
    </script>
</body>

</html>