
<!-- Content wrapper -->
<div class="wrapper">
	
	<!-- Left navigation -->
    <div class="leftNav">
    	<ul id="menu">
        	<li class="tab1Tab"><a href="#" title="" class="active"><span>Crestline</span></a></li>
            <li class="tab2Tab"><a href="#" title=""><span>Dimension</span></a></li>
            <li class="tab3Tab"><a href="#" title=""><span>Gateway</span></a></li>
            <li class="tab4Tab"><a href="#" title=""><span>Hilton-Managed</span></a></li>
            <li class="tab5Tab"><a href="#" title=""><span>InnVentures</span></a></li>
            <li class="tab6Tab"><a href="#" title=""><span>LBA</span></a></li>
            <li class="tab7Tab"><a href="#" title=""><span>Newport</span></a></li>
            <li class="tab8Tab"><a href="#" title=""><span>Stonebridge</span></a></li>
            <li class="tab9Tab"><a href="#" title=""><span>Tharaldson</span></a></li>
            <li class="tab10Tab"><a href="#" title=""><span>True North</span></a></li>
            <li class="tab11Tab"><a href="#" title=""><span>Vista Host</span></a></li>
            <li class="tab12Tab"><a href="#" title=""><span>Western</span></a></li>
        </ul>
    </div>

    <div class="content">
        <div class="title"><h5>Hotel List</h5></div>
       
        <span id="tab1Tab">
            <?php for($i = 0; $i < count($hotels); $i++):?>
            <?php if($hotels[$i]['mgt_name'] == 'Crestline'): ?>
             <a href="<?php echo site_url('/review/hotel/'.$hotels[$i]['id']);?>"><?php echo $hotels[$i]['hotel_name'];?></a> 
             &nbsp;&nbsp;&nbsp;
             <a href="#" class="deleteHotel" id="<?php echo $hotels[$i]['id'];?>">[Delete Hotel]</a>
             <br />
             <?php endif; ?>
             <?php endfor; ?>
            </span>
            <span id="tab2Tab">
             <?php for($i = 0; $i < count($hotels); $i++):?>
            <?php if($hotels[$i]['mgt_name'] == 'Dimension'): ?>
             <a href="<?php echo site_url('/review/hotel/'.$hotels[$i]['id']);?>"><?php echo $hotels[$i]['hotel_name'];?></a>
             &nbsp;&nbsp;&nbsp;
             <a href="#" class="deleteHotel" id="<?php echo $hotels[$i]['id'];?>">[Delete Hotel]</a>
             <br />
             <?php endif; ?>
             <?php endfor; ?>
            </span>
            <span id="tab3Tab">
             <?php for($i = 0; $i < count($hotels); $i++):?>
            <?php if($hotels[$i]['mgt_name'] == 'Gateway'): ?>
             <a href="<?php echo site_url('/review/hotel/'.$hotels[$i]['id']);?>"><?php echo $hotels[$i]['hotel_name'];?></a>
             &nbsp;&nbsp;&nbsp;
             <a href="#" class="deleteHotel" id="<?php echo $hotels[$i]['id'];?>">[Delete Hotel]</a>
             <br />
             <?php endif; ?>
             <?php endfor; ?>
            </span>
            <span id="tab4Tab">
             <?php for($i = 0; $i < count($hotels); $i++):?>
            <?php if($hotels[$i]['mgt_name'] == 'Hilton-Managed'): ?>
             <a href="<?php echo site_url('/review/hotel/'.$hotels[$i]['id']);?>"><?php echo $hotels[$i]['hotel_name'];?></a>
             &nbsp;&nbsp;&nbsp;
             <a href="#" class="deleteHotel" id="<?php echo $hotels[$i]['id'];?>">[Delete Hotel]</a>
             <br />
             <?php endif; ?>
             <?php endfor; ?>
            </span>
            <span id="tab5Tab">
             <?php for($i = 0; $i < count($hotels); $i++):?>
            <?php if($hotels[$i]['mgt_name'] == 'InnVentures'): ?>
             <a href="<?php echo site_url('/review/hotel/'.$hotels[$i]['id']);?>"><?php echo $hotels[$i]['hotel_name'];?></a>
             &nbsp;&nbsp;&nbsp;
             <a href="#" class="deleteHotel" id="<?php echo $hotels[$i]['id'];?>">[Delete Hotel]</a>
             <br />
             <?php endif; ?>
             <?php endfor; ?>
            </span>
            <span id="tab6Tab">
             <?php for($i = 0; $i < count($hotels); $i++):?>
            <?php if($hotels[$i]['mgt_name'] == 'LBA'): ?>
             <a href="<?php echo site_url('/review/hotel/'.$hotels[$i]['id']);?>"><?php echo $hotels[$i]['hotel_name'];?></a>
             &nbsp;&nbsp;&nbsp;
             <a href="#" class="deleteHotel" id="<?php echo $hotels[$i]['id'];?>">[Delete Hotel]</a>
             <br />
             <?php endif; ?>
             <?php endfor; ?>
            </span>
            <span id="tab7Tab">
             <?php for($i = 0; $i < count($hotels); $i++):?>
            <?php if($hotels[$i]['mgt_name'] == 'Newport'): ?>
             <a href="<?php echo site_url('/review/hotel/'.$hotels[$i]['id']);?>"><?php echo $hotels[$i]['hotel_name'];?></a>
             &nbsp;&nbsp;&nbsp;
             <a href="#" class="deleteHotel" id="<?php echo $hotels[$i]['id'];?>">[Delete Hotel]</a>
             <br />
             <?php endif; ?>
             <?php endfor; ?>
            </span>
            <span id="tab8Tab">
             <?php for($i = 0; $i < count($hotels); $i++):?>
            <?php if($hotels[$i]['mgt_name'] == 'Stonebridge'): ?>
             <a href="<?php echo site_url('/review/hotel/'.$hotels[$i]['id']);?>"><?php echo $hotels[$i]['hotel_name'];?></a>
             &nbsp;&nbsp;&nbsp;
             <a href="#" class="deleteHotel" id="<?php echo $hotels[$i]['id'];?>">[Delete Hotel]</a>
             <br />
             <?php endif; ?>
             <?php endfor; ?>
            </span>
            <span id="tab9Tab">
             <?php for($i = 0; $i < count($hotels); $i++):?>
            <?php if($hotels[$i]['mgt_name'] == 'Tharaldson'): ?>
             <a href="<?php echo site_url('/review/hotel/'.$hotels[$i]['id']);?>"><?php echo $hotels[$i]['hotel_name'];?></a>
             &nbsp;&nbsp;&nbsp;
             <a href="#" class="deleteHotel" id="<?php echo $hotels[$i]['id'];?>">[Delete Hotel]</a>
             <br />
             <?php endif; ?>
             <?php endfor; ?>
            </span>
            <span id="tab10Tab">
             <?php for($i = 0; $i < count($hotels); $i++):?>
            <?php if($hotels[$i]['mgt_name'] == 'True North'): ?>
             <a href="<?php echo site_url('/review/hotel/'.$hotels[$i]['id']);?>"><?php echo $hotels[$i]['hotel_name'];?></a>
             &nbsp;&nbsp;&nbsp;
             <a href="#" class="deleteHotel" id="<?php echo $hotels[$i]['id'];?>">[Delete Hotel]</a>
             <br />
             <?php endif; ?>
             <?php endfor; ?>
            </span>
            <span id="tab11Tab">
             <?php for($i = 0; $i < count($hotels); $i++):?>
            <?php if($hotels[$i]['mgt_name'] == 'Vista Host'): ?>
             <a href="<?php echo site_url('/review/hotel/'.$hotels[$i]['id']);?>"><?php echo $hotels[$i]['hotel_name'];?></a>
             &nbsp;&nbsp;&nbsp;
             <a href="#" class="deleteHotel" id="<?php echo $hotels[$i]['id'];?>">[Delete Hotel]</a>
             <br />
             <?php endif; ?>
             <?php endfor; ?>
            </span>	
            <span id="tab12Tab">
             <?php for($i = 0; $i < count($hotels); $i++):?>
            <?php if($hotels[$i]['mgt_name'] == 'Western'): ?>
             <a href="<?php echo site_url('/review/hotel/'.$hotels[$i]['id']);?>"><?php echo $hotels[$i]['hotel_name'];?></a>
             &nbsp;&nbsp;&nbsp;
             <a href="#" class="deleteHotel" id="<?php echo $hotels[$i]['id'];?>">[Delete Hotel]</a>
             <br />
             <?php endif; ?>
             <?php endfor; ?>
            </span>	
            				
        
        
        <div class="fix"></div>
    </div>       
</div>

<div id="deleteHotel" title="Confirm Deletion">
	<div class="message"></div>
    <div class="id" style="display:none;"></div>
    <div class="name" style="display:none;"></div>
</div>

	
