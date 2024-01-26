<?php
session_start();
include 'connect.php'
?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="home.css">
  </head>
  <body>
    <?php
    $uri = $_SERVER['REQUEST_URI'];
    if ($uri === '/quick_view') {
      $productId = $_GET['id'];
    } elseif ($uri === '/about') {
      include 'about.php';
    } else {
      http_response_code(404);
    }
    ?>
    <div class="background">
      <div class="car2"></div>
      <div class="car"></div>
      <?php include 'user_header.php'?>
      <header class="homepage">
        <div class="firstpage">
          <p class="heading1 text-slide-from-top">WELCOME TO MOST STUNNING</p>
          <h1 class="heading2 slide-from-left">CAR DEALER WEBSITE</h1>
        </div>
      </header>
    </div>
    
    <section class="middle">
      <div class="main">
        <h1 class="short">Why Cruise Wheels ?</h1>
        <div class="ic">
          <div class="gife">
            <img class="icons" src="icons\icon1.gif" alt="GIF 1">
            <div class="captions">Only certified motors</div>
          </div>
          <div class="gife">
            <img  class="icons" src="icons\icon2.gif" alt="GIF 2">
            <div class="captions">7 days free trial</div>
          </div>
          <div class="gife">
            <img class="icons" src="icons\icon3.gif" alt="GIF 3">
            <div class="captions">Free delivery</div>
          </div>
          <div class="gife">
            <img class="icons" src="icons\icon4.gif" alt="GIF 4">
            <div class="captions">Free test drives</div>
          </div>
          <div class="gife">
            <img class="icons" src="icons\icon5.gif" alt="GIF 5">
            <div class="captions">Pre-approval</div>
          </div>
        </div>
      </div>
    </section>
    <div class="recent">
    <div class="blackback">
        <div class="container text-center my-3">
            <h3 class="cour">Check out our recent cars</h3>
            <h1 class="feature" style="font-size: 50px;">FEATURE CAR </h1>
            <div class="row mx-auto my-auto justify-content-center position-relative">
            <button class="carousel-control-prev" type="button" data-bs-target="#recipeCarousel" data-bs-slide="prev" style="position: absolute; left: -7%; top: 50%; transform: translateY(-50%);">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-wrap="true" data-bs-interval="8000">
                    <div class="carousel-inner" role="listbox">
                        <?php
                        $stmt = $conn->prepare("SELECT * FROM `products`");
                        $stmt->execute();
                        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($products as $index => $product) {
                            $activeClass = ($index === 0) ? 'active' : '';
                            $imagePath = $product['image'];
                            ?>
                            <div class="carousel-item <?= $activeClass; ?>">
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-img">
                                            <img src="<?= $imagePath; ?>" class="img-fluid">
                                            <div class="img-overlay"></div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $product['name']; ?></h5>
                                            <p class="card-text"><?= $product['category']; ?></p>
                                            <p class="card-text">₹<?= $product['price']; ?></p>
                                            <a href="quick_view.php?id=<?= $product['id']; ?>" class="buttt">Go somewhere</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <button class="carousel-control-next" type="button" data-bs-target="#recipeCarousel" data-bs-slide="next" style="position: absolute; right: -5%; top: 50%; transform: translateY(-50%);">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
    let items = document.querySelectorAll('.carousel .carousel-item')
    items.forEach((el) => {
      const minPerSlide = 4
      let next = el.nextElementSibling
      for (var i=1; i<minPerSlide; i++) {
        if (!next) {
          next = items[0]
        }
        let cloneChild = next.cloneNode(true)
        el.appendChild(cloneChild.children[0])
        next = next.nextElementSibling
      }
    })
      $(document).ready(function() {
        $('#recipeCarousel').carousel({
            interval: 2000,
            pause: 'hover'
        });
        setInterval(function() {
            $('#recipeCarousel').carousel('next');
        },8000);
    });
    </script>
              
        </body>
        </html>
    </body>
    </html>