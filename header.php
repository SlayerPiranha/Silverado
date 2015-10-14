<header>

<div class="header-bgcolor">
<table class="fill-space header-bgcolor" id="header-table">
<tr>

<td class="header-tab-mini noselect"><label for="display-options-menu" class="header-text header-link"><div class="align-left">OPTIONS</div></label>
<input type="checkbox" id="display-options-menu" class="hidden" />
<div class="fill-space" id="options-menu">
<?php if ($page != 'index') { ?><a href="index.php" class="header-text header-link options-menu-text"><div class="options-menu-item">Home</div></a><?php } ?>
<?php if ($page != 'movies') { ?><a href="movies.php" class="header-text header-link options-menu-text"><div class="options-menu-item">Movies</div></a><?php } ?>
<?php if ($page != 'pricing') { ?><a href="pricing.php" class="header-text header-link options-menu-text"><div class="options-menu-item">Pricing</div></a><?php } ?>
<?php if ($page != 'booking') { ?><a href="booking.php" class="header-text header-link options-menu-text"><div class="options-menu-item">Bookings</div></a><?php } ?>
<?php if ($page != 'contact') { ?><a href="contact.php" class="header-text header-link options-menu-text"><div class="options-menu-item">Contact</div></a><?php } ?>
</div>
</td>

<td class="header-tab-shared <?php if ($page == 'index') echo 'header-active'; ?> noselect align-center" id="header-logo">
<a href="index.php" class="header-link"><img src="images/Silverado_Logo.png" id="logo-img"></a>
</td>

<td class="header-tab header-text <?php if ($page == 'movies') echo 'header-active'; ?> noselect"><div class="header-tab-spacing"><a href="movies.php" class="header-link"><div>MOVIES</div></a></div></td>
<td class="header-tab header-text <?php if ($page == 'pricing') echo 'header-active'; ?> noselect"><div class="header-tab-spacing"><a href="pricing.php" class="header-link"><div>PRICING</div></a></div></td>
<td class="header-tab header-text <?php if ($page == 'booking') echo 'header-active'; ?> noselect"><div class="header-tab-spacing"><a href="booking.php" class="header-link"><div>BOOKINGS</div></a></div></td>
<td class="header-tab header-text <?php if ($page == 'contact') echo 'header-active'; ?> noselect"><div class="header-tab-spacing"><a href="contact.php" class="header-link"><div>CONTACT</div></a></div></td>
<td class="header-tab-shared <?php if ($page == 'cart') echo 'header-active'; ?> noselect"><div class="header-tab-spacing"><a href="cart.php" class="header-text header-link"><div>CART</div></a></div></td>

</tr>
</table>
</div>
<div id="header-curve"></div>
</header>