<div class="container">
    <h1>Inventory Dashboard</h1>

    <!-- ========== STATS CARDS ========== -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5>Total Products</h5>
                    <h2><?= $stats->total_products ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5>In Stock</h5>
                    <h2><?= $stats->total_in_stock ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5>Low Stock</h5>
                    <h2><?= $stats->total_low_stock ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5>Out of Stock</h5>
                    <h2><?= $stats->total_out_of_stock ?></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== INVENTORY CHART ========== -->
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="m-0">Inventory Status Distribution</h4>
        </div>
        <div class="card-body">
            <canvas id="inventoryChart" width="400" height="200"></canvas>
        </div>
    </div>

    <!-- ========== RECENT PRODUCTS TABLE ========== -->
    <div class="card mt-4">
        <div class="card-header">
            <h4>Recently Updated Products</h4>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Last Updated</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($latestProducts as $product): ?>
                        <tr>
                            <td><?= h($product->name) ?></td>
                            <td><?= $product->quantity ?></td>
                            <td><?= $this->Number->currency($product->price) ?></td>
                            <td><?= $product->last_updated->format('M j, Y H:i') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ========== QUICK ACTION BUTTONS ========== -->
    <div class="mt-4">
        <?= $this->Html->link('Manage Products', ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
        <?= $this->Html->link('Add New Product', ['action' => 'add'], ['class' => 'btn btn-success']) ?>
    </div>

    <!-- ========== CHART.JS SCRIPT ========== -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('inventoryChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['In Stock', 'Low Stock', 'Out of Stock'],
                    datasets: [{
                        label: 'Number of Products',
                        data: [
                            <?= $stats->total_in_stock ?>,
                            <?= $stats->total_low_stock ?>,
                            <?= $stats->total_out_of_stock ?>
                        ],
                        backgroundColor: [
                            '#28a745', // Green (matches success card)
                            '#ffc107', // Yellow (matches warning card)
                            '#dc3545' // Red (matches danger card)
                        ],
                        borderColor: [
                            '#218838', // Darker green
                            '#e0a800', // Darker yellow
                            '#c82333' // Darker red
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            enabled: true
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                color: '#6c757d'
                            },
                            grid: {
                                color: '#f8f9fa'
                            }
                        },
                        x: {
                            ticks: {
                                color: '#6c757d'
                            },
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        });
    </script>
</div>