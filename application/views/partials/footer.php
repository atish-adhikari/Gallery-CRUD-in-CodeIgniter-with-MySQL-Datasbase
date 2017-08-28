<footer>

<script src="<?php echo base_url()?>application/third_party/libs/js/bootstrap.min.js"></script>

<style>
	@import "http://fonts.googleapis.com/css?family=Roboto:300,400,500,700";

.mt40 { margin-top: 40px; }

.panel { position: relative; overflow: hidden; display: block; border-radius: 0 !important;  }
.panel-default { border-color: #ebedef !important; }
.panel .panel-body { position: relative; padding: 0 !important; overflow: hidden; height: auto; }
.panel .panel-body a { overflow: hidden; }
.panel .panel-body a img { display: block; margin: 0; width: 100%; height: auto; 
    transition: all 0.5s; 
    -moz-transition: all 0.5s; 
    -webkit-transition: all 0.5s; 
    -o-transition: all 0.5s; 
}
.panel .panel-body a.zoom:hover img { transform: scale(1.3); -ms-transform: scale(1.3); -webkit-transform: scale(1.3); -o-transform: scale(1.3); -moz-transform: scale(1.3); }
.panel .panel-body a.zoom span.overlay { position: absolute; top: 0; left: 0; visibility: hidden; height: 100%; width: 100%; background-color: #000; opacity: 0; 
    transition: opacity .25s ease-out;
    -moz-transition: opacity .25s ease-out;
    -webkit-transition: opacity .25s ease-out;
    -o-transition: opacity .25s ease-out;
}     
.panel .panel-body a.zoom:hover span.overlay { display: block; visibility: visible; opacity: 0.55; -moz-opacity: 0.55; -webkit-opacity: 0.55; filter: alpha(opacity=65); -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=65)"; }  
.panel .panel-body a.zoom:hover span.overlay i { position: absolute; top: 45%; left: 0%; width: 100%; font-size: 2.25em; color: #fff !important; text-align: center;
    opacity: 1;
    -moz-opacity: 1;
    -webkit-opacity: 1;
    filter: alpha(opacity=1);    
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=1)";
}
.panel .panel-footer { padding: 8px !important; background-color: #f9f9f9 !important; border-bottom-right-radius: 0 !important; border-bottom-left-radius: 0 !important; }	
.panel .panel-footer h4 { display: inline; font: 400 normal 1.125em "Roboto",Arial,Verdana,sans-serif; color: #34495e margin: 0 !important; padding: 0 !important; }
.panel .panel-footer i.glyphicon { display: inline; font-size: 1.125em; cursor: pointer; }
.panel .panel-footer i.glyphicon-thumbs-up { color: #1abc9c; }
.panel .panel-footer i.glyphicon-thumbs-down { color: #e74c3c; padding-left: 5px; }
.panel .panel-footer div { width: 15px; display: inline; font: 300 normal 1.125em "Roboto",Arial,Verdana,sans-serif; color: #34495e; text-align: center; background-color: transparent !important; border: none !important; }	

.modal-title { font: 400 normal 1.625em "Roboto",Arial,Verdana,sans-serif; }
.modal-footer { font: 400 normal 1.125em "Roboto",Arial,Verdana,sans-serif; } 
</style>

</footer>