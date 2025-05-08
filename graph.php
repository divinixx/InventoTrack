<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Total Amount Graph</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
  <link rel="manifest" href="img/site.webmanifest">
    <style>
        #chartContainer {
            align-items: center;
            border: 2px solid #ddd;
            padding: 20px; 
            margin: 20px; 
        }
        #exitButton {
            position: absolute;
            top: 50px;
            right: 50px;
            padding: 10px 20px;
            background-color: #6F6486; 
            color: #fff; 
            border: none;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            z-index:100;
        }
    </style>
</head>
<body style="background:#D1D5DB; " >
    <div id="chartContainer">
    <a href="report.php" id="exitButton">Exit</a>
        <div id="monthlyChart"></div>
    </div>
    

    <?php
    include 'config.php';

    $sql = "SELECT DATE_FORMAT(date, '%Y-%m') AS month, IFNULL(SUM(amount), 0) AS total_amount
            FROM purchase
            GROUP BY month
            ORDER BY month";

    $result = $conn->query($sql);

    $rows = array();
    while ($row = $result->fetch_assoc()) {
        $rows[] = array('c' => array(array('v' => $row['month']), array('v' => (int)$row['total_amount']), array('v' => (int)$row['total_amount'])));
    }

    $conn->close();

    $response = array('cols' => array(
        array('label' => 'Month', 'type' => 'string'),
        array('label' => 'Total Amount', 'type' => 'number'),
        array('role' => 'annotation', 'type' => 'number')
    ), 'rows' => $rows);

    echo '<script>
        // Load the Visualization API and the corechart package
        google.charts.load(\'current\', {\'packages\':[\'corechart\']});

        // Set a callback to run when the Google Visualization API is loaded
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // Convert the JSON response to a DataTable
            var dataTable = new google.visualization.DataTable(' . json_encode($response) . ');

            // Set chart options
            var options = {
                title: \'Monthly Total Amount\',
                backgroundColor: { fill: \'transparent\' },  // Set the background color to transparent
                width: \'100%\',
                height: 600,
                bars: \'vertical\',  // Display bars vertically
                bar: {groupWidth: \'50%\'},  // Adjust the width of bars
                annotations: {
                    alwaysOutside: true,  // Display annotations always outside the bar
                    textStyle: {
                        fontSize: 18,
                        bold: true,
                        color: \'#333\'  // Annotation text color
                    }
                },
                colors: [\'#6F6486\'],  // Bar color
                hAxis: {
                    title: \'Month\',  // X-axis title
                    titleTextStyle: {
                        fontSize: 18,
                        italic: false
                        
                    },
                    textStyle: {
                        fontSize: 18
                    }
                },
                vAxis: {
                    title: \'Total Amount\',  // Y-axis title
                    titleTextStyle: {
                        fontSize: 18,
                        italic: false
                    },
                    minValue: 0,  // Minimum value on Y-axis
                    textStyle: {
                        fontSize: 18
                    }
                },
                legend: { position: \'none\' },  // Hide legend
                animation: {
                    duration: 1000,  // Animation duration in milliseconds
                    easing: \'out\'  // Animation easing function
                }
            };

            // Instantiate and draw the chart as a Bar Chart
            var chart = new google.visualization.ColumnChart(document.getElementById(\'monthlyChart\'));
            chart.draw(dataTable, options);
        }
    </script>';
    ?>
</body>
</html>
