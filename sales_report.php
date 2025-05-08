<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly and Daily Total Amount Graphs</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="img/site.webmanifest">
    <style>
        .chartContainer {
            position: relative;
            border: 2px solid #ddd;
            padding: 20px;
            margin: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .exitButton {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #6F6486;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            z-index: 100;
        }

        .monthlyChart,
        .dailyChart {
            width: 100%;
            height: 400px;
        }

        .monthlyCustomerChart,
        .dailyCustomerChart {
            width: 100%;
            height: 400px;
        }

        h2 {
            margin-top: 50px;
            margin-left: 20px;
            text-align: center;
        }

        .fullWidthLine {
            width: 100%;
            height: 10px;
            background-color: #6F6486;
        }
    </style>
</head>

<body style="background:#D1D5DB; ">
    <div class="fullWidthLine"></div>
    <h2>Monthly Sales</h2>
    <div class="chartContainer" id="monthlyContainer">
        <a href="admin_dashboard.php" class="exitButton">Exit</a>
        <div class="monthlyChart" id="monthlyChart"></div>
    </div>

    <div class="fullWidthLine"></div>
    <h2>Daily Sales</h2>
    <div class="chartContainer" id="dailyContainer">
        <a href="admin_dashboard.php" class="exitButton">Exit</a>
        <div class="dailyChart" id="dailyChart"></div>
    </div>
    <!-- Monthly Total Customers Chart -->
    <div class="fullWidthLine"></div>    
    <h2>Monthly Customers</h2>
    <div class="chartContainer" id="monthlyCustomerContainer">
        <a href="admin_dashboard.php" class="exitButton">Exit</a>
        <div class="monthlyCustomerChart" id="monthlyCustomerChart"></div>
    </div>

    <!-- Daily Total Customers Chart -->
    <div class="fullWidthLine"></div>    
    <h2>Daily Customers</h2>
    <div class="chartContainer" id="dailyCustomerContainer">
        <a href="admin_dashboard.php" class="exitButton">Exit</a>
        <div class="dailyCustomerChart" id="dailyCustomerChart"></div>
    </div>

    <div class="fullWidthLine"></div>   
    <h2>Monthly Product Sales</h2> 
    <div class="chartContainer" id="monthlyUnitContainer">
        <a href="admin_dashboard.php" class="exitButton">Exit</a>
        <div class="monthlyUnitChart" id="monthlyUnitChart"></div>
    </div>

    <!-- Daily Total Units Chart -->
    <div class="fullWidthLine"></div> 
    <h2>Daily Product Sales</h2>   
    <div class="chartContainer" id="dailyUnitContainer">
        <a href="admin_dashboard.php" class="exitButton">Exit</a>
        <div class="dailyUnitChart" id="dailyUnitChart"></div>
    </div>
    <div class="fullWidthLine"></div>   

    <?php
    include 'config.php';

    $monthlySql = "SELECT DATE_FORMAT(date, '%Y-%m') AS month, IFNULL(SUM(total_amount), 0) AS total_amount
            FROM sell
            GROUP BY month
            ORDER BY month";

    $monthlyResult = $conn->query($monthlySql);

    $monthlyRows = array();
    while($monthlyRow = $monthlyResult->fetch_assoc()) {
        $monthlyRows[] = array('c' => array(array('v' => $monthlyRow['month']), array('v' => (int)$monthlyRow['total_amount']), array('v' => (int)$monthlyRow['total_amount'])));
    }

    $dailySql = "SELECT DATE_FORMAT(date, '%Y-%m-%d') AS day, IFNULL(SUM(total_amount), 0) AS total_amount
        FROM sell
        GROUP BY day
        ORDER BY day";

    $dailyResult = $conn->query($dailySql);

    $dailyRows = array();
    while($dailyRow = $dailyResult->fetch_assoc()) {
        $dailyRows[] = array('c' => array(array('v' => $dailyRow['day']), array('v' => (int)$dailyRow['total_amount']), array('v' => (int)$dailyRow['total_amount'])));
    }



    $monthlyResponse = array('cols' => array(
        array('label' => 'Month', 'type' => 'string'),
        array('label' => 'Total Amount', 'type' => 'number'),
        array('role' => 'annotation', 'type' => 'number')
    ), 'rows' => $monthlyRows);

    $dailyResponse = array('cols' => array(
        array('label' => 'Day', 'type' => 'string'),
        array('label' => 'Total Amount', 'type' => 'number'),
        array('role' => 'annotation', 'type' => 'number')
    ), 'rows' => $dailyRows);

    // Monthly Total Customers
    $monthlyCustomerSql = "SELECT DATE_FORMAT(date, '%Y-%m') AS month, COUNT(DISTINCT invoice_no) AS total_customers
            FROM sell
            GROUP BY month
            ORDER BY month";

    $monthlyCustomerResult = $conn->query($monthlyCustomerSql);

    $monthlyCustomerRows = array();
    while($monthlyCustomerRow = $monthlyCustomerResult->fetch_assoc()) {
        $monthlyCustomerRows[] = array('c' => array(array('v' => $monthlyCustomerRow['month']), array('v' => (int)$monthlyCustomerRow['total_customers']), array('v' => (int)$monthlyCustomerRow['total_customers'])));
    }

    $monthlyCustomerResponse = array('cols' => array(
        array('label' => 'Month', 'type' => 'string'),
        array('label' => 'Total Customers', 'type' => 'number'),
        array('role' => 'annotation', 'type' => 'number')
    ), 'rows' => $monthlyCustomerRows);

    // Daily Total Customers
    $dailyCustomerSql = "SELECT DATE_FORMAT(date, '%Y-%m-%d') AS day, COUNT(DISTINCT invoice_no) AS total_customers
        FROM sell
        GROUP BY day
        ORDER BY day";

    $dailyCustomerResult = $conn->query($dailyCustomerSql);

    $dailyCustomerRows = array();
    while($dailyCustomerRow = $dailyCustomerResult->fetch_assoc()) {
        $dailyCustomerRows[] = array('c' => array(array('v' => $dailyCustomerRow['day']), array('v' => (int)$dailyCustomerRow['total_customers']), array('v' => (int)$dailyCustomerRow['total_customers'])));
    }

    $dailyCustomerResponse = array('cols' => array(
        array('label' => 'Day', 'type' => 'string'),
        array('label' => 'Total Customers', 'type' => 'number'),
        array('role' => 'annotation', 'type' => 'number')
    ), 'rows' => $dailyCustomerRows);

    // Monthly Total Units
    $monthlyUnitSql = "SELECT DATE_FORMAT(date, '%Y-%m') AS month, IFNULL(SUM(total_units), 0) AS total_units
            FROM sell
            GROUP BY month
            ORDER BY month";

    $monthlyUnitResult = $conn->query($monthlyUnitSql);

    $monthlyUnitRows = array();
    while($monthlyUnitRow = $monthlyUnitResult->fetch_assoc()) {
        $monthlyUnitRows[] = array('c' => array(array('v' => $monthlyUnitRow['month']), array('v' => (int)$monthlyUnitRow['total_units']), array('v' => (int)$monthlyUnitRow['total_units'])));
    }

    $monthlyUnitResponse = array('cols' => array(
        array('label' => 'Month', 'type' => 'string'),
        array('label' => 'Total Units', 'type' => 'number'),
        array('role' => 'annotation', 'type' => 'number')
    ), 'rows' => $monthlyUnitRows);

    //  Daily Total Units
    $dailyUnitSql = "SELECT DATE_FORMAT(date, '%Y-%m-%d') AS day, IFNULL(SUM(total_units), 0) AS total_units
        FROM sell
        GROUP BY day
        ORDER BY day";

    $dailyUnitResult = $conn->query($dailyUnitSql);

    $dailyUnitRows = array();
    while($dailyUnitRow = $dailyUnitResult->fetch_assoc()) {
        $dailyUnitRows[] = array('c' => array(array('v' => $dailyUnitRow['day']), array('v' => (int)$dailyUnitRow['total_units']), array('v' => (int)$dailyUnitRow['total_units'])));
    }

    $dailyUnitResponse = array('cols' => array(
        array('label' => 'Day', 'type' => 'string'),
        array('label' => 'Total Units', 'type' => 'number'),
        array('role' => 'annotation', 'type' => 'number')
    ), 'rows' => $dailyUnitRows);


    $conn->close();

    echo '<script>
        // Load the Visualization API and the corechart package
        google.charts.load(\'current\', {\'packages\':[\'corechart\']});

        // Set a callback to run when the Google Visualization API is loaded
        google.charts.setOnLoadCallback(drawMonthlyChart);
        google.charts.setOnLoadCallback(drawDailyChart);

        function drawMonthlyChart() {
            // Convert the JSON response to a DataTable
            var dataTable = new google.visualization.DataTable('.json_encode($monthlyResponse).');

            // Set chart options
            var options = {
                title: \'Monthly Total Amount\',
                backgroundColor: { fill: \'transparent\' },
                width: \'100%\',
                height: 400,
                bars: \'vertical\',
                bar: {groupWidth: \'50%\'},
                annotations: {
                    alwaysOutside: true,
                    textStyle: {
                        fontSize: 14,
                        bold: true,
                        color: \'#333\'
                    }
                },
                colors: [\'#6F6486\'],
                hAxis: {
                    title: \'Month\',
                    titleTextStyle: {
                        fontSize: 18,
                        italic: false
                    },
                    textStyle: {
                        fontSize: 14
                    }
                },
                vAxis: {
                    title: \'Total Amount\',
                    titleTextStyle: {
                        fontSize: 18,
                        italic: false
                    },
                    minValue: 0,
                    textStyle: {
                        fontSize: 14
                    }
                },
                legend: { position: \'none\' },
                animation: {
                    duration: 1000,
                    easing: \'out\'
                }
            };

            // Instantiate and draw the chart as a Bar Chart
            var chart = new google.visualization.ColumnChart(document.getElementById(\'monthlyChart\'));
            chart.draw(dataTable, options);
        }

        function drawDailyChart() {
            // Convert the JSON response to a DataTable
            var dataTable = new google.visualization.DataTable('.json_encode($dailyResponse).');

            // Set chart options
            var options = {
                title: \'Daily Total Amount\',
                backgroundColor: { fill: \'transparent\' },
                width: \'100%\',
                height: 400,
                bars: \'vertical\',
                bar: {groupWidth: \'50%\'},
                annotations: {
                    alwaysOutside: true,
                    textStyle: {
                        fontSize: 14,
                        bold: true,
                        color: \'#333\'
                    }
                },
                colors: [\'#6F6486\'],
                hAxis: {
                    title: \'Day\',
                    titleTextStyle: {
                        fontSize: 18,
                        italic: false
                    },
                    textStyle: {
                        fontSize: 14
                    }
                },
                vAxis: {
                    title: \'Total Amount\',
                    titleTextStyle: {
                        fontSize: 18,
                        italic: false
                    },
                    minValue: 0,
                    textStyle: {
                        fontSize: 14
                    }
                },
                legend: { position: \'none\' },
                animation: {
                    duration: 1000,
                    easing: \'out\'
                }
            };

            // Instantiate and draw the chart as a Bar Chart
            var chart = new google.visualization.ColumnChart(document.getElementById(\'dailyChart\'));
            chart.draw(dataTable, options);
        }
        // New code to load the new charts
        google.charts.setOnLoadCallback(drawMonthlyCustomerChart);
        google.charts.setOnLoadCallback(drawDailyCustomerChart);

        function drawMonthlyCustomerChart() {
            var dataTable = new google.visualization.DataTable('.json_encode($monthlyCustomerResponse).');

            var options = {
                title: \'Monthly Total Customers\',
                backgroundColor: { fill: \'transparent\' },
                width: \'100%\',
                height: 400,
                bars: \'vertical\',
                bar: {groupWidth: \'50%\'},
                annotations: {
                    alwaysOutside: true,
                    textStyle: { fontSize: 14, bold: true, color: \'#333\' }
                },
                colors: [\'#6F6486\'],
                hAxis: {
                    title: \'Month\',
                    titleTextStyle: { fontSize: 18, italic: false },
                    textStyle: { fontSize: 14 }
                },
                vAxis: {
                    title: \'Total Customers\',
                    titleTextStyle: { fontSize: 18, italic: false },
                    minValue: 0,
                    textStyle: { fontSize: 14 }
                },
                legend: { position: \'none\' },
                animation: { duration: 1000, easing: \'out\' }
            };

            var chart = new google.visualization.ColumnChart(document.getElementById(\'monthlyCustomerChart\'));
            chart.draw(dataTable, options);
        }

        function drawDailyCustomerChart() {
            var dataTable = new google.visualization.DataTable('.json_encode($dailyCustomerResponse).');

            var options = {
                title: \'Daily Total Customers\',
                backgroundColor: { fill: \'transparent\' },
                width: \'100%\',
                height: 400,
                bars: \'vertical\',
                bar: {groupWidth: \'50%\'},
                annotations: {
                    alwaysOutside: true,
                    textStyle: { fontSize: 14, bold: true, color: \'#333\' }
                },
                colors: [\'#6F6486\'],
                hAxis: {
                    title: \'Day\',
                    titleTextStyle: { fontSize: 18, italic: false },
                    textStyle: { fontSize: 14 }
                },
                vAxis: {
                    title: \'Total Customers\',
                    titleTextStyle: { fontSize: 18, italic: false },
                    minValue: 0,
                    textStyle: { fontSize: 14 }
                },
                legend: { position: \'none\' },
                animation: { duration: 1000, easing: \'out\' }
            };

            var chart = new google.visualization.ColumnChart(document.getElementById(\'dailyCustomerChart\'));
            chart.draw(dataTable, options);
        }

        // New code to load the new charts
        google.charts.setOnLoadCallback(drawMonthlyUnitChart);
        google.charts.setOnLoadCallback(drawDailyUnitChart);

        function drawMonthlyUnitChart() {
            var dataTable = new google.visualization.DataTable('.json_encode($monthlyUnitResponse).');

            var options = {
                title: \'Monthly Total Units\',
                backgroundColor: { fill: \'transparent\' },
                width: \'100%\',
                height: 400,
                bars: \'vertical\',
                bar: {groupWidth: \'50%\'},
                annotations: {
                    alwaysOutside: true,
                    textStyle: { fontSize: 14, bold: true, color: \'#333\' }
                },
                colors: [\'#6F6486\'],
                hAxis: {
                    title: \'Month\',
                    titleTextStyle: { fontSize: 18, italic: false },
                    textStyle: { fontSize: 14 }
                },
                vAxis: {
                    title: \'Total Units\',
                    titleTextStyle: { fontSize: 18, italic: false },
                    minValue: 0,
                    textStyle: { fontSize: 14 }
                },
                legend: { position: \'none\' },
                animation: { duration: 1000, easing: \'out\' }
            };

            var chart = new google.visualization.ColumnChart(document.getElementById(\'monthlyUnitChart\'));
            chart.draw(dataTable, options);
        }

        function drawDailyUnitChart() {
            var dataTable = new google.visualization.DataTable('.json_encode($dailyUnitResponse).');

            var options = {
                title: \'Daily Total Units\',
                backgroundColor: { fill: \'transparent\' },
                width: \'100%\',
                height: 400,
                bars: \'vertical\',
                bar: {groupWidth: \'50%\'},
                annotations: {
                    alwaysOutside: true,
                    textStyle: { fontSize: 14, bold: true, color: \'#333\' }
                },
                colors: [\'#6F6486\'],
                hAxis: {
                    title: \'Day\',
                    titleTextStyle: { fontSize: 18, italic: false },
                    textStyle: { fontSize: 14 }
                },
                vAxis: {
                    title: \'Total Units\',
                    titleTextStyle: { fontSize: 18, italic: false },
                    minValue: 0,
                    textStyle: { fontSize: 14 }
                },
                legend: { position: \'none\' },
                animation: { duration: 1000, easing: \'out\' }
            };

            var chart = new google.visualization.ColumnChart(document.getElementById(\'dailyUnitChart\'));
            chart.draw(dataTable, options);
        }

    </script>';

    ?>
</body>

</html>