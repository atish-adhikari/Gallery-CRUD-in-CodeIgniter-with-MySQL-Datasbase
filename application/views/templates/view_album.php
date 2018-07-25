<link rel="stylesheet" href="<?php echo base_url()?>application/third_party/libs/css/bootstrap-responsive.min.css">
<link rel="stylesheet" href="<?php echo base_url()?>application/third_party/libs/css/prettyPhoto.css">

<div class="container gallery">
    <h2 class="page-title"><?php echo isset($record->title)? $record->title : ''?></h2>
    <?php
    if (isset($picturelist) && !empty($picturelist)) {
        foreach($picturelist as $key => $value) { ?>            
                <ul class="thumbnails">
                    <li class="span3">
                            <a class="thumbnail" rel="prettyPhoto[pp_gal]" href="<?php echo base_url().'uploads/gallery/'.$value->image?>" title="<?php echo $value->title?>"><img src="<?php echo base_url().'uploads/gallery/'.$value->image?>" alt="<?php echo $value->title?>" /></a>
                        </li> <!--end thumb -->
                </ul><!--end thumbnails -->
        <?php } 
    } else { ?>
        <h4 class="page-title">Album is empty!</h4>
    <?php  } ?>                   
</div> <!-- /container -->


<script src="<?php echo base_url()?>application/third_party/libs/js/jquery.prettyPhoto.js"></script>
<script>
    $(document).ready(function(){
        $("[rel^='prettyPhoto']").prettyPhoto({
            social_tools: false
        });
    });
</script>
