<!-- Content wrapper -->
<div class="wrapper">
	
	<!-- Left navigation -->
    <div class="leftNav">
    	<ul id="menu">
        	<li class="tab1Tab"><a href="#" title="" class="active"><span>TripAdvisor Reviews</span></a></li>
            <li class="tab2Tab"><a href="#" title=""><span>Orbitz Reviews</span></a></li>
            <li class="tab3Tab"><a href="#" title=""><span>Priceline Reviews</span></a></li>
            <li class="tab4Tab"><a href="#" title=""><span>Competitor Hotels</span></a></li>
        </ul>
    </div>

    <div class="content">
        <div class="title"><h5><?php echo $metadata['title']; ?> - Hotel Profile</h5></div>
       
        <span id="tab1Tab">
            <?php for($i=0;$i < count($reviews);$i++): ?>
                            <?php if($reviews[$i]['title'] == 'Owner response'):?>
                                <div style="margin-left:10%;">
                                    <h5><a href="<?php echo $reviews[$i]['link'];?>"><?php echo $reviews[$i]['title']; ?></a></h5>
                                    <p><?php echo strftime('%B %d, %Y', strtotime($reviews[$i]['date'])); ?></p>
                                    <p class="rating_<?php echo $reviews[$i]['rating']; ?>"></span>
                                    <p><?php echo $reviews[$i]['description']; ?></p>
                                </div>
                            <hr />
                           <?php else: ?> 
                                <h5><a href="<?php echo $reviews[$i]['link'];?>"><?php echo $reviews[$i]['title']; ?></a></h5>
                                <p><?php echo strftime('%B %d, %Y', strtotime($reviews[$i]['date'])); ?></p>
                                <p class="rating_<?php echo $reviews[$i]['rating']; ?>"></p>
                                <p><?php echo $reviews[$i]['description']; ?></p>
                                <br /><br />
                           <?php endif; ?> 
                        <?php endfor; ?>
            </span>
            <span id="tab2Tab">
           <?php for($c=0; $c < count($orbitz); $c++): ?>
                            <div class="orbit_review_head">
                            	<h5><?php echo $orbitz[$c]['title']; ?></h5>
                                <p class="rating_<?php echo $orbitz[$c]['score'];?>"></p>
                            </div>
                            <p><strong>Reviewer <?php echo strtolower($orbitz[$c]['recommended']);?></strong></p>
                            
                            <p><?php echo strftime('%B %d, %Y', strtotime($orbitz[$c]['date']));?></p>
                            <p><?php echo $orbitz[$c]['summary'];?></p>
                            <br /><br />
                        <?php endfor; ?>
            </span>
            <span id="tab3Tab">
            <?php for ($b=0; $b < count($priceline); $b++):?>
								<h5><?php echo $priceline[$b]['reviewer'];?></h5>
                                
                                <p class="rating_<?php echo $priceline[$b]['review_score']; ?>" ></p>
								<p>Liked: <?php echo $priceline[$b]['review_positive'];?></p>
                             
                                <p>Disliked: <?php echo $priceline[$b]['review_negative'];?></p>
                            	<br /><br />
                                
						<?php endfor; ?>
            </span>
            <span id="tab4Tab">
            <div id="flash2" class="nNote"></div>
            <?php if(!empty($competitors)):?>
                
                	
                	<h3>Competitors:</h3>
                	<?php for($a=0;$a < count($competitors);$a++): ?>
                    	<a href="<?php echo site_url(array('review','hotel', $competitors[$a]['competitor_id']));?>">
                        <?php echo $competitors[$a]['hotel_name']; ?>
                        </a>
                        &nbsp;&nbsp;&nbsp;<a href="#">[Delete Competitor]</a>
                        <br />
                        
                    <?php endfor; ?>
                    
                    <?php else:?>
                    <p>There are no competitor hotels! Add some now!</p>
                     <?php endif; ?>
                    <div class="dualBoxes">
                    	<div class="floatleft w40">
                        
                            Filter: <input type="text" id="box1Filter" class="boxFilter"><button type="button" id="box1Clear" class="dualBtn">x</button><br>
                            <p>All Hotels</p>
                            <select id="box1View" multiple="multiple" class="multiple" style="height:300px;">
                            <?php for ($z=0; $z < count($allHotels); $z++):?>
                            <option value="<?php echo $allHotels[$z]['id'];?>"><?php echo $allHotels[$z]['hotel_name'];?></option>
                            <?php endfor; ?>
                           </select>
                            <br>
                            <span id="box1Counter" class="countLabel">Showing 16 of 16</span>
                            
                            <div class="displayNone"><div class="selector" id="uniform-box1Storage"><span></span><select id="box1Storage" style="display: none; opacity: 0; "></select></div></div>
                        </div>
                            
                        <div class="dualControl">
                            <button id="to2" type="button" class="dualBtn mr5 mb15">&nbsp;&gt;&nbsp;</button>
                            <button id="allTo2" type="button" class="dualBtn">&nbsp;&gt;&gt;&nbsp;</button><br>
                            <button id="to1" type="button" class="dualBtn mr5">&nbsp;&lt;&nbsp;</button>
                            <button id="allTo1" type="button" class="dualBtn">&nbsp;&lt;&lt;&nbsp;</button>
                        </div>
                            
                        <div class="floatright w40">
                        <form id="compForm">
                            Filter: <input type="text" id="box2Filter" class="boxFilter"><button type="button" id="box2Clear" class="dualBtn">x</button><br>
                            <p>Selected Hotels</p>
                            <select id="box2View" multiple="multiple" class="multiple" style="height:300px;" name="selectedHotels"></select><br>
                            <span id="box2Counter" class="countLabel">Showing 0 of 0</span>
                            <input type="hidden" name="hotel_id" value="<?php echo $hotelID;?>"/>
                            <input type="submit" value="Add Competitors" />
                            <div class="displayNone"><div class="selector" id="uniform-box2Storage"><span></span><select id="box2Storage" style="display: none; opacity: 0; "></select></div></div>
                        </div>
					
                    
                    </div>
                    
               </form>
               
            </span>
        
        
        <div class="fix"></div>
    </div>       
</div>






