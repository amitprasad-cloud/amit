<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
 /* background: #555;*/
}

.content {
  max-width: 600px;
  margin: auto;
  padding: 10px;
}
</style>
</head>
<body>

<div class="content">
    <div>
        <img src="<?=base_url()?>img/EmailGraphics/EmailHeader.jpg">
	</div>

	<p style="text-align: center;"><?=$userguest['firstname']?> <?=$userguest['lastname']?></p>
    <div style="text-align:center;">
    	<img src="<?=base_url()?>img/EmailGraphics/PepsiGraphic.jpg" style="width: 150px;height:150px;padding:5px;"> 
    	 <img src="<?=base_url().$userguest['barcode']?>" style="width:150px;height:150px;padding:5px;">
    </div>
    <?php if(count($freinds)>0){ ?>
     	<p style="text-align: center;color: #591315;"><b>Guest Barcode</b></p>
	    <p style="text-align: center;margin-top: -30px;color: #591315;"><b>________________________________________</b></p>
    <?php if(count($freinds)==1){ ?>
        <div style="text-align:center;">
           <img src="<?=base_url().$freinds['0']['barcode']?>" style="width:150px;height:150px;padding:5px;">
	   </div>
    <?php }else{ ?>
    <?php foreach($freinds as $key=>$arr){ ?>
    <?php if($key%2 == 0){ ?>	
        <div style="text-align:center;">
    <?php } ?>
           <img src="<?=base_url().$arr['barcode']?>" style="width:150px;height:150px;padding:5px;">
    <?php if($key%2 != 0 || $key==(count($freinds)-1) ){ ?>
	    </div>
	<?php } ?>
    <?php } ?>
    <?php } ?>	
    <?php } ?>
    <p style="text-align: center;margin-top: -10px;color: #591315;"><b>________________________________________</b></p>
	<div>
        <img src="<?=base_url()?>img/EmailGraphics/EmailBody1.jpg">
	</div>
	
	<div>
        <img src="<?=base_url()?>img/EmailGraphics/EmailBody2.jpg">
	</div>
	
	<div>
        <img src="<?=base_url()?>img/EmailGraphics/EmailBody3.jpg">
	</div>
	<div>
        <img src="<?=base_url()?>img/EmailGraphics/EmailBody4.jpg">
	</div>
</div>

</body>
</html>
<!-- <html>
<head>
<style>

</style>
</head>
<body >
	<div style="width:200px;">
        <img src="<?=base_url()?>img/EmailGraphics/EmailHeader.jpg">
	</div>
	<p>Swaptik das</p>
	<div style="width:200px;">
		<div style="width:80px;">
           <img src="<?=base_url()?>img/EmailGraphics/Barcode.png">
        </div>
        <div style="width:80px;">
           <img src="<?=base_url()?>img/EmailGraphics/PepsiGraphic.jpg">
        </div>
	</div>
	<p><b>Guest Barcode</b></p>
	<p>___________________________________________</p>
	<div style="width:200px;">
           <img src="<?=base_url()?>img/EmailGraphics/Barcode.png">
	</div>
	<div style="width:200px;">
		<div style="width:80px;">
           <img src="<?=base_url()?>img/EmailGraphics/Barcode.png">
        </div>
        <div style="width:80px;">
           <img src="<?=base_url()?>img/EmailGraphics/PepsiGraphic.jpg">
        </div>
	</div>
	<div style="width:200px;">
        <img src="<?=base_url()?>img/EmailGraphics/EmailBody1.jpg">
	</div>
	
	<div style="width:200px;">
        <img src="<?=base_url()?>img/EmailGraphics/EmailBody2.jpg">
	</div>
	
	<div style="width:200px;">
        <img src="<?=base_url()?>img/EmailGraphics/EmailBody3.jpg">
	</div>
	<div style="width:200px;">
        <img src="<?=base_url()?>img/EmailGraphics/EmailBody4.jpg">
	</div>
</body>
</html>

 -->