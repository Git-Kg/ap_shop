<?php 
    include("header.php");
?>

    <!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb mb-5">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
                    <h1>Checkout</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.php">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="product_detail.php">Checkout</a>
                    </nav>	
				</div>
			</div>
		</div>
   </section>
    <!-- End Banner Area -->

    <div class="container">
        <div class="row">
        
            <div class="col">
                <div class="order_box">
                    <h2>Your Order</h2>
                    <ul class="list">
                        <li><a href="#">Product <span>Total</span></a></li>
                        <li><a href="#">Fresh Blackberry <span class="middle">x 02</span> <span class="last">$720.00</span></a></li>
                        <li><a href="#">Fresh Tomatoes <span class="middle">x 02</span> <span class="last">$720.00</span></a></li>
                        <li><a href="#">Fresh Brocoli <span class="middle">x 02</span> <span class="last">$720.00</span></a></li>
                    </ul>
                    <ul class="list list_2">
                       
                        <li><a href="#">Total <span>$2210.00</span></a></li>
                    </ul>
                
                    <a class="primary-btn" href="#">Proceed </a>
                </div>
            </div>
        
        </div>

    </div>

<?php 
    include("footer.php");
?>