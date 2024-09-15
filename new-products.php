<?php include './header.php'; ?>
<div class="main-panel">
	<div class="content">
	    <div class="container-fluid">
            <h5 class="">Products</h5>
            <div class="d-flex justify-content-between align-items-center bg-light px-4 p-2 rounded-1">
                <p>View, Edit, Delete</p>
                <!-- Updated collapse target to 'collapseForm' -->
                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseForm" aria-expanded="false" aria-controls="collapseForm">New Product</button>
            </div>

            <!-- Updated collapse ID to 'collapseForm' to avoid conflict -->
            <form action="" class="collapse border p-3 rounded-4 m-3 input-bg" id="collapseForm">
                <div class="d-flex gap-5">
                    <label for="Product Name">Product Name
                        <input type="text" class="form-control" placeholder="Product Name" style="width: 25rem;">
                    </label>
                    <label for="Purchase Order">Purchase Order
                        <input type="number" class="form-control" placeholder="0">
                    </label>
                    <label for="Delivery Order No.">Delivery Order No.
                        <input type="number" class="form-control" placeholder="0">
                    </label>
                </div>

                <div class="my-3">
                    <div class="input-group">
                        <span class="input-group-text">Category</span>
                        <input type="text" class="form-control" placeholder="Product category">
                    </div>
                </div>

                <div class="my-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Accounting Code</span>
                        <input type="text" class="form-control" placeholder="Code" aria-label="Accounting Code">
                        <span class="input-group-text">Quantity Received</span>
                        <input type="number" class="form-control" placeholder="0" aria-label="Quantity Received">
                        <span class="input-group-text">Units</span>
                        <input type="number" class="form-control" placeholder="0" aria-label="Units">
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <label for="Location">Location
                        <input type="text" class="form-control" placeholder="Product Location">
                    </label>
                    <button type="submit" class="btn btn-success">Add Product</button>
                </div>
            </form>
        </div>
        
    </div>
</div>
<?php include './footer.php'; ?>
