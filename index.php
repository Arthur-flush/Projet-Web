<?php
ini_set("display_errors", "on");
$conn = new mysqli("127.0.0.1", "ProjetWeb", "scam.com", "ProjetWeb");
if(! $conn ) {
    die('Could not connect to db');
}
//echo 'Connected successfully';
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ARTCHAD - NFT Markeplace</title>

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/style.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body id="top">

  <!-- 
    - #HEADER
  -->

  <header>

    <div class="container">

      <a href="#" class="logo">
        <img src="./assets/images/logo.png" alt="NAFT logo">
      </a>

      <div class="header-right">

        <div class="header-nav-wrapper">

          <button class="navbar-toggle-btn" data-navbar-toggle-btn>
            <ion-icon name="menu-outline"></ion-icon>
          </button>

          <nav class="navbar" data-navbar>

            <ul class="navbar-list">

              <li>
                <a href="#" class="navbar-link">Home</a>
              </li>

              <li>
                <a href="#" class="navbar-link">About</a>
              </li>

              <li>
                <a href="#" class="navbar-link">Explore</a>
              </li>

              <li>
                <a href="#" class="navbar-link">Creators</a>
              </li>
              <li>
                <a href="#" class="navbar-link">Contact</a>
              </li>

            </ul>

          </nav>

        </div>

        <div class="header-actions">
          <input type="search" placeholder="Search" class="search-field">

          <button class="btn btn-primary">Sign in</button>
        </div>

      </div>

    </div>

  </header>





  <main>

    <article>

      <!-- 
        - #HERO
      -->

      <section class="hero">
        <div class="container">

          <div class="hero-content">

            <h1 class="h1 hero-title">Discover digital art sell your specific <span>NFT</span></h1>

            <p class="hero-text">
              Partner with one of the world’s largest retailers to showcase your brand and products.
            </p>

            <div class="btn-group">
              <button class="btn btn-primary">Explore more</button>

              <button class="btn btn-secondary">Create now</button>
            </div>

          </div>

          <figure class="hero-banner">
            <img src="./assets/images/hero-banner.jpg" alt="nft art">
          </figure>

        </div>
      </section>





      <!-- 
        - #NEW PRODUCT
      -->

      <section class="new-product">
        <div class="container">

          <div class="section-header-wrapper">

            <h2 class="h2 section-title">Newest Items</h2>

            <button class="btn btn-primary">View all</button>

          </div>

          <ul class="product-list">

            <li class="product-item">

              <div class="product-card" tabindex="0">

                <figure class="product-banner">

                  <img src="./assets/images/kil.png" alt="kil">

                  <div class="product-actions">
                    <button class="product-card-menu">
                      <ion-icon name="ellipsis-horizontal"></ion-icon>
                    </button>

                    <button class="add-to-whishlist" data-whishlist-btn>
                      <ion-icon name="heart"></ion-icon>
                    </button>
                  </div>

                  <button class="place-bid-btn">Place bid</button>

                </figure>

                <div class="product-content">

                  <a href="#" class="h4 product-title">killian diot le roi</a>

                  <div class="product-meta">

                    <div class="product-author">

                      <figure class="author-img">
                        <img src="./assets/images/bidding-user.png" alt="Jack Reacher">
                      </figure>

                      <div class="author-content">
                        <h4 class="h5 author-title">Jack R</h4>

                        <a href="#" class="author-username">@jackr</a>
                      </div>

                    </div>

                    <div class="product-price">
                      <data value="0.568">0.568ETH</data>

                      <p class="label">Current Bid</p>
                    </div>

                  </div>

                  <div class="product-footer">
                    <p class="total-bid"> Place Bid.</p>

                    <button class="tag">New</button>
                  </div>

                </div>

              </div>

            </li>

            <li class="product-item">

              <div class="product-card" tabindex="0">

                <figure class="product-banner">

                  <img src="./assets/images/bleuchat.png" alt="arthurblue">

                  <div class="product-actions">
                    <button class="product-card-menu">
                      <ion-icon name="ellipsis-horizontal"></ion-icon>
                    </button>

                    <button class="add-to-whishlist" data-whishlist-btn>
                      <ion-icon name="heart"></ion-icon>
                    </button>
                  </div>

                  <button class="place-bid-btn">Place bid</button>

                </figure>

                <div class="product-content">

                  <a href="#" class="h4 product-title">blue la legende</a>

                  <div class="product-meta">

                    <div class="product-author">

                      <figure class="author-img">
                        <img src="./assets/images/bidding-user.png" alt="Jack Reacher">
                      </figure>

                      <div class="author-content">
                        <h4 class="h5 author-title">Jack R</h4>

                        <a href="#" class="author-username">@jackr</a>
                      </div>

                    </div>

                    <div class="product-price">
                      <data value="0.568">0.568ETH</data>

                      <p class="label">Current Bid</p>
                    </div>

                  </div>

                  <div class="product-footer">
                    <p class="total-bid"> Place Bid.</p>

                    <button class="tag">New</button>
                  </div>

                </div>

              </div>

            </li>

            <li class="product-item">

              <div class="product-card" tabindex="0">

                <figure class="product-banner">

                  <img src="./assets/images/samymusl.png" alt="samy muscler">

                  <div class="product-actions">
                    <button class="product-card-menu">
                      <ion-icon name="ellipsis-horizontal"></ion-icon>
                    </button>

                    <button class="add-to-whishlist" data-whishlist-btn>
                      <ion-icon name="heart"></ion-icon>
                    </button>
                  </div>

                  <button class="place-bid-btn">Place bid</button>

                </figure>

                <div class="product-content">

                  <a href="#" class="h4 product-title">les pyrenee deriere la montagne</a>

                  <div class="product-meta">

                    <div class="product-author">

                      <figure class="author-img">
                        <img src="./assets/images/bidding-user.png" alt="Jack Reacher">
                      </figure>

                      <div class="author-content">
                        <h4 class="h5 author-title">Jack R</h4>

                        <a href="#" class="author-username">@jackr</a>
                      </div>

                    </div>

                    <div class="product-price">
                      <data value="0.568">0.568ETH</data>

                      <p class="label">Current Bid</p>
                    </div>

                  </div>

                  <div class="product-footer">
                    <p class="total-bid"> Place Bid.</p>

                    <button class="tag">New</button>
                  </div>

                </div>

              </div>

            </li>

            <li class="product-item">

              <div class="product-card" tabindex="0">

                <figure class="product-banner">

                  <img src="./assets/images/shawnarchi.jpg" alt="lecourdarchi">

                  <div class="product-actions">
                    <button class="product-card-menu">
                      <ion-icon name="ellipsis-horizontal"></ion-icon>
                    </button>

                    <button class="add-to-whishlist" data-whishlist-btn>
                      <ion-icon name="heart"></ion-icon>
                    </button>
                  </div>

                  <button class="place-bid-btn">Place bid</button>

                </figure>

                <div class="product-content">

                  <a href="#" class="h4 product-title">architecture des ordinateur</a>

                  <div class="product-meta">

                    <div class="product-author">

                      <figure class="author-img">
                        <img src="./assets/images/bidding-user.png" alt="Jack Reacher">
                      </figure>

                      <div class="author-content">
                        <h4 class="h5 author-title">Jack R</h4>

                        <a href="#" class="author-username">@jackr</a>
                      </div>

                    </div>

                    <div class="product-price">
                      <data value="0.568">0.568ETH</data>

                      <p class="label">Current Bid</p>
                    </div>

                  </div>

                  <div class="product-footer">
                    <p class="total-bid"> Place Bid.</p>

                    <button class="tag">New</button>
                  </div>

                </div>

              </div>

            </li>

          </ul>

        </div>
      </section>





      <!-- 
        - #ABOUT
      -->

      <section class="about">
        <div class="container">

          <h2 class="h2 about-title">Create and sell your NFTs</h2>

          <ol class="about-list">

            <li class="about-item">
              <div class="about-card">

                <div class="card-number">01</div>

                <div class="card-icon">
                  <img src="./assets/images/single-create-sell-item-1.png" alt="wallet icon">
                </div>

                <h3 class="h3 about-card-title">Set up Your Wallet</h3>

                <p class="about-card-text">
                  Once you’ve chosen a crypto wallet, the next step is to install it and set up an account. 
                </p>

              </div>
            </li>

            <li class="about-item">
              <div class="about-card">

                <div class="card-number">02</div>

                <div class="card-icon">
                  <img src="./assets/images/single-create-sell-item-2.png" alt="collection icon">
                </div>

                <h3 class="h3 about-card-title">Create Your Collection</h3>

                <p class="about-card-text">
                  So you're a artist and you love to draw, photograph or what ever that the good place for you,
                   Now you can monetize your project.
                </p>

              </div>
            </li>

            <li class="about-item">
              <div class="about-card">

                <div class="card-number">03</div>

                <div class="card-icon">
                  <img src="./assets/images/single-create-sell-item-3.png" alt="folder icon">
                </div>

                <h3 class="h3 about-card-title">Add Your NFT's</h3>

                <p class="about-card-text">
                  Upload your project along with a description to our website and share your art with other artists.
                </p>

              </div>
            </li>

            <li class="about-item">
              <div class="about-card">

                <div class="card-number">04</div>

                <div class="card-icon">
                  <img src="./assets/images/single-create-sell-item-4.png" alt="diamond icon">
                </div>

                <h3 class="h3 about-card-title">Sell Your NFT's</h3>

                <p class="about-card-text">
                    The last step is to put a price on your NFT so other art lovers can add your NFT's 
                    on there collection 
                </p>

              </div>
            </li>

          </ol>

        </div>
      </section>





      <!-- 
        - #EXPLORE PRODUCT
      -->

      <section class="explore-product">
        <div class="container">

          <div class="section-header-wrapper">

            <h2 class="h2 section-title">Explore Product</h2>

            <button class="btn btn-primary">Explore</button>

          </div>

          <ul class="product-list">

            <li class="product-item">

              <div class="product-card" tabindex="0">

                <figure class="product-banner">

                  <img src="./assets/images/explore-product-1.jpg" alt="Dimond riding a blue body art">

                  <div class="product-actions">
                    <button class="product-card-menu">
                      <ion-icon name="ellipsis-horizontal"></ion-icon>
                    </button>

                    <button class="add-to-whishlist" data-whishlist-btn>
                      <ion-icon name="heart"></ion-icon>
                    </button>
                  </div>

                  <button class="place-bid-btn">Place bid</button>

                </figure>

                <div class="product-content">

                  <a href="#" class="h4 product-title">Dimond riding a blue body art</a>

                  <div class="product-meta">

                    <div class="product-author">

                      <figure class="author-img">
                        <img src="./assets/images/bidding-user.png" alt="Jack Reacher">
                      </figure>

                      <div class="author-content">
                        <h4 class="h5 author-title">Jack R</h4>

                        <a href="#" class="author-username">@jackr</a>
                      </div>

                    </div>

                    <div class="product-price">
                      <data value="0.568">0.568ETH</data>

                      <p class="label">Current Bid</p>
                    </div>

                  </div>

                  <div class="product-footer">
                    <p class="total-bid"> Place Bid.</p>

                    <button class="tag">New</button>
                  </div>

                </div>

              </div>

            </li>

            <li class="product-item">

              <div class="product-card" tabindex="0">

                <figure class="product-banner">

                  <img src="./assets/images/explore-product-2.jpg" alt="Dimond riding a blue body art">

                  <div class="product-actions">
                    <button class="product-card-menu">
                      <ion-icon name="ellipsis-horizontal"></ion-icon>
                    </button>

                    <button class="add-to-whishlist" data-whishlist-btn>
                      <ion-icon name="heart"></ion-icon>
                    </button>
                  </div>

                  <button class="place-bid-btn">Place bid</button>

                </figure>

                <div class="product-content">

                  <a href="#" class="h4 product-title">Dimond riding a blue body art</a>

                  <div class="product-meta">

                    <div class="product-author">

                      <figure class="author-img">
                        <img src="./assets/images/bidding-user.png" alt="Jack Reacher">
                      </figure>

                      <div class="author-content">
                        <h4 class="h5 author-title">Jack R</h4>

                        <a href="#" class="author-username">@jackr</a>
                      </div>

                    </div>

                    <div class="product-price">
                      <data value="0.568">0.568ETH</data>

                      <p class="label">Current Bid</p>
                    </div>

                  </div>

                  <div class="product-footer">
                    <p class="total-bid"> Place Bid.</p>

                    <button class="tag">New</button>
                  </div>

                </div>

              </div>

            </li>

            <li class="product-item">

              <div class="product-card" tabindex="0">

                <figure class="product-banner">

                  <img src="./assets/images/explore-product-3.jpg" alt="Dimond riding a blue body art">

                  <div class="product-actions">
                    <button class="product-card-menu">
                      <ion-icon name="ellipsis-horizontal"></ion-icon>
                    </button>

                    <button class="add-to-whishlist" data-whishlist-btn>
                      <ion-icon name="heart"></ion-icon>
                    </button>
                  </div>

                  <button class="place-bid-btn">Place bid</button>

                </figure>

                <div class="product-content">

                  <a href="#" class="h4 product-title">Dimond riding a blue body art</a>

                  <div class="product-meta">

                    <div class="product-author">

                      <figure class="author-img">
                        <img src="./assets/images/bidding-user.png" alt="Jack Reacher">
                      </figure>

                      <div class="author-content">
                        <h4 class="h5 author-title">Jack R</h4>

                        <a href="#" class="author-username">@jackr</a>
                      </div>

                    </div>

                    <div class="product-price">
                      <data value="0.568">0.568ETH</data>

                      <p class="label">Current Bid</p>
                    </div>

                  </div>

                  <div class="product-footer">
                    <p class="total-bid"> Place Bid.</p>

                    <button class="tag">New</button>
                  </div>

                </div>

              </div>

            </li>

            <li class="product-item">

              <div class="product-card" tabindex="0">

                <figure class="product-banner">

                  <img src="./assets/images/explore-product-4.jpg" alt="Dimond riding a blue body art">

                  <div class="product-actions">
                    <button class="product-card-menu">
                      <ion-icon name="ellipsis-horizontal"></ion-icon>
                    </button>

                    <button class="add-to-whishlist" data-whishlist-btn>
                      <ion-icon name="heart"></ion-icon>
                    </button>
                  </div>

                  <button class="place-bid-btn">Place bid</button>

                </figure>

                <div class="product-content">

                  <a href="#" class="h4 product-title">Dimond riding a blue body art</a>

                  <div class="product-meta">

                    <div class="product-author">

                      <figure class="author-img">
                        <img src="./assets/images/bidding-user.png" alt="Jack Reacher">
                      </figure>

                      <div class="author-content">
                        <h4 class="h5 author-title">Jack R</h4>

                        <a href="#" class="author-username">@jackr</a>
                      </div>

                    </div>

                    <div class="product-price">
                      <data value="0.568">0.568ETH</data>

                      <p class="label">Current Bid</p>
                    </div>

                  </div>

                  <div class="product-footer">
                    <p class="total-bid"> Place Bid.</p>

                    <button class="tag">New</button>
                  </div>

                </div>

              </div>

            </li>

            <li class="product-item">

              <div class="product-card" tabindex="0">

                <figure class="product-banner">

                  <img src="./assets/images/explore-product-5.jpg" alt="Dimond riding a blue body art">

                  <div class="product-actions">
                    <button class="product-card-menu">
                      <ion-icon name="ellipsis-horizontal"></ion-icon>
                    </button>

                    <button class="add-to-whishlist" data-whishlist-btn>
                      <ion-icon name="heart"></ion-icon>
                    </button>
                  </div>

                  <button class="place-bid-btn">Place bid</button>

                </figure>

                <div class="product-content">

                  <a href="#" class="h4 product-title">Dimond riding a blue body art</a>

                  <div class="product-meta">

                    <div class="product-author">

                      <figure class="author-img">
                        <img src="./assets/images/bidding-user.png" alt="Jack Reacher">
                      </figure>

                      <div class="author-content">
                        <h4 class="h5 author-title">Jack R</h4>

                        <a href="#" class="author-username">@jackr</a>
                      </div>

                    </div>

                    <div class="product-price">
                      <data value="0.568">0.568ETH</data>

                      <p class="label">Current Bid</p>
                    </div>

                  </div>

                  <div class="product-footer">
                    <p class="total-bid"> Place Bid.</p>

                    <button class="tag">New</button>
                  </div>

                </div>

              </div>

            </li>

            <li class="product-item">

              <div class="product-card" tabindex="0">

                <figure class="product-banner">

                  <img src="./assets/images/explore-product-6.jpg" alt="Dimond riding a blue body art">

                  <div class="product-actions">
                    <button class="product-card-menu">
                      <ion-icon name="ellipsis-horizontal"></ion-icon>
                    </button>

                    <button class="add-to-whishlist" data-whishlist-btn>
                      <ion-icon name="heart"></ion-icon>
                    </button>
                  </div>

                  <button class="place-bid-btn">Place bid</button>

                </figure>

                <div class="product-content">

                  <a href="#" class="h4 product-title">Dimond riding a blue body art</a>

                  <div class="product-meta">

                    <div class="product-author">

                      <figure class="author-img">
                        <img src="./assets/images/bidding-user.png" alt="Jack Reacher">
                      </figure>

                      <div class="author-content">
                        <h4 class="h5 author-title">Jack R</h4>

                        <a href="#" class="author-username">@jackr</a>
                      </div>

                    </div>

                    <div class="product-price">
                      <data value="0.568">0.568ETH</data>

                      <p class="label">Current Bid</p>
                    </div>

                  </div>

                  <div class="product-footer">
                    <p class="total-bid"> Place Bid.</p>

                    <button class="tag">New</button>
                  </div>

                </div>

              </div>

            </li>

            <li class="product-item">

              <div class="product-card" tabindex="0">

                <figure class="product-banner">

                  <img src="./assets/images/explore-product-7.jpg" alt="Dimond riding a blue body art">

                  <div class="product-actions">
                    <button class="product-card-menu">
                      <ion-icon name="ellipsis-horizontal"></ion-icon>
                    </button>

                    <button class="add-to-whishlist" data-whishlist-btn>
                      <ion-icon name="heart"></ion-icon>
                    </button>
                  </div>

                  <button class="place-bid-btn">Place bid</button>

                </figure>

                <div class="product-content">

                  <a href="#" class="h4 product-title">Dimond riding a blue body art</a>

                  <div class="product-meta">

                    <div class="product-author">

                      <figure class="author-img">
                        <img src="./assets/images/bidding-user.png" alt="Jack Reacher">
                      </figure>

                      <div class="author-content">
                        <h4 class="h5 author-title">Jack R</h4>

                        <a href="#" class="author-username">@jackr</a>
                      </div>

                    </div>

                    <div class="product-price">
                      <data value="0.568">0.568ETH</data>

                      <p class="label">Current Bid</p>
                    </div>

                  </div>

                  <div class="product-footer">
                    <p class="total-bid"> Place Bid.</p>

                    <button class="tag">New</button>
                  </div>

                </div>

              </div>

            </li>

            <li class="product-item">

              <div class="product-card" tabindex="0">

                <figure class="product-banner">

                  <img src="./assets/images/explore-product-8.jpg" alt="Dimond riding a blue body art">

                  <div class="product-actions">
                    <button class="product-card-menu">
                      <ion-icon name="ellipsis-horizontal"></ion-icon>
                    </button>

                    <button class="add-to-whishlist" data-whishlist-btn>
                      <ion-icon name="heart"></ion-icon>
                    </button>
                  </div>

                  <button class="place-bid-btn">Place bid</button>

                </figure>

                <div class="product-content">

                  <a href="#" class="h4 product-title">Dimond riding a blue body art</a>

                  <div class="product-meta">

                    <div class="product-author">

                      <figure class="author-img">
                        <img src="./assets/images/bidding-user.png" alt="Jack Reacher">
                      </figure>

                      <div class="author-content">
                        <h4 class="h5 author-title">Jack R</h4>

                        <a href="#" class="author-username">@jackr</a>
                      </div>

                    </div>

                    <div class="product-price">
                      <data value="0.568">0.568ETH</data>

                      <p class="label">Current Bid</p>
                    </div>

                  </div>

                  <div class="product-footer">
                    <p class="total-bid"> Place Bid.</p>

                    <button class="tag">New</button>
                  </div>

                </div>

              </div>

            </li>

          </ul>

        </div>
      </section>





      <!-- 
        - #TOP SELLER
      -->

      <section class="top-seller">
        <div class="container">

          <h2 class="h2 top-seller-title">
            Top seller in <span>1</span> day
            <ion-icon name="chevron-down"></ion-icon>
          </h2>

          <ol class="top-seller-list">

            <li class="top-seller-item">
              <a href="#" class="top-seller-card">

                <div class="card-number">01</div>

                <figure class="card-avatar">
                  <img src="./assets/images/seller-01.png" alt="Brodband">

                  <div class="avatar-badge">
                    <ion-icon name="checkmark-outline"></ion-icon>
                  </div>
                </figure>

                <div class="card-content">
                  <h3 class="h5 card-title">Brodband</h3>

                  <data value="2500000">$2500,000</data>
                </div>

              </a>
            </li>

            <li class="top-seller-item">
              <a href="#" class="top-seller-card">

                <div class="card-number">02</div>

                <figure class="card-avatar">
                  <img src="./assets/images/seller-02.png" alt="Alexander">
                </figure>

                <div class="card-content">
                  <h3 class="h5 card-title">Alexander</h3>

                  <data value="2500000">$2500,000</data>
                </div>

              </a>
            </li>

            <li class="top-seller-item">
              <a href="#" class="top-seller-card">

                <div class="card-number">03</div>

                <figure class="card-avatar">
                  <img src="./assets/images/seller-03.png" alt="William Jeck">
                </figure>

                <div class="card-content">
                  <h3 class="h5 card-title">William Jeck</h3>

                  <data value="2500000">$2500,000</data>
                </div>

              </a>
            </li>

            <li class="top-seller-item">
              <a href="#" class="top-seller-card">

                <div class="card-number">04</div>

                <figure class="card-avatar">
                  <img src="./assets/images/seller-04.png" alt="Henry Jhon">

                  <div class="avatar-badge">
                    <ion-icon name="checkmark-outline"></ion-icon>
                  </div>
                </figure>

                <div class="card-content">
                  <h3 class="h5 card-title">Henry Jhon</h3>

                  <data value="2500000">$2500,000</data>
                </div>

              </a>
            </li>

            <li class="top-seller-item">
              <a href="#" class="top-seller-card">

                <div class="card-number">05</div>

                <figure class="card-avatar">
                  <img src="./assets/images/seller-05.png" alt="James Thomas">

                  <div class="avatar-badge">
                    <ion-icon name="checkmark-outline"></ion-icon>
                  </div>
                </figure>

                <div class="card-content">
                  <h3 class="h5 card-title">James Thomas</h3>

                  <data value="2500000">$2500,000</data>
                </div>

              </a>
            </li>

            <li class="top-seller-item">
              <a href="#" class="top-seller-card">

                <div class="card-number">06</div>

                <figure class="card-avatar">
                  <img src="./assets/images/seller-06.png" alt="Anthony Roy">
                </figure>

                <div class="card-content">
                  <h3 class="h5 card-title">Anthony Roy</h3>

                  <data value="2500000">$2500,000</data>
                </div>

              </a>
            </li>

            <li class="top-seller-item">
              <a href="#" class="top-seller-card">

                <div class="card-number">07</div>

                <figure class="card-avatar">
                  <img src="./assets/images/seller-07.png" alt="Chritopher">
                </figure>

                <div class="card-content">
                  <h3 class="h5 card-title">Chritopher</h3>

                  <data value="2500000">$2500,000</data>
                </div>

              </a>
            </li>

            <li class="top-seller-item">
              <a href="#" class="top-seller-card">

                <div class="card-number">08</div>

                <figure class="card-avatar">
                  <img src="./assets/images/seller-08.png" alt="Elijabeth Ran">
                </figure>

                <div class="card-content">
                  <h3 class="h5 card-title">Elijabeth Ran</h3>

                  <data value="2500000">$2500,000</data>
                </div>

              </a>
            </li>

            <li class="top-seller-item">
              <a href="#" class="top-seller-card">

                <div class="card-number">09</div>

                <figure class="card-avatar">
                  <img src="./assets/images/seller-01.png" alt="Brodband HR">
                </figure>

                <div class="card-content">
                  <h3 class="h5 card-title">Brodband HR</h3>

                  <data value="2500000">$2500,000</data>
                </div>

              </a>
            </li>

            <li class="top-seller-item">
              <a href="#" class="top-seller-card">

                <div class="card-number">10</div>

                <figure class="card-avatar">
                  <img src="./assets/images/seller-02.png" alt="Michel Raw">

                  <div class="avatar-badge">
                    <ion-icon name="checkmark-outline"></ion-icon>
                  </div>
                </figure>

                <div class="card-content">
                  <h3 class="h5 card-title">Michel Raw</h3>

                  <data value="2500000">$2500,000</data>
                </div>

              </a>
            </li>

            <li class="top-seller-item">
              <a href="#" class="top-seller-card">

                <div class="card-number">11</div>

                <figure class="card-avatar">
                  <img src="./assets/images/seller-03.png" alt="Liam Dylan">

                  <div class="avatar-badge">
                    <ion-icon name="checkmark-outline"></ion-icon>
                  </div>
                </figure>

                <div class="card-content">
                  <h3 class="h5 card-title">Liam Dylan</h3>

                  <data value="2500000">$2500,000</data>
                </div>

              </a>
            </li>

            <li class="top-seller-item">
              <a href="#" class="top-seller-card">

                <div class="card-number">12</div>

                <figure class="card-avatar">
                  <img src="./assets/images/seller-04.png" alt="Thomas Jar">
                </figure>

                <div class="card-content">
                  <h3 class="h5 card-title">Thomas Jar</h3>

                  <data value="2500000">$2500,000</data>
                </div>

              </a>
            </li>

          </ol>

        </div>
      </section>

    </article>

  </main>





  <!-- 
    - #FOOTER
  -->

  <footer>

    <div class="footer-top">
      <div class="container">

        <div class="footer-brand">

          <a href="#" class="logo">
            <img src="./assets/images/logo.png" alt="NAFT logo">
          </a>

          <p class="footer-brand-text">
            THE FUTURE IS NOW <br>
            project developed by students of <a href="https://www.univ-perp.fr/"</a>University of Perpignan Via Domitia          </p>

          <h3 class="h4 social-title">Join the community</h3>

          <ul class="social-list">

            <li>
              <a href="https://github.com/Arthur-flush" class="social-link">
                <ion-icon name="logo-github"></ion-icon>
              </a>
            </li>

            <li>
              <a href="https://twitter.com/chadcmoi" class="social-link">
                <ion-icon name="logo-twitter"></ion-icon>
              </a>
            </li>

            <li>
              <a href="https://www.instagram.com/chad_krd/?hl=fr" class="social-link">
                <ion-icon name="logo-instagram"></ion-icon>
              </a>
            </li>

            <li>
              <a href="https://www.youtube.com/user/serviceComUPVD" class="social-link">
                <ion-icon name="logo-youtube"></ion-icon>
              </a>
            </li>

          </ul>

        </div>
      </footer>





  <!--
    - #GO TO TOP
  -->

  <a href="#top" class="go-top" data-go-top>
    <ion-icon name="arrow-up-outline"></ion-icon>
  </a>





  <!-- 
    - custom js link
  -->
  <script src="./assets/js/script.js"></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>