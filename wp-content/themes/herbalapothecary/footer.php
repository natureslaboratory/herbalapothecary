<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package herbalapothecary
 */

?>
</div> <!-- #content -->
<footer class="c-footer">
	<div class="c-footer__top l-restrict">
		<div class="c-footer__herbal">
			<img src="/wp-content/themes/herbalapothecary/images/logo-teal.svg" alt="Herbal Apothecary" loading="lazy">
			<p>
				We offer professionals all the usual practitioner products and services – but with
				a difference. Herbal Apothecary has been in existence for over 30 years and we produce
				one of the largest ranges of practitioner herbal ranges in the UK.
			</p>
		</div>
		<div class="c-footer__accreditations">
			<h2>Accreditations</h2>
			<p>
				We are proud to be a real Living Wage employer with ISO9001:2015 quality management
				systems and organic certification.
			</p>
			<div class="c-footer__accreditations-logos">
				<a rel="noreferrer" href="https://www.livingwage.org.uk/" target="_blank"><img src="/wp-content/uploads/2021/09/living-wage.png" width="106px" height="84px" alt="Living Wage"></a>
				<a href="/quality/" title="High Quality Herbal Products"><img src="/wp-content/uploads/2021/09/cqs.png" alt="CQS" width="72px" height="90px" loading="lazy"></a>
				<a href="/organic/" title="Organic Herbal Products"><img src="/wp-content/uploads/2021/09/euorg.png" alt="euorg" width="138px" height="92px" loading="lazy"></a>
			</div>
		</div>
		<div class="c-footer__info c-footer__column">
			<h2>Company Info</h2>
			<a href="tel:+441947602346">
				+44 (0)1947 602346
			</a>
			<a href="mailto:sales@herbalapothecaryuk.com">
				sales@herbalapothecaryuk.com
			</a>
			<p>
				Unit 3b, Enterprise Way, North Yorkshire, YO22 4NH, United Kingdom
			</p>
		</div>
		<div class="c-footer__social c-footer__column">
			<h2>Social</h2>
			<p>
				Find us on the following social channels
			</p>
			<a href="https://twitter.com/herbalapoth?lang=en" class="c-footer__social-link">
				<i class="fab fa-twitter"></i><span>Twitter</span>
			</a>
			<a href="https://www.facebook.com/herbalapothecaryuk/" class="c-footer__social-link">
				<i class="fab fa-facebook-f"></i><span>Facebook</span>
			</a>
			<a href="https://www.youtube.com/channel/UCAm5dGGrJEPctkyFP7LclDA" class="c-footer__social-link">
				<i class="fab fa-youtube"></i><span>Youtube</span>
			</a>
			<a href="https://instagram.com/herbalapothecaryuk" class="c-footer__social-link">
				<i class="fab fa-instagram"></i><span>Instagram</span>
			</a>
		</div>
	</div> <!-- End .c-footer__top -->
	<div class="c-footer__bottom l-restrict">
		<div class="c-footer__bottom-column c-footer__questions">
			<h2>Climate Positive Workforce</h2>
			<a href="https://ecologi.com/natureslaboratory?r=61af6aa4f9550a84cf8be3d8" target="_blank" rel="noopener noreferrer" title="View our Ecologi profile" style="width:200px;display:inline-block;">  <img alt="We offset our carbon footprint via Ecologi" src="https://api.ecologi.com/badges/cpw/61af6aa4f9550a84cf8be3d8?black=true&landscape=true" style="width:200px;" /></a>
		</div>
		<div class="c-footer__bottom-column c-footer__shipping">
			<h2>Shipping</h2>
			<div class="c-footer__link-list">
				<a href="/customer-service#answer1">Delivery</a>
				<a href="/customer-service#answer3">Returns</a>
				<a href="/customer-service#answer4">Ordering</a>
			</div>
		</div>
		<div class="c-footer__bottom-column c-footer__about">
			<h2>About Us</h2>
			<div class="c-footer__link-list">
				<a href="/about-us">About Us</a>
				<a href="<?= get_post_type_archive_link('post'); ?>">Blog</a>
				<a href="https://sweetcecilys.com/">Natural Skincare</a>
				<a href="https://beevitalpropolis.com/">Propolis</a>
				<a href="https://futurehealthstore.com/">Futurehealth Store</a>
				<a href="https://iprg.info/">IPRG</a>
			</div>
		</div>
		<div class="c-footer__bottom-column c-footer__legal">
			<h2>Legal</h2>
			<div class="c-footer__link-list">
				<a href="/terms-and-conditions">Terms & Conditions</a>
				<a href="/privacy-policy">Privacy Policy</a>
			</div>
			<h2>Questions?</h2>
			<div class="c-footer__link-list">
				<a href="/customer-service">Customer Service</a>
			</div>
		</div>
	</div> <!-- End .c-footer__bottom -->
	<div class="c-footer__copywrite">
		Copyright &copy; 2021 Herbal Apothecary UK. All Rights Reserved
	</div>
</footer>
</div><!-- #page -->

<?php wp_footer(); ?>



<!-- Matomo -->
<script>
  var _paq = window._paq = window._paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="https://analytics.natureslaboratory.co.uk/";
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '1']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Matomo Code -->

<!-- Doofinder script starts here -->
<script type="text/javascript">
var doofinder_script ='//cdn.doofinder.com/media/js/doofinder-fullscreen.7.latest.min.js';
(function(d,t){var f=d.createElement(t),s=d.getElementsByTagName(t)[0];f.async=1;
f.src=('https:'==location.protocol?'https:':'http:')+doofinder_script;
f.setAttribute('charset','utf-8');
s.parentNode.insertBefore(f,s)}(document,'script'));

var dfFullscreenLayers = [{
  "hashid": "201eabcb34a9521e3c8966307432920b",
  "searchParams": {
    "transformer": null
    },   
  "zone": "eu1",
  "display": {
    "lang": "en",
    "initialSearch": true,     
    "templateVars": {
      "topbarLogo": "https://herbalapothecaryuk.com/wp-content/themes/herbalapothecary/images/logo.webp",
      "topbarLogoLink": "/"
    }
  },
  "toggleInput": ".c-search__box.search-text, #page > .c-header > .c-header__inner.l-restrict > .c-search > .c-search__box.search-text"
}];
</script>
<!-- Doofinder script ends here -->

<style>
	.df-fullscreen{
		margin-top:0px !important;
	}
</style>

</body>

</html>