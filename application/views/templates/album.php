<div class="container">
    <section class="row">

    <?php 
    if (isset($albums) && !empty($albums)) {
        foreach($albums as $key => $value) { ?>

            <article class="col-xs-12 col-sm-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <a href="<?php echo base_url().'album/'.$value->id?>" title="<?php echo $value->title?>" class="zoom">
                            <img class="thumb" src="<?php echo base_url().'uploads/gallery/'.$value->featured?>" alt="<?php echo $value->title?>" />
                            <span class="overlay">
                                    <i class="glyphicon glyphicon-picture"></i>
                            </span>
                        </a>
                    </div>
                    <div class="panel-footer">
                        <h4><a href="<?php echo base_url().'album/'.$value->id?>" title="<?php echo $value->title?>"><?php echo $value->title?></a></h4>
                        <span style="float: right">
                            <a class="btn btn-default btn-xs" href="<?php echo base_url().'album/edit/'.$value->id?>" aria-label="Edit">
                              <i class="glyphicon glyphicon-pencil" aria-hidden="true"></i>
                            </a>
                            <a class="btn btn-danger btn-xs" href="<?php echo base_url().'album/deactivate/'.$value->id?>" aria-label="Delete">
                              <i class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                            </a>
                        </span>
                    </div>
                </div>
            </article>
        <?php } 
    } else { ?>   
        <h2 class="page-title">No Albums Found!</h2>
    <?php }?>                                         

</section>
</div>


<script>
// maintain height == width of thumbnail
    var imgWidth = $('.panel-body').width();
    $('.thumb').css({'height':imgWidth+'px'});
</script>
