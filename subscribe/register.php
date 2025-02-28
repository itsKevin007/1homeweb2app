<?php
	if (!defined('WEB_ROOT')) {
		header('Location: ../index.php');
		exit;
	}
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Heebo:300,400,500,700,800,900'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
<link rel="stylesheet" href="<?php echo WEB_ROOT; ?>assets/js-sub/style.css">
<link rel="stylesheet" href="<?php echo WEB_ROOT; ?>style/premium-btn.css">

<section id="pricing" class="pos-r">
  <canvas id="canvas" width="1519" height="1018"></canvas>
  <div class="container">
    <div class="row text-center">
      <div class="col-lg-8 col-md-12 ml-auto mr-auto">
        <div class="section-title">
          <div class="title-effect">
            <div class="bar bar-top"></div>
            <div class="bar bar-right"></div>
            <div class="bar bar-bottom"></div>
            <div class="bar bar-left"></div>
          </div>
          <h6>Pricing Plan</h6>
          
        </div>
      </div>
    </div>
    <div class="row align-items-center text-center">
		<div class="col-lg-2 col-md-12">
		</div>
		<?php if($accesslevel == 0){
			?>
			<div class="col-lg-2 col-md-12">
			</div>
			<?php
		}else{ ?>
		<div class="col-lg-4 col-md-12">
			<div class="price-table">
			<div class="price-inside">Basic</div>
			<div class="price-header">
				<div class="price-value">
				<h2><span>P</span>33</h2>
				<span>Annual Package</span>
				</div>
				<h3 class="price-title">Basic</h3> 
			</div>
			<form method="POST" action="fill-up/">
				<input type="hidden" name="plan" value="0">
					<button class="btn btn-theme btn-circle my-4" type="submit" data-text="SUBSCRIBE">S<span>U</span><span>B</span><span>S</span><span>C</span><span>R</span><span>I</span><span>B</span><span>E</span>
					</button>
			</form>
			<div class="price-list">
				<ul class="list-unstyled">
				<li>No Ads</li>
				<li>Special Offer</li>
				</ul>
			</div>
			</div>
		</div>
		<?php } ?>
		<div class="col-lg-4 col-md-12 md-mt-5">
			<div class="price-table">
			<div class="price-inside">Premium</div>
			<div class="price-header">
				<div class="price-value">
				<h2><span>P</span>10k</h2>
				<span>Annual Package</span>
				</div>
				<h3 class="price-title">Premium</h3> 
			</div>
			<br>
			<form method="POST" action="fill-up/">
				<input type="hidden" name="plan" value="1">
					<button class="Btn-gold" type="submit" data-text="Purchase Now">
						<svg viewBox="0 0 576 512" height="1em" class="logoIcon">
						<path d="M309 106c11.4-7 19-19.7 19-34c0-22.1-17.9-40-40-40s-40 17.9-40 40c0 14.4 7.6 27 19 34L209.7 220.6c-9.1 18.2-32.7 23.4-48.6 10.7L72 160c5-6.7 8-15 8-24c0-22.1-17.9-40-40-40S0 113.9 0 136s17.9 40 40 40c.2 0 .5 0 .7 0L86.4 427.4c5.5 30.4 32 52.6 63 52.6H426.6c30.9 0 57.4-22.1 63-52.6L535.3 176c.2 0 .5 0 .7 0c22.1 0 40-17.9 40-40s-17.9-40-40-40s-40 17.9-40 40c0 9 3 17.3 8 24l-89.1 71.3c-15.9 12.7-39.5 7.5-48.6-10.7L309 106z"></path></svg>
						SUBSCRIBE
					</button>
			</form>
			<br>
			<div class="price-list">
				<ul class="list-unstyled">
				<li>No Ads</li>
				<li>Special Offer</li>
				</ul>
			</div>
			</div>
		</div>
	  <div class="col-lg-2 col-md-12">
	</div>
    </div>
  </div>
</section><br>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script><script  src="<?php echo WEB_ROOT; ?>assets/js-sub/script.js"></script>
