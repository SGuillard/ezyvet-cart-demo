<html>

<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>EzyVet</title>
</head>

<body>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="#">Shopping Cart demo</a>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="row">
          <div class="col-lg-6" style="margin-top: 40px">
            <h4>Product List</h4>
            <ul class="list-group">
              <?php foreach (ProductStorage::LIST as $product) { ?>
                <li class="list-group-item">
                  <div class="row">
                    <div class="col-md-4">
                      <p class="font-weight-bold"><?= $product["name"] ?></p>
                    </div>
                    <div class="col-md-4">
                      <?= round($product["price"], 2) ?>&#36;
                    </div>
                    <div class="col-md-4">
                      <a class="btn btn-primary" href="<?= "http://" . $_SERVER['SERVER_NAME'] . "/?action=add&product=" . $product["name"] ?>" role="button">Add</a>
                    </div>
                </li>
              <?php } ?>
            </ul>
          </div>
          <div class="col-lg-6" style="margin-top: 40px">
            <h4>Cart Items</h4>
            <ul class="list-group">
              <?php foreach ($cart->getCartItems() as $product) { ?>
                <li class="list-group-item">
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="font-weight-bold"><?= $product["name"] ?></p>
                    </div>
                    <div class="col-md-3">
                      <?= round($product["price"], 2) ?>&#36;
                    </div>
                    <div class="col-sm-1">
                      <?= $product["quantity"] ?>
                    </div>
                    <div class="col-sm-1">
                      <?= round($cart->getProductPrice($product["name"]), 2) ?>&#36;
                    </div>
                    <div class="col-sm-4">
                      <a class="btn btn-danger" href="<?= "http://" . $_SERVER['SERVER_NAME'] . "/?action=remove&product=" . $product["name"] ?>" role="button">Remove</a>
                    </div>
                  </div>
                </li>
              <?php } ?>
              <li class="list-group-item">
                <p class="font-weight-bold">Total: <?= round($cart->getTotal(), 2) ?>&#36;
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <nav class="navbar fixed-bottom navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Sylvain Guillard</a>
    </nav>
  </div>
</body>

</html>