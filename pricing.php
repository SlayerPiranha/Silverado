<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Silverado Cinema</title>
<link rel="stylesheet" type="text/css" href="css/app.css">
<link rel="stylesheet" type="text/css" href="css/header.css">
<link rel="stylesheet" type="text/css" href="css/content.css">

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="scripts/app.js"></script>
<script src="scripts/pricing.js"></script>
</head>
<body style="height: 100%">
<?php
$page = 'pricing';
include("header.php");
?>


<main class="content-overlay-no-center">

<section class="content-overlay">

<ul class="text-list list-adjust-bottom">
<li class="title-style">Pricing</li>
<li class="caption-style list-item-spacing">Everything at a glance.</li>

<li class="list-item-spacing">
<table class="input-table">

<tr class="select-tab noselect" onclick="focusRow('.pricing-row-mt')">
<td class="align-center" colspan="3"><label class="description-style">Monday ~ Tuesday</label></td>
</tr>

<tr class="select-tab-mini pricing-row-mt">
<td colspan="3" class="align-center">
<label>Standard</label>
</td>
</tr>

<tr class="pricing-row-mt">
<td class="align-left"><label>Adult</label></td>
<td class="align-center" colspan="2" width="100"><label>$12</label></td>
</tr>

<tr class="pricing-row-mt">
<td class="align-left"><label>Concession</label></td>
<td class="align-center" colspan="2"><label>$10</label></td>
</tr>

<tr class="pricing-row-mt">
<td class="align-left"><label>Child</label></td>
<td class="align-center" colspan="2"><label>$8</label></td>
</tr>

<tr class="select-tab-mini pricing-row-mt">
<td colspan="3" class="align-center">
<label>First Class</label>
</td>
</tr>

<tr class="pricing-row-mt">
<td class="align-left"><label>Adult</label></td>
<td class="align-center" colspan="2" width="100"><label>$25</label></td>
</tr>

<tr class="pricing-row-mt">
<td class="align-left"><label>Child</label></td>
<td class="align-center" colspan="2"><label>$20</label></td>
</tr>

<tr class="select-tab-mini pricing-row-mt">
<td colspan="3" class="align-center">
<label>Beanbag</label>
</td>
</tr>

<tr class="pricing-row-mt">
<td colspan="3" class="align-center"><label>$20</label></td>
</tr>


<tr class="select-tab noselect" height="100px" onclick="focusRow('.pricing-row-wf')">
<td class="align-center" colspan="3"><label class="description-style">Wednesday ~ Friday</label></td>
</tr>

<tr class="select-tab-mini pricing-row-wf">
<td colspan="2" class="align-center">
<label>Standard</label>
</td>
<td class="align-center">
<label>1pm</label>
</td>
</tr>

<tr class="pricing-row-wf">
<td class="align-left"><label>Adult</label></td>
<td class="align-center"><label>$18</label></td>
<td class="align-center"><label>$12</label></td>
</tr>

<tr class="pricing-row-wf">
<td class="align-left"><label>Concession</label></td>
<td class="align-center"><label>$15</label></td>
<td class="align-center"><label>$10</label></td>
</tr>

<tr class="pricing-row-wf">
<td class="align-left"><label>Child</label></td>
<td class="align-center"><label>$12</label></td>
<td class="align-center"><label>$8</label></td>
</tr>

<tr class="select-tab-mini pricing-row-wf">
<td colspan="2" class="align-center">
<label>First Class</label>
</td>
<td class="align-center">
<label>1pm</label>
</td>
</tr>

<tr class="pricing-row-wf">
<td class="align-left"><label>Adult</label></td>
<td class="align-center"><label>$30</label></td>
<td class="align-center"><label>$25</label></td>
</tr>

<tr class="pricing-row-wf">
<td class="align-left"><label>Child</label></td>
<td class="align-center"><label>$25</label></td>
<td class="align-center"><label>$20</label></td>
</tr>

<tr class="select-tab-mini pricing-row-wf">
<td colspan="2" class="align-center">
<label>Beanbag</label>
</td>
<td class="align-center">
<label>1pm</label>
</td>
</tr>

<tr class="pricing-row-wf">
<td colspan="2" class="align-center"><label>$30</label></td>
<td class="align-center"><label>$20</label></td>
</tr>

<tr class="select-tab noselect" onclick="focusRow('.pricing-row-ss')">
<td class="align-center" colspan="3"><label class="description-style">Saturday ~ Sunday</label></td>
</tr>

<tr class="select-tab-mini pricing-row-ss">
<td colspan="3" class="align-center">
<label>Standard</label>
</td>
</tr>

<tr class="pricing-row-ss">
<td class="align-left"><label>Adult</label></td>
<td class="align-center" colspan="2" width="100"><label>$18</label></td>
</tr>

<tr class="pricing-row-ss">
<td class="align-left"><label>Concession</label></td>
<td class="align-center" colspan="2"><label>$15</label></td>
</tr>

<tr class="pricing-row-ss">
<td class="align-left"><label>Child</label></td>
<td class="align-center" colspan="2"><label>$12</label></td>
</tr>

<tr class="select-tab-mini pricing-row-ss">
<td colspan="3" class="align-center">
<label>First Class</label>
</td>
</tr>

<tr class="pricing-row-ss">
<td class="align-left"><label>Adult</label></td>
<td class="align-center" colspan="2" width="100"><label>$30</label></td>
</tr>

<tr class="pricing-row-ss">
<td class="align-left"><label>Child</label></td>
<td class="align-center" colspan="2"><label>$25</label></td>
</tr>

<tr class="select-tab-mini pricing-row-ss">
<td colspan="3" class="align-center">
<label>Beanbag</label>
</td>
</tr>

<tr class="pricing-row-ss">
<td colspan="3" class="align-center"><label>$30</label></td>
</tr>

</table>

</li>
</ul>

</section>

</main>
<?php include("footer.php"); ?>
</body>
</html>