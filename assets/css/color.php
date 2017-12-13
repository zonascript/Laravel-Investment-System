<?php
header ("Content-Type:text/css");
$color = "#ff0000"; // Change your Color Here

function checkhexcolor($color) {
	return preg_match('/^#[a-f0-9]{6}$/i', $color);
}

if( isset( $_GET[ 'color' ] ) AND $_GET[ 'color' ] != '' ) {
	$color = "#" . $_GET[ 'color' ];
}

if( !$color OR !checkhexcolor( $color ) ) {
	$color = "#ff0000";
}

?>



a,
#home-slider .caption h1 span, 
#twitter-carousel .item span, 
#footer .footer-bottom, 
#single-portfolio .close-folio-item:hover, 
.single-table.featured .btn.btn-primary, 
.contact-info ul li a:hover, 
#footer .footer-bottom a  {
  color: <?php echo $color; ?>;
}

.page__title,.title_container h4,.people_choose_us h5,.people_choose_us .choose_category i,
.invest-step__title,.finance_fact_item h6,.latest_news .single_news h3,.finance_fact_item>span
.finance_fact_name span,.news_aside h3

{
color: <?php echo $color; ?> !important;
}
