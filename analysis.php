<?php
require("Connection.php");

// Fetch aggregated data for the first chart
$sql = "SELECT Destination, SUM(Num_travelers) AS total_travellers FROM detailed_booking GROUP BY Destination";
$result = $conn->query($sql);

$data1 = [
    'labels' => [],
    'travellers' => []
];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data1['labels'][] = $row['Destination'];
        $data1['travellers'][] = $row['total_travellers'];
    }
}

// Fetch relational data for the second chart
$sql2 = "SELECT Yourcountry, Destination, SUM(Num_travelers) AS total_travellers FROM detailed_booking GROUP BY Yourcountry, Destination";
$result2 = $conn->query($sql2);

$data2 = [
    'countries' => [],
    'destinations' => [],
    'relations' => []
];

if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $data2['countries'][] = $row['Yourcountry'];
        $data2['destinations'][] = $row['Destination'];
        $data2['relations'][] = $row['total_travellers'];
    }
}

// Convert data to JSON
$data1_json = json_encode($data1);
$data2_json = json_encode($data2);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Data Analysis and Visualization</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: rgb(249, 244, 233);
        }

        #myChart,
        #relationChart {
            border: 1px solid #a19d9d;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        /* Styling the chart title */
        h1 {
            color: #373333;
            font-weight: bold;
            text-align: center;
            font-family: Arial, sans-serif;
        }
    </style>
</head>

<body>
    <!-- هنا بنسنتدعي الشارتز و نظبط محتوى الصفحه-->

    <h1>Total number of travelers for each Destination</h1>
    <canvas id="myChart" width="auto" height="125px"></canvas>
    <br>
    <h1>Traveler Statistics: Destinations and Country Relationships</h1>/
    <canvas id="relationChart" width="auto" height="125px"></canvas>

    <script>
        // First chart data
        const ctx1 = document.getElementById("myChart").getContext("2d");
        const data1 = <?php echo $data1_json; ?>;

        const myChart = new Chart(ctx1, {
            type: "bar",
            data: {
                labels: data1.labels,
                datasets: [{
                    label: '# of Travellers',
                    data: data1.travellers,
                    backgroundColor: [
                        "rgba(255, 99, 132, 0.4)",
                        "rgba(54, 162, 235, 0.4)",
                        "rgba(255, 206, 86, 0.4)",
                        "rgba(75, 192, 192, 0.4)",
                        "rgba(153, 102, 255, 0.4)",
                    ],
                    borderColor: [
                        "rgba(255, 99, 132, 1)",
                        "rgba(54, 162, 235, 1)",
                        "rgba(255, 206, 86, 1)",
                        "rgba(75, 192, 192, 1)",
                        "rgba(153, 102, 255, 1)",
                    ],
                    borderWidth: 1,
                }],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });

        // Second chart data
        const ctx2 = document.getElementById("relationChart").getContext("2d");
        const data2 = <?php echo $data2_json; ?>;


        const uniqueDestinations = [...new Set(data2.destinations)];
        const uniqueCountries = [...new Set(data2.countries)];

        const colors = [
            "rgba(255, 99, 132, 0.4)", "rgba(54, 162, 235, 0.4)",
            "rgba(255, 206, 86, 0.4)", "rgba(75, 192, 192, 0.4)",
            "rgba(153, 102, 255, 0.4)", "rgba(255, 159, 64, 0.4)",
            "rgba(199, 199, 199, 0.4)", "rgba(83, 102, 255, 0.4)",
            "rgba(99, 255, 132, 0.4)", "rgba(102, 153, 255, 0.4)"
        ];

        const borderColors = [
            "rgba(255, 99, 132, 1)", "rgba(54, 162, 235, 1)",
            "rgba(255, 206, 86, 1)", "rgba(75, 192, 192, 1)",
            "rgba(153, 102, 255, 1)", "rgba(255, 159, 64, 1)",
            "rgba(199, 199, 199, 1)", "rgba(83, 102, 255, 1)",
            "rgba(99, 255, 132, 1)", "rgba(102, 153, 255, 1)"
        ];

        const datasetMapping = uniqueCountries.map((country, i) => {
            const countryData = uniqueDestinations.map(destination => {
                const countryIndex = data2.countries.indexOf(country);
                const destIndex = data2.destinations.indexOf(destination, countryIndex);
                return destIndex !== -1 ? data2.relations[destIndex] : 0;
            });
            return {
                label: country,
                data: countryData,
                backgroundColor: colors[i % colors.length],
                borderColor: borderColors[i % borderColors.length],
                borderWidth: 1
            };
        });

        const relationChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: uniqueDestinations,
                datasets: datasetMapping,
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                    x: {
                        stacked: false
                    },
                    y: {
                        stacked: false
                    }
                },
            },
        });
    </script>
</body>

</html>