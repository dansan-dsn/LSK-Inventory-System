<?php include './header.php'; ?>
<div class="main-panel">
	<div class="content">
	    <div class="container-fluid">

        <?php
include './db_connection.php'; 

$product_name = '';
$purchase_order_no = '';
$delivery_order_no = '';
$category = '';
$supplier = '';
$accounting_code = '';
$quantity_received ='';
$units = '';
$location = '';
$description = '';
$message = '';
$success = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $purchase_order_no = $_POST['purchase_order_no'];
    $delivery_order_no = $_POST['delivery_order_no'];
    $category = $_POST['category'];
    $supplier = $_POST['supplier'];
    $accounting_code = $_POST['accounting_code'];
    $quantity_received = $_POST['quantity_received'];
    $units = $_POST['units'];
    $location = $_POST['location'];
    $description = $_POST['description'];

    if(empty($product_name) || empty($supplier)) {
        $message = "Please fill all the required fields";
    } else {
        $stmt = $conn->prepare("INSERT INTO product_tb (product_name, purchase_order_no, delivery_order_no, category, supplier, accounting_code, quantity_received, units, `location`, `description`) VALUES (?,?,?,?,?,?,?,?,?,?)");

        if ($stmt) {

            $stmt->bind_param("ssssssisss", $product_name, $purchase_order_no, $delivery_order_no, $category, $supplier, $accounting_code, $quantity_received, $units, $location, $description);

            if ($stmt->execute()) {
                $success = "Product Added Successfully";
                $product_name = '';
                $purchase_order_no = '';
                $delivery_order_no = '';
                $category = '';
                $supplier = '';
                $accounting_code = '';
                $quantity_received = '';
                $units = '';
                $location = '';
                $description = '';
            } else {
                $message = "Failed to add Product";
            }
            $stmt->close();
        } else {
            $message = "Failed to prepare the sql statements.";
        }
    }
}

$conn->close();
?>

                <?php if (!empty($success)): ?> 
                    <div class="d-flex justify-content-center row">
                        <p class="bg-success p-2 text-center text-white rounded col-12 col-sm-6 col-md-4"><?php echo htmlspecialchars($success); ?></p>
                    </div>
                <?php elseif (!empty($message)): ?>
                    <div class="d-flex justify-content-center row">
                        <p class="bg-danger p-2 text-center text-white rounded col-12 col-sm-6 col-md-4"><?php echo htmlspecialchars($message); ?></p>
                    </div>
                <?php endif; ?>

            <h5 class="">Products</h5>
            <div class="d-flex justify-content-between align-items-center bg-light px-4 p-2 rounded-1">
                <button class="btn btn-info">Scan OCR</button>
                <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseForm" aria-expanded="false" aria-controls="collapseForm"><span class="fs-5 mx-2">&plus;</span>New Product</button>
            </div>
            <form action="" method="POST" class="collapse border p-3 rounded-4 m-3 input-bg" id="collapseForm">
                <div class="row mb-3">
                    <div class="col-md-4 mb-3 mb-md-0 has">
                        <label for="ProductName" class="form-label" value="<?php echo htmlspecialchars($product_name); ?>" required>Product Name</label>
                        <input type="text" class="form-control " name="product_name" id="ProductName" placeholder="Product Name" required>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <label for="PurchaseOrderNo" class="form-label">Purchase Order No.</label>
                        <input type="text" class="form-control" name="purchase_order_no" value="<?php echo htmlspecialchars($purchase_order_no); ?>" id="PurchaseOrder" placeholder="BC34" required>
                    </div>
                    <div class="col-md-4">
                        <label for="DeliveryOrderNo" class="form-label">Delivery Order No.</label>
                        <input type="text" class="form-control" name="delivery_order_no" value="<?php echo htmlspecialchars($delivery_order_no); ?>" id="DeliveryOrderNo" placeholder="MN234" requied>
                    </div>
                </div>
        
                <div class="row mb-3">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <label for="Category" class="form-label" required>Category</label>
                        <select class="form-select" name="category" aria-label="Default select example" id="AccountingCode">
                            <option value=""> -- Select Category -- </option>   
                            <option value="Electronics" <?php if ($category == "Electronics") echo "selected"; ?>>Electronics</option>
                            <option value="Furniture" <?php if ($category == "Furniture") echo "selected"; ?>>Furniture</option>
                            <option value="Clothing" <?php if ($category == "Clothing") echo "selected"; ?>>Clothing</option>
                        </select>
                        <!-- <input type="text" class="form-control" id="Category" placeholder="Product category"> -->
                    </div>
                    <div class="col-md-4 mt-md-2">
                        <label for="supplier">Supplier</label>
                        <select name="supplier" id="supplier" class="form-select" aria-label="Default select example">
                            <option value=""> -- Select Supplier -- </option>
                            <option value="Electronics" <?php if ($supplier == "Electronics") echo "selected"; ?>>Electronics</option>
                            <option value="Furniture" <?php if ($supplier == "Furniture") echo "selected"; ?>>Furniture</option>
                            <option value="Clothing" <?php if ($supplier == "Clothing") echo "selected"; ?>>Clothing</option>
                        </select>
                    </div>
                    <div class="col-md-4 ">
                        <label for="AccountingCode" class="form-label">Accounting Code</label>
                        <select class="form-select" name="accounting_code" aria-label="Default select example" id="AccountingCode">
                            <option value="">-- Select Code --</option>
                            <option value="Electronics" <?php if ($accounting_code == "Electronics") echo "selected"; ?>>Electronics</option>
                            <option value="Furniture" <?php if ($accounting_code == "Furniture") echo "selected"; ?>>Furniture</option>
                            <option value="Clothing" <?php if ($accounting_code == "Clothing") echo "selected"; ?>>Clothing</option>
                        </select>
                        <!-- <input type="text" class="form-control" id="AccountingCode" placeholder="Code"> -->
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <label for="QuantityReceived" class="form-label">Quantity Received</label>
                        <input type="number" name="quantity_received" value="<?php echo htmlspecialchars($quantity_received) ?>" class="form-control" id="QuantityReceived" placeholder="0" required>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <label for="Units" class="form-label">Units</label>
                        <input type="text" name="units" class="form-control" value="<?php echo htmlspecialchars($units) ?>" id="Units" placeholder="0">
                    </div>
                    <div class="col-md-4">
                        <label for="Location" class="form-label">Location</label>
                        <select class="form-select" name="location" aria-label="Default select example" id="Location">
                            <option value="">-- Select location--</option>
                            <option value="Electronics" <?php if ($location == "Electronics") echo "selected"; ?>>Electronics</option>
                            <option value="Furniture" <?php if ($location == "Furniture") echo "selected"; ?>>Furniture</option>
                            <option value="Clothing" <?php if ($location == "Clothing") echo "selected"; ?>>Clothing</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-9 col-12 mb-3 mb-md-0">
                        <div class="input-group ">
                            <label class="input-group-text" class="form-label">Description</label>
                            <textarea class="form-control" aria-label="With textarea" name="description" placeholder="More about the product.."><?php echo htmlspecialchars($description); ?></textarea>
                        </div>
                    </div>
                    <div class="col-8 col-md-3 mt-2 md-mt-0">
                        <button type="submit" class="btn btn-success">Add Product</button>
                    </div>
                </div>
            </form>
            <table class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th scope="col" class="">No</th>
                        <th scope="col" class="fs-6">Product</th>
                        <th scope="col">Product ID</th>
                        <th scope="col">Category<span class="mx-2 caret"></th>
                        <th scope="col">Location<span class="mx-2 caret"></span>
                        <th scope="col">Available</th>
                        <th scope="col">Quantity Received</th>
                        <th scope="col">Units</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody >
                        <tr>
                        <th scope="row">1</th>
                        <td>IPhpne 12</td>
                        <td>IM31</td>
                        <td>Phones</td>
                        <td>Warehouse1</td>
                        <td class="s-md">234</td>
                        <td class="">12</td>
                        <td>111</td>
                        <td>
                            <i class='bx bxs-show px-1 bg-info text-white p-1 rounded-pill hover-sicon' title="show"></i>
                            <!-- Edit icon -->
                            <i class='bx bxs-edit-alt px-1 bg-primary text-white p-1 mx-1 rounded hover-eicon' title="Edit"></i>
                            <!-- Delete icon -->
                            <i class='bx bx-trash bg-danger text-white p-1 rounded hover-dicon' title="Delete"></i>
                        </td>
                        </tr>
                    <tr>
                    <th scope="row">2</th>
                    <td>Hp Pavilion</td>
                    <td>IM32</td>
                    <td>Laptops</td>
                    <td>Warehouse2</td>
                    <td>123</td>
                    <td>234</td>
                    <td>2345</td>
                    <td>
                        <!-- view icon -->
                        <i class='bx bxs-show px-1 bg-info text-white p-1 rounded-pill hover-sicon' title="show"></i>
                        <!-- Edit icon -->
                        <i class='bx bxs-edit-alt px-1 bg-primary text-white p-1 mx-1 rounded hover-eicon' title="Edit"></i>
                        <!-- Delete icon -->
                        <i class='bx bx-trash bg-danger text-white p-1 rounded hover-dicon' title="Delete"></i></td>
                    </tr>
                </tbody>
            </table>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Product</h5>
                  <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">
        </div>
    </div>
</div>
<?php include './footer.php'; ?>