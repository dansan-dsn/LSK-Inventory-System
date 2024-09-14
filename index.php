<?php include './header.php'; ?>
<div class="main-panel ">
    <div class="content ">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content ">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard Overview</h1>
            </div>

            <!-- Summary Info Section with Percentage Increase -->
            <div class="row">
                <!-- Total Products -->
                <div class="col-md-3">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5>Total Products</h5>
                            <h2>450</h2>
                            <!-- Calculate percentage change -->
                            <p class="percentage-change">
                                <span class="text-success">▲ 10%</span> from last week
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Low Stock -->
                <div class="col-md-3">
                    <div class="card bg-warning text-dark mb-4">
                        <div class="card-body">
                            <h5>Low Stock</h5>
                            <h2>15</h2>
                            <!-- Percentage Decrease -->
                            <p class="percentage-change">
                                <span class="text-danger">▼ 5%</span> from last week
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Received Items -->
                <div class="col-md-3">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">
                            <h5>Received Items</h5>
                            <h2>320</h2>
                            <!-- Calculate percentage change -->
                            <p class="percentage-change">
                                <span class="text-success">▲ 8%</span> from last week
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Alerts -->
                <div class="col-md-3">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">
                            <h5>Alerts</h5>
                            <h2>5</h2>
                            <!-- Percentage Increase -->
                            <p class="percentage-change">
                                <span class="text-danger">▲ 20%</span> from last week
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graphs Section -->
            <div class="row">
                <!-- Stock Levels Line Chart -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Stock Levels Over Time</h5>
                            <canvas id="stockChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Products Received Bar Chart -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Products Received</h5>
                            <canvas id="receivedChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Sections -->
            <div class="row mt-4">
                <!-- Receiving Section -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Receiving</h5>
                            <p>Track materials like rubber, units, suppliers, amount received, etc.</p>
                            <a href="#" class="btn btn-primary">Go to Receiving</a>
                        </div>
                    </div>
                </div>

                <!-- Stock Levels Section -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Stock Levels</h5>
                            <p>Monitor stock levels and get low stock alerts.</p>
                            <a href="#" class="btn btn-primary">Go to Stock Levels</a>
                        </div>
                    </div>
                </div>

                <!-- Products Section -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Products</h5>
                            <p>Manage inventory products and their details.</p>
                            <a href="#" class="btn btn-primary">Go to Products</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <!-- Reports & Analytics Section -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Reports & Analytics</h5>
                            <p>Generate various reports and view analytics.</p>
                            <a href="#" class="btn btn-primary">Go to Reports & Analytics</a>
                        </div>
                    </div>
                </div>

                <!-- Categories Section -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Categories</h5>
                            <p>Organize products into different categories.</p>
                            <a href="#" class="btn btn-primary">Go to Categories</a>
                        </div>
                    </div>
                </div>

                <!-- Delivery Records Section -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Delivery Records</h5>
                            <p>Track delivery records of your inventory.</p>
                            <a href="#" class="btn btn-primary">Go to Delivery Records</a>
                        </div>
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
    // Stock Levels Line Chart
    var ctx = document.getElementById('stockChart').getContext('2d');
    var stockChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'Stock Levels',
                data: [150, 200, 180, 220, 170, 190, 230],
                borderColor: 'rgba(75, 192, 192, 1)',
                fill: false
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Products Received Bar Chart
    var ctx2 = document.getElementById('receivedChart').getContext('2d');
    var receivedChart = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'Products Received',
                data: [50, 100, 80, 120, 90, 110, 130],
                backgroundColor: 'rgba(54, 162, 235, 0.6)'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
