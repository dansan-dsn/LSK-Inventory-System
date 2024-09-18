<?php include './header.php'; ?>
<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <?php
            session_start();
            include './db_connection.php';

            $product_name = $purchase_order_no = $delivery_order_no = $category = $supplier = $accounting_code = $quantity_received = $units = $location = $description = $success = '';
            $error = [];

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $action = $_POST['action'];
                $error = validateInput($_POST);

                if (empty($error)) {
                    if ($action == 'create') {
                        $result = createProduct($_POST);
                        if ($result) {
                            $_SESSION['success'] = "Product created Successfully";
                        } else {
                            $_SESSION['error'][] = "Failded to create record";
                        }
                    } elseif ($action == 'edit') {
                        $id = $_POST['id'];
                        $result = updateProduct($id, $_POST);
                        if ($result) {
                            $_SESSION['success'] = "Product successfully updated";
                        } else {
                            $_SESSION['error'][] = "Failded to update record";
                        }
                    }
                }
                header("Location: new-products.php");
                exit();
            }

            function validateInput($data)
            {
                $error = [];

                if (empty($data['product_name'])) {
                    $_SESSION['error'][] = "Product name is required";
                }

                if (empty($data['category'])) {
                    $_SESSION['error'][] = "Category is required";
                }
                return $error;
            }

            function createProduct($data)
            {
                global $conn;

                $stmt = $conn->prepare('INSERT INTO product_tb (product_name, purchase_order_no, delivery_order_no, category, supplier, accounting_code, quantity_received, units, `location`, `description`) VALUES (?,?,?,?,?,?,?,?,?,?)');
                if ($stmt) {
                    $stmt->bind_param(
                        "ssssssisss",
                        $data['product_name'],
                        $data['purchase_order_no'],
                        $data['delivery_order_no'],
                        $data['category'],
                        $data['supplier'],
                        $data['accounting_code'],
                        $data['quantity_received'],
                        $data['units'],
                        $data['location'],
                        $data['description']
                    );
                    $result = $stmt->execute();
                    $stmt->close();
                    return $result;
                } else {
                    return false;
                }
            }

            function updateProduct($id, $data)
            {
                global $conn;
                $stmt = $conn->prepare('UPDATE product_tb SET product_name=?, purchase_order_no=?, delivery_order_no=?, category=?, supplier=?, accounting_code=?, quantity_received=?, units=?, `location`=?, `description`=? WHERE id=?');

                if ($stmt) {
                    $stmt->bind_param(
                        "ssssssisssi",
                        $data['product_name'],
                        $data['purchase_order_no'],
                        $data['delivery_order_no'],
                        $data['category'],
                        $data['supplier'],
                        $data['accounting_code'],
                        $data['quantity_received'],
                        $data['units'],
                        $data['location'],
                        $data['description'],
                        $id
                    );
                    $result = $stmt->execute();
                    $stmt->close();
                    return $result;
                } else {
                    return false;
                }
            }

            // all product
            $products = "SELECT * FROM product_tb";
            $result = $conn->query($products);
            $index = 1;


            // delete product
            if (isset($_GET['delete_id'])) {
                $delete_id = intval($_GET['delete_id']);  // Ensure delete_id is an integer

                // Prepare the DELETE query
                $delete_stmt = $conn->prepare("DELETE FROM product_tb WHERE id = ?");
                if ($delete_stmt) {
                    $delete_stmt->bind_param("i", $delete_id);  // Bind the product ID
                    if ($delete_stmt->execute()) {
                        $_SESSION['success'] = "Product deleted successfully";
                    } else {
                        $_SESSION['error'] = "Failed to delete product";
                    }
                    $delete_stmt->close();
                } else {
                    $_SESSION['error'] = "Failed to prepare the delete SQL statement.";
                }
                header("Location: new-products.php");
                exit();
            }
            ?>


            <!-- <div class="d-flex justify-content-center row " id="success-m">
                        <p class="bg-success p-2 text-center text-white rounded col-12 col-sm-6 col-md-4">
                    </div>
                    <div class="d-flex justify-content-center row " id="error-m">
                        <p class="bg-danger p-2 text-center text-white rounded col-12 col-sm-6 col-md-4">
                    </div>  -->
            <?php
            if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
                echo "<div class'd-flex justify-content-center alert alert-success row' id='success-m'>
                        <p class='bg-success p-2 text-center text-white rounded col-12 col-sm-6 col-md-4'>{$_SESSION['success']}</p>
                        </div>";
                unset($_SESSION['success']);
            } elseif ((isset($_SESSION['error']) && !empty($_SESSION['error']))) {
                echo "<div class'd-flex justify-content-center row' id='error-m'>
                        <p class='bg-error p-2 text-center text-white rounded col-12 col-sm-6 col-md-4'>{$_SESSION['error']}</p>
                        </div>";
                unset($_SESSION['error']);
            }
            ?>


            <h5 class="">Products</h5>
            <div class="d-flex justify-content-between align-items-center bg-light px-4 p-2 rounded-1">
                <button class="btn btn-info">Scan OCR</button>
                <button class="btn btn-warning fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseForm" aria-expanded="false" aria-controls="collapseForm"><span class="fs-5 mx-2 text-dark">&plus;</span>New Product</button>
            </div>
            <form action="" method="POST" class="collapse border p-3 rounded-4 my-3 input-bg" id="collapseForm">
                <input type="hidden" name="action" value="create">
                <div class="row mb-3">
                    <div class="col-md-4 mb-3 mb-md-0 ">
                        <label for="ProductName" class="form-label" required>Product Name</label>
                        <input type="text" class="form-control " name="product_name" id="ProductName" placeholder="Product Name" required>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <label for="PurchaseOrderNo" class="form-label">Purchase Order No.</label>
                        <input type="text" class="form-control" name="purchase_order_no" id="PurchaseOrder" placeholder="BC34" required>
                    </div>
                    <div class="col-md-4">
                        <label for="DeliveryOrderNo" class="form-label">Delivery Order No.</label>
                        <input type="text" class="form-control" name="delivery_order_no" id="DeliveryOrderNo" placeholder="MN234" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <label for="Category" class="form-label" required>Category</label>
                        <select class="form-select" name="category" aria-label="Default select example" id="AccountingCode">
                            <option value=""> Select Category</option>
                            <option value="Electronics">Electronics</option>
                            <option value="Furniture">Furniture</option>
                            <option value="Clothing">Clothing</option>
                        </select>
                        <!-- <input type="text" class="form-control" id="Category" placeholder="Product category"> -->
                    </div>
                    <div class="col-md-4 mt-md-2">
                        <label for="supplier">Supplier</label>
                        <select name="supplier" id="supplier" class="form-select" aria-label="Default select example">
                            <option value="">Select Supplier</option>
                            <option value="Electronics">Electronics</option>
                            <option value="Furniture">Furniture</option>
                            <option value="Clothing">Clothing</option>
                        </select>
                    </div>
                    <div class="col-md-4 ">
                        <label for="AccountingCode" class="form-label">Accounting Code</label>
                        <select class="form-select" name="accounting_code" aria-label="Default select example" id="AccountingCode">
                            <option value=""> Select Code </option>
                            <option value="Electronics">Electronics</option>
                            <option value="Furniture">Furniture</option>
                            <option value="Clothing">Clothing</option>
                        </select>
                        <!-- <input type="text" class="form-control" id="AccountingCode" placeholder="Code"> -->
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <label for="QuantityReceived" class="form-label">Quantity Received</label>
                        <input type="number" name="quantity_received" class="form-control" id="QuantityReceived" placeholder="0" required>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <label for="Units" class="form-label">Units</label>
                        <input type="text" name="units" class="form-control" id="Units" placeholder="0">
                    </div>
                    <div class="col-md-4">
                        <label for="Location" class="form-label">Location</label>
                        <select class="form-select" name="location" aria-label="Default select example" id="Location">
                            <option value=""> Select location</option>
                            <option value="Electronics">Electronics</option>
                            <option value="Furniture">Furniture</option>
                            <option value="Clothing">Clothing</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-9 col-12 mb-3 mb-md-0">
                        <div class="input-group ">
                            <label class="input-group-text" class="form-label">Description</label>
                            <textarea class="form-control" aria-label="With textarea" name="description" placeholder="More about the product.."></textarea>
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
                            <th scope="col">Product</th>
                            <th scope="col">Supplier</th>
                            <!-- &#x25B4; -->
                            <th scope="col" style="cursor: pointer;">Category&#x25BE;</th>
                            <th scope="col" style="cursor: pointer;">Location&#x25BE;</th>
                            <th scope="col" style="cursor: pointer;">Accounting Code&#x25BE;</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <th scope="row"><?php echo $index++; ?></th>
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
                                    <div class="modal fade" id="showModal<?php echo $index ?>" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-primary-emphasis text-uppercase" id="showMoalLabel"><?php echo htmlspecialchars($row['product_name']); ?></h5>
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
                                        data-bs-target="#editModal<?php echo $index ?>"></i>

                                    <!-- Modal for Edit-->
                                    <div class="modal fade" id="editModal<?php echo $index ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form method="POST" action="">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="action" value="edit">
                                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                        <div class="d-flex gap-2 align-items-center">
                                                            <div class="mb-3 form-floating">
                                                                <input type="text" name="product_name" value="<?php echo htmlspecialchars($row['product_name']); ?>" class="form-control" id="NameInput">
                                                                <label for="NameInput">Product Name</label>
                                                            </div>
                                                            <div class="mb-3 d-flex flex-row">
                                                                <select name="supplier" id="supplier" class="custom-select form-select d-flex flex-column align-items-center" aria-label="Default select example" value="<?php echo htmlspecialchars($row['supplier']); ?>">
                                                                    <option value="" class="">Select category</option>
                                                                    <option value="supplier 1">category One</option>
                                                                    <option value="supplier 2">category two</option>
                                                                    <option value="supplier 3">category three</option>
                                                                </select>
                                                                <label for="supplier">Category</label>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex gap-2">
                                                            <div class="mb-3 form-floating">
                                                                <input type="text" name="purchase_order_no" value="<?php echo htmlspecialchars($row['purchase_order_no']); ?>" class="form-control" id="floatingInput">
                                                                <label for="floatingInput">Purchase Order No</label>
                                                            </div>
                                                            <div class="mb-3 form-floating">
                                                                <input type="text" class="form-control" id="floatingInput" name="delivery_order_no" value="<?php echo htmlspecialchars($row['delivery_order_no']); ?>">
                                                                <label for="floatingInput">Delivery Order No</label>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex gap-2">
                                                            <div class="mb-3 form-floating">
                                                                <input type="text" name="units" value="<?php echo htmlspecialchars($row['units']); ?>" class="form-control" id="floatingInput" placeholder="product name">
                                                                <label for="floatingInput">Units</label>
                                                            </div>
                                                            <div class="mb-3 form-floating">
                                                                <input type="text" class="form-control" id="floatingInput" placeholder="category" name="quantity_received" value="<?php echo htmlspecialchars($row['quantity_received']); ?>">
                                                                <label for="floatingInput">Quantity Received</label>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex gap-2 mb-3 align-items-center">
                                                            <label for="supplier">Supplier</label>
                                                            <select name="supplier" id="supplier" class="form-select" aria-label="Default select example" value="<?php echo htmlspecialchars($row['supplier']); ?>">
                                                                <option value=""> Select Supplier</option>
                                                                <option value="supplier 1">Suppleir One</option>
                                                                <option value="supplier 2">Suppleir two</option>
                                                                <option value="supplier 3">Suppleir three</option>
                                                            </select>
                                                        </div>
                                                        <div class="d-flex gap-2 mb-3 align-items-center">
                                                            <label for="supplier">Accounting Code</label>
                                                            <select name="accounting_code" id="supplier" class="form-select" aria-label="Default select example">
                                                                <option value="" class="text-dark-emphasis"> Select code </option>
                                                                <option value="code 1" <?= ($row['accounting_code'] == 'code 1') ? 'select' : ''; ?>>code 1</option>
                                                                <option value="code 2" <?= ($row['accounting_code'] == 'code 2') ? 'select' : ''; ?>>code 2</option>
                                                                <option value="code 3" <?= ($row['accounting_code'] == 'code 3') ? 'select' : ''; ?>>code 3</option>
                                                            </select>
                                                        </div>
                                                        <div class="d-flex gap-2 mb-3 align-items-center">
                                                            <label for="location">Location</label>
                                                            <select name="location" id="location" class="form-select" aria-label="Default select example" value="<?php echo htmlspecialchars($row['location']); ?>">
                                                                <option value=""> Select location </option>
                                                                <option value="location 1">location 1</option>
                                                                <option value="location 2">location 2</option>
                                                                <option value="location 3">location 3</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3 form-floating">
                                                            <input type="text" class="form-control" id="descriptionInput" name="description" value="<?php echo htmlspecialchars($row['description']); ?>">
                                                            <label for="descriptionInput">Description</label>
                                                        </div>
                                                        <button type="submit" class="btn btn-success">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
        </div>

        <!-- Delete icon -->
        <a href="?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure to delete this product')"><i class='bx bx-trash bg-danger text-white p-1 rounded hover-dicon' title="Delete"></i></a>
        </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
    </table>
<?php else: ?>
    <p class="text-center mt-5 fs-5 fw-bold">No Product</p>
<?php endif; ?>
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