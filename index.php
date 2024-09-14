<?php include './header.php'; ?>

<div class="main-panel bg-light">
    <div class="content">
        <main class="col-md-12 ms-sm-auto col-lg-12 px-md-4 main-content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard Overview</h1>
                <!-- Time Period Selector -->
                <div>
                    <label for="timePeriod" class="form-label">Select Time Period:</label>
                    <select id="timePeriod" class="form-select">
                        <option value="monthly" selected>Monthly</option>
                        <option value="weekly">Weekly</option>
                    </select>
                </div>
            </div>

            <!-- Summary Info Section -->
            <div class="row mb-4">
                <!-- Total Products -->
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card border-0 shadow-sm h-100 rounded">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title text-primary">Total Products</h5>
                            <h2 class="display-4" id="totalProducts">450</h2>
                            <p class="text-muted">Current stock of all products.</p>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-success" id="totalProductsChange">&uarr; 10% <small>Growth</small></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Received -->
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card border-0 shadow-sm h-100 rounded">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title text-primary">Products Received</h5>
                            <h2 class="display-4" id="productsReceived">320</h2>
                            <p class="text-muted">Products received this period.</p>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-success" id="productsReceivedChange">&uarr; 8% <small>Increase</small></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Low Stock -->
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card border-0 shadow-sm h-100 rounded">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title text-danger">Low Stock</h5>
                            <h2 class="display-4" id="lowStock">15</h2>
                            <p class="text-muted">Products running low on stock.</p>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-danger" id="lowStockChange">&darr; 5% <small>Decrease</small></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Alerts -->
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card border-0 shadow-sm h-100 rounded">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title text-warning">Alerts</h5>
                            <h2 class="display-4" id="alerts">5</h2>
                            <p class="text-muted">Critical stock alerts.</p>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-warning" id="alertsChange">&uarr; 20% <small>Increase</small></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graphs Section -->
            <div class="row mb-4">
                <!-- Stock Levels Line Chart -->
                <div class="col-lg-6 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Stock Levels Over Time</h5>
                            <canvas id="stockChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Products Received Bar Chart -->
                <div class="col-lg-6 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Products Received</h5>
                            <canvas id="receivedChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detailed Sections -->
            <!-- Detailed Sections -->
            <div class="row">
                <!-- Receiving Management -->
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Receiving Management</h5>
                            <p>Track and manage materials, including mattresses, units, suppliers, and amounts received. Ensure timely processing and updates.</p>
                        </div>
                    </div>
                </div>

                <!-- Stock Levels -->
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Stock Levels</h5>
                            <p>Monitor and manage stock levels. Receive alerts for low stock items to maintain inventory balance.</p>
                        </div>
                    </div>
                </div>

                <!-- Products -->
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Products</h5>
                            <p>Manage product details, track inventory levels, and ensure optimal stock availability.</p>
                        </div>
                    </div>
                </div>

                <!-- Report and Analysis -->
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Report and Analysis</h5>
                            <p>Generate detailed reports and analyze various metrics such as sales performance, stock trends, and inventory turnover.</p>
                        </div>
                    </div>
                </div>

                <!-- Delivery Records -->
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Delivery Records</h5>
                            <p>Track delivery details including status, dates, and related information. Maintain accurate records of all deliveries.</p>
                        </div>
                    </div>
                </div>

                <!-- Categories -->
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Categories</h5>
                            <p>Manage product categories, including creation, editing, and organization for better product classification and management.</p>
                        </div>
                    </div>
                </div>

                <!-- Staff Management -->
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Staff Management</h5>
                            <p>Manage staff details, roles, and access levels. Ensure efficient management and organization of staff resources.</p>
                        </div>
                    </div>
                </div>
        </main>
    </div>
</div>

<?php include './footer.php'; ?>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Initialize Charts
    var ctx = document.getElementById('stockChart').getContext('2d');
    var stockChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'Stock Levels',
                data: [150, 200, 180, 220, 170, 190, 230],
                borderColor: 'rgba(75, 192, 192, 1)',
                fill: false,
                borderWidth: 2,
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += context.raw;
                            return label;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)',
                        borderDash: [5, 5]
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)',
                        borderDash: [5, 5]
                    }
                }
            }
        }
    });

    var ctx2 = document.getElementById('receivedChart').getContext('2d');
    var receivedChart = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'Products Received',
                data: [50, 100, 80, 120, 90, 110, 130],
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderRadius: 8,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += context.raw;
                            return label;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)',
                        borderDash: [5, 5]
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)',
                        borderDash: [5, 5]
                    }
                }
            }
        }
    });

    // Event listener for time period change
    document.getElementById('timePeriod').addEventListener('change', function() {
        var period = this.value;
        
        // Update data based on the selected period
        // Placeholder for actual data update logic
        if (period === 'weekly') {
            // Example weekly data
            document.getElementById('totalProducts').innerText = '460';
            document.getElementById('productsReceived').innerText = '330';
            document.getElementById('lowStock').innerText = '18';
            document.getElementById('alerts').innerText = '6';
            
            // Example changes
            document.getElementById('totalProductsChange').innerHTML = '&uarr; 2% <small>Growth</small>';
            document.getElementById('productsReceivedChange').innerHTML = '&uarr; 3% <small>Increase</small>';
            document.getElementById('lowStockChange').innerHTML = '&uarr; 20% <small>Increase</small>';
            document.getElementById('alertsChange').innerHTML = '&uarr; 15% <small>Increase</small>';

            // Update charts with weekly data
            stockChart.data.labels = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
            stockChart.data.datasets[0].data = [150, 170, 160, 180];
            stockChart.update();

            receivedChart.data.labels = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
            receivedChart.data.datasets[0].data = [60, 80, 70, 90];
            receivedChart.update();
        } else {
            // Example monthly data
            document.getElementById('totalProducts').innerText = '450';
            document.getElementById('productsReceived').innerText = '320';
            document.getElementById('lowStock').innerText = '15';
            document.getElementById('alerts').innerText = '5';

            // Example changes
            document.getElementById('totalProductsChange').innerHTML = '&uarr; 10% <small>Growth</small>';
            document.getElementById('productsReceivedChange').innerHTML = '&uarr; 8% <small>Increase</small>';
            document.getElementById('lowStockChange').innerHTML = '&darr; 5% <small>Decrease</small>';
            document.getElementById('alertsChange').innerHTML = '&uarr; 20% <small>Increase</small>';

            // Update charts with monthly data
            stockChart.data.labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'];
            stockChart.data.datasets[0].data = [150, 200, 180, 220, 170, 190, 230];
            stockChart.update();

            receivedChart.data.labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'];
            receivedChart.data.datasets[0].data = [50, 100, 80, 120, 90, 110, 130];
            receivedChart.update();
        }
    });
</script>
