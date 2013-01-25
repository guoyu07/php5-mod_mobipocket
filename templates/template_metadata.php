<?php
/**
 * template_metadata.php
 * 
 * (c)2013 mrdragonraaar.com
 */
?>
<!-- Cover -->
<?php if ($mobipocket->cover()) { ?>
<img class="mobipocket_cover" itemprop="image" src="data:image/jpg;base64,<?php echo base64_encode($mobipocket->cover()); ?>" />
<?php } ?>
<!-- END Cover -->

<!-- Title -->
<h1 class="mobipocket_title" itemprop="name"><?php echo $mobipocket->title(); ?></h1>
<!-- END Title -->

<!-- Author(s) -->
<h3 class="mobipocket_author">by <span itemprop="author"><?php echo implode('</span>, <span itemprop="author">', $mobipocket->authors()); ?></span></h3>
<!-- END Author(s) -->

<!-- Description -->
<div class="mobipocket_description" itemprop="description"><?php echo $mobipocket->description(); ?></div>
<!-- END Description -->

<!-- Details -->
<div class="mobipocket_details">
<!-- Publisher / Publishing Date -->
<div class="mobipocket_publish">
Published<?php if ($mobipocket->publishing_date()) { ?> <meta itemprop="datePublished" content="<?php echo $mobipocket->publishing_date_str('Y-m-d'); ?>"><?php echo $mobipocket->publishing_date_str(); ?><?php } ?><?php if ($mobipocket->publisher()) { ?> by <span itemprop="publisher"><?php echo $mobipocket->publisher(); ?></span><?php } ?>

</div>
<!-- END Publisher / Publishing Date -->

<!-- ISBN -->
<?php if ($mobipocket->isbn()) { ?>
<div class="mobipocket_data_row">
<div class="mobipocket_data_title">ISBN</div>
<div class="mobipocket_data_item" itemprop="isbn"><?php echo $mobipocket->isbn(); ?></div>
</div>
<?php } ?>
<!-- END ISBN -->

<!-- Subjects -->
<?php if ($mobipocket->subjects()) { ?>
<div class="mobipocket_data_row">
<div class="mobipocket_data_title">subjects</div>
<div class="mobipocket_data_item"><span itemprop="genre"><?php echo implode('</span>, <span itemprop="genre">', $mobipocket->subjects()); ?></span></div>
</div>
<?php } ?>
<!-- END Subjects -->

<!-- Language -->
<?php if ($mobipocket->language()) { ?>
<div class="mobipocket_data_row">
<div class="mobipocket_data_title">language</div>
<div class="mobipocket_data_item" itemprop="language"><?php echo $mobipocket->language(); ?></div>
</div>
<?php } ?>
<!-- END Language -->

<!-- Contributor -->
<?php if ($mobipocket->contributor()) { ?>
<div class="mobipocket_data_row">
<div class="mobipocket_data_title">contributor</div>
<div class="mobipocket_data_item" itemprop="contributor"><?php echo $mobipocket->contributor(); ?></div>
</div>
<?php } ?>
<!-- END Contributor -->

<!-- Creator Software -->
<?php if ($mobipocket->creator_software()) { ?>
<div class="mobipocket_data_row">
<div class="mobipocket_data_title">creator software</div>
<div class="mobipocket_data_item" itemprop="creator"><?php echo $mobipocket->creator_software_str(); ?> <?php echo $mobipocket->creator_major() ? $mobipocket->creator_major() : 0; ?><?php echo $mobipocket->creator_minor() ? '.' . $mobipocket->creator_minor() : '.0'; ?><?php echo $mobipocket->creator_build() ? '.' . $mobipocket->creator_build() : '.0'; ?></div>
</div>
<?php } ?>
<!-- END Creator Software -->
</div>
<!-- END Details -->
