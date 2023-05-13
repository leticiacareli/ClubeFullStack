<?php

use app\database\models\Product;

require '../vendor/autoload.php';

$product = new Product;
$products = $product->all('id, description, size, color, price, image');
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/129f2f5269.js" crossorigin="anonymous"></script>
  </head>
  <body>

  <section class="h-100" style="background-color: #eee;">

  <div class="container h-100 py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">

      <!-- header   -->
      <div class="d-flex justify-content-between align-items-center mb-4">

          <h3 class="fw-normal mb-0 text-black">Shopping Cart</h3>

          <div>
            <p class="mb-0">
              <span class="text-muted">Sort by:</span> 
              <a href="#!" class="text-body">price 
                <i class="fas fa-angle-down mt-1"></i>
              </a>
            </p>
          </div>
        </div>

        <!-- card -->
        <?php foreach ($products as $product) : ?>
        <div class="card rounded-3 mb-4 products-list" data-product='<?php echo $product->toJson(['id', 'description', 'price']) ?>'>
          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
              <div class="col-md-2 col-lg-2 col-xl-2">
                <img
                  src="<?php echo $product->image?>"
                  class="img-fluid rounded-3" alt="Cotton T-shirt">
              </div>

              <div class="col-md-3 col-lg-3 col-xl-2">
                <p class="lead fw-normal mb-2"><?php echo $product->description ?></p>
                <p>
                  <span class="text-muted">Size: </span><?php echo $product->size?>
                  <span class="text-muted">Color: </span><?php echo $product->color?>
                </p>
              </div>

              <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                <h5 class="mb-0">R$ <?php echo number_format($product->price, 2, ',', '.')?></h5>
              </div>

              <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                <button class="btn btn-link px-2 btn-remove" data-product='<?php echo $product->toJson(['id', 'description', 'price']) ?>'>
                  <i class="fas fa-minus"></i>
                </button>

                <h5 class="mb-0 product-in-cart<?php echo $product->id?>">0</h5>

                <button class="btn btn-link px-2 btn-add" data-product='<?php echo $product->toJson(['id', 'description', 'price']) ?>'>
                  <i class="fas fa-plus"></i>
                </button>
              </div>

              <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                
                <h5 class="mb-0 product-price-in-cart<?php echo $product->id?>">0</h5>
              </div>

            </div>
          </div>
        </div>
        <?php endforeach ?>

        <div class="card rounded-3 mb-4">
          <div class="card-body p-4">
            <div class="float-end">
              <p class="mb-0 me-5 d-flex align-items-center">
                <div>
                  <span class="small text-muted me-2">Products in cart:</span>
                  <span id="totalQuantity" class="lead fw-normal">0</span>
                </div>

                <div>
                  <span class="small text-muted me-2">Order total:</span>
                  <span id="totalPrice" class="lead fw-normal">0</span>
                </div>
              </p>
            </div>
            <button id="btn-clear-cart" class="btn btn-danger">
              <i class="fas fa-trash"></i>
              Clear Cart
            </button>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="module" src="./assets/js/main.js"></script>
  </body>
</html>