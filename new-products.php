<?php include './header.php'; ?>
<div class="main-panel">
	<div class="content">
	    <div class="container-fluid">
<?php
include './db_connection.php'; 

$product_name = $purchase_order_no = $delivery_order_no = $category = $supplier = $accounting_code = $quantity_received = $units = $location = $description = $message = $success = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $purchase_order_no = $_POST['purchase_order_no'];
    $delivery_order_no = $_POST['deliverys_order_no'];
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
                $product_name = $purchase_order_no = $delivery_order_no = $category = $supplier = $accounting_code = $quantity_received = $units = $location = $description = '';
            } else {
                $message = "Failed to add Product";
            }
            $stmt->close();
        } else {
            $message = "Failed to prepare the sql statements.";
        }
    }
}

// all product
$products = "SELECT * FROM product_tb";
$result = $conn->query($products);

$index = 1;

// a single product

//  $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

//  $query = $conn->prepare("SELECT * FROM product_tb WHERE id = ?");
//  $query->bind_param("i", $id);
//  $query->execute();
//  $single_result = $query->get_result();

//  if($result->num_rows > 0) {
//     $product = $result->fetch_assoc();
//  }

if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);  // Ensure delete_id is an integer

    // Prepare the DELETE query
    $delete_stmt = $conn->prepare("DELETE FROM product_tb WHERE id = ?");
    if ($delete_stmt) {
        $delete_stmt->bind_param("i", $delete_id);  // Bind the product ID
        if ($delete_stmt->execute()) {
            $success = "Product deleted successfully";
        } else {
            $message = "Failed to delete product";
        }
        $delete_stmt->close();
    } else {
        $message = "Failed to prepare the delete SQL statement.";
    }
}

?>

                <?php if (!empty($success)): ?> 
                    <div class="d-flex justify-content-center row " id="success-m">
                        <p class="bg-success p-2 text-center text-white rounded col-12 col-sm-6 col-md-4"><?php echo htmlspecialchars($success); ?></p>
                    </div>
                <?php elseif (!empty($message)): ?>
                    <div class="d-flex justify-content-center row " id="error-m">
                        <p class="bg-danger p-2 text-center text-white rounded col-12 col-sm-6 col-md-4"><?php echo htmlspecialchars($message); ?></p>
                    </div>
                <?php endif; ?>

            <h5 class="">Products</h5>
            <div class="d-flex justify-content-between align-items-center bg-light px-4 p-2 rounded-1">
                <button class="btn btn-info">Scan OCR</button>
                <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseForm" aria-expanded="false" aria-controls="collapseForm"><span class="fs-5 mx-2">&plus;</span>New Product</button>
            </div>
            <form action="" method="POST" class="collapse border p-3 rounded-4 my-3 input-bg" id="collapseForm">
                <div class="row mb-3">
                    <div class="col-md-4 mb-3 mb-md-0 ">
                        <label for="ProductName" class="form-label" value="<?php echo htmlspecialchars($product_name); ?>" required>Product Name</label>
                        <input type="text" class="form-control " name="product_name" id="ProductName" placeholder="Product Name" required>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <label for="PurchaseOrderNo" class="form-label">Purchase Order No.</label>
                        <input type="text" class="form-control" name="purchase_order_no" value="<?php echo htmlspecialchars($purchase_order_no); ?>" id="PurchaseOrder" placeholder="BC34" required>
                    </div>
                    <div class="col-md-4">
                        <label for="DeliveryOrderNo" class="form-label">Delivery Order No.</label>
                        <input type="text" class="form-control" name="delivery_order_no" value="<?php echo htmlspecialchars($delivery_order_no); ?>" id="DeliveryOrderNo" placeholder="MN234" required>
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
            <?php if ($result->num_rows > 0): ?>
            <table class="table table-striped mt-4">
                <thead>
                    <tr class="fs-sm">
                        <th scope="col">No</th>
                        <th scope="col" >Product</th>
                        <th scope="col">Supplier</th>
                        <th scope="col" >Category&#9660;</th>
                        <th scope="col" class="pointer-cursor">Location&#9660;</th>
                        <th scope="col">Accounting Code</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody >
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                        <th scope="row"><?php echo $index++;?></th>
                        <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['supplier']); ?></td>
                        <td><?php echo htmlspecialchars($row['category']); ?></td>
                        <td><?php echo htmlspecialchars($row['location']); ?></td>
                        <td><?php echo htmlspecialchars($row['accounting_code']); ?></td>
                        <td class="d-flex">
                            <i class='bx bxs-show px-1 bg-info text-white p-1 rounded-pill hover-sicon' title="show" data-bs-toggle="modal" data-bs-target="#showModal<?php echo $index; ?>"></i>

                            <!-- <?php 
                            // if( $single_result->num_rows > 0):
                                 ?> -->
                            <div class="modal fade" id="showModal<?php echo $index?>" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-primary-emphasis" id="showMoalLabel"><?php echo htmlspecialchars($row['product_name']); ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            
                                        </div>
                                        
                                        <div class="modal-body">
                                            <div class="mb-2 mx-3">
                                                <div class="d-flex justify-content-between">
                                                    <h6>Purchase No: </h6>
                                                    <p class="fs-6"><?php echo htmlspecialchars($row['purchase_order_no']); ?></p>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <h6>Delivery No: </h6>
                                                    <p class="fs-6"><?php echo htmlspecialchars($row['delivery_order_no']); ?></p>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <h6>Accounting Code: </h6>
                                                    <p class="fs-6"><?php echo htmlspecialchars($row['accounting_code']); ?></p>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <h6>Supplier: </h6>
                                                    <p class="fs-6"><?php echo htmlspecialchars($row['supplier']); ?></p>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <h6>Category: </h6>
                                                    <p class="fs-6"><?php echo htmlspecialchars($row['category']); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit icon -->
                            <i class='bx bxs-edit-alt px-1 bg-primary text-white p-1 mx-1 rounded hover-eicon' 
                            title="Edit" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editModal"></i>

                                <!-- Modal for Edit-->
                                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                        <div class="mb-3">
                                            <label for="itemName" class="form-label">Item Name</label>
                                            <input type="text" class="form-control" id="itemName" placeholder="Enter item name">
                                        </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary">Edit</button>
                                    </div>
                                    </div>
                                </div>
                                </div>

                            <!-- Delete icon -->
                            <a href="?delete_id=<?php echo $row['id'];?>" onclick="return confirm('Are you sure to delete this product')"><i class='bx bx-trash bg-danger text-white p-1 rounded hover-dicon' title="Delete"></i></a>
                        </td>
                        </tr>
                        <?php endwhile;?>
                </tbody>
            </table>
            <?php else: ?>
                <p class="text-center mt-5 fs-5 fw-bold">No Product</p>
            <?php endif;?>
            <?php
            $result->free();
            $conn->close();
            ?>
    </div>
</div>
<?php include './footer.php'; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const successMessage = document.getElementById('success-m');
        if (successMessage) {
            setTimeout(function() {
                successMessage.style.opacity = '0';
                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 600); 
            }, 2000);
        }

        const errorMessage = document.getElementById('error-m');
        if (errorMessage) {
            setTimeout(function() {
                errorMessage.style.opacity = '0';
                setTimeout(function() {
                    errorMessage.style.display = 'none';
                }, 600); 
            }, 2000);
        }
    });
</script>