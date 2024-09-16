<?php include './header.php'; ?>
<div class="main-panel">
    <div class="content">
         <div class="container-fluid" >
             <div class="">
             <div class="container mt-5">
  <h3>Receiving Dashboard</h3>

  <div class="row">
    <!-- Pending Orders -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          Pending Deliveries
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Delivery Order #123 - 20 Items</li>
          <li class="list-group-item">Delivery Order #124 - 15 Items</li>
          <!-- More pending orders -->
        </ul>
      </div>
    </div>

    <!-- Recent Receipts -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          Recently Received Product
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Product A - 50 Units - Received</li>
          <li class="list-group-item">Product B - 30 Units - Received</li>
          <!-- More recently received -->
        </ul>
      </div>
    </div>
  </div>

  <!-- Button to add new receipt -->
  <div class="mt-3">
    <a href="receive-new-goods.php" class="btn btn-primary">Receive New Products</a>
  </div>
</div>

             </div>
             <div class="">
                <div>
                <div class="container mt-5">
  <h3>Receive New Products</h3>
  <form>
    <div class="mb-3">
      <label for="deliveryOrder" class="form-label">Delivery Order Number</label>
      <input type="text" class="form-control" id="deliveryOrder" placeholder="Enter delivery order number">
    </div>
    
    <div class="mb-3">
      <label for="productName" class="form-label">Product Name</label>
      <input type="text" class="form-control" id="productName" placeholder="Enter product name">
    </div>

    <div class="mb-3">
      <label for="quantity" class="form-label">Quantity</label>
      <input type="number" class="form-control" id="quantity" placeholder="Enter quantity">
    </div>
    
    <div class="mb-3">
      <label for="supplierName" class="form-label">Supplier Name</label>
      <input type="text" class="form-control" id="supplierName" placeholder="Enter supplier name">
    </div>

    <div class="mb-3">
      <label for="scanDelivery" class="form-label">Scan Delivery Order</label>
      <input type="file" class="form-control" id="scanDelivery" accept="image/*" capture="camera">
    </div>
    
    <button type="button" class="btn btn-primary">Generate QR Code</button>
    <button type="submit" class="btn btn-success">Receive Products</button>
  </form>
</div>
 </div>
    <div><div class="container mt-5">
  <h3>Generate QR Code</h3>
  <div id="qrcode"></div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
  var qrcode = new QRCode(document.getElementById("qrcode"), {
    text: "Delivery Order #123",
    width: 128,
    height: 128,
    colorDark : "#000000",
    colorLight : "#ffffff",
    correctLevel : QRCode.CorrectLevel.H
  });
</script>
</div>
             </div>
         </div>
    </div>
</div>

<?php include './footer.php'; ?>