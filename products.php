<?php include './header.php'; ?>
<div class="main-panel">
	<div class="content">
	<div class="container-fluid">
<table class="table table-hover">
  <thead class="fs-4">
    <tr class="table table-dark text-light">
      <th scope="col">No</th>
      <th scope="col" class="fs-6">Product</th>
      <th scope="col">Product ID</th>
      <th scope="col">Location</th>
      <th scope="col">Available</th>
      <th scope="col">Reserved</th>
      <th scope="col">On Hand</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>IPhpne 12</td>
      <td>IM31</td>
      <td>Warehouse1</td>
      <td class="s-md">234</td>
      <td class="">12</td>
      <td>111</td>
      <td>
        <!-- Edit icon -->
        <i class='bx bxs-edit-alt px-1 bg-primary text-white p-1 rounded hover-eicon' title="Edit"></i>
        <!-- Delete icon -->
        <i class='bx bx-trash bg-danger text-white p-1 rounded mx-1 hover-dicon' title="Delete"></i>
    </td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Hp Pavilion</td>
      <td>IM32</td>
      <td>Warehouse2</td>
      <td>123</td>
      <td>234</td>
      <td>2345</td>
      <td>
        <!-- Edit icon -->
        <i class='bx bxs-edit-alt px-1 bg-primary text-white p-1 rounded hover-eicon' title="Edit"></i>
        <!-- Delete icon -->
        <i class='bx bx-trash bg-danger text-white p-1 rounded mx-1 hover-dicon' title="Delete"></i></td>
    </tr>
  </tbody>
</table>
        </div>
    </div>
</div>
<?php include './footer.php';?>