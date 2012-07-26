<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
<title>TripReviewer</title>

<link href="<?php echo base_url();?>stylesheets/main.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Cuprum' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Sonsie+One' rel='stylesheet' type='text/css'>

<script src="<?php echo base_url();?>js/jquery-1.4.4.js" type="text/javascript"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script> 

<script type="text/javascript" src="<?php echo base_url();?>js/forms/jquery.dualListBox.js"></script>


<script type="text/javascript" src="<?php echo base_url();?>js/main.js"></script>


</head>

<body>

<!-- Top navigation bar -->
<div id="topNav">
    <div class="fixed">
        <div class="wrapper">
            <div class="welcome"><a href="#" title=""><img src="<?php echo base_url();?>images/userPic.png" alt="" /></a><span>Howdy, Eugene!</span></div>
            <div class="userNav">
                <ul>
                    <li><a href="#" title=""><img src="<?php echo base_url();?>images/icons/topnav/profile.png" alt="" /><span>Profile</span></a></li>
                    <li><a href="#" title=""><img src="<?php echo base_url();?>images/icons/topnav/tasks.png" alt="" /><span>Tasks</span></a></li>
                    <li class="dd"><img src="<?php echo base_url();?>images/icons/topnav/messages.png" alt="" /><span>Messages</span><span class="numberTop">8</span>
                        <ul class="menu_body">
                            <li><a href="#" title="">new message</a></li>
                            <li><a href="#" title="">inbox</a></li>
                            <li><a href="#" title="">outbox</a></li>
                            <li><a href="#" title="">trash</a></li>
                        </ul>
                    </li>
                    <li><a href="#" title=""><img src="<?php echo base_url();?>images/icons/topnav/settings.png" alt="" /><span>Settings</span></a></li>
                    <li><a href="login.html" title=""><img src="<?php echo base_url();?>images/icons/topnav/logout.png" alt="" /><span>Logout</span></a></li>
                </ul>
            </div>
            <div class="fix"></div>
        </div>
    </div>
</div>

<!-- Header -->
<div id="header" class="wrapper">
    <div class="logo"><p class="titleText"><a href="<?php echo site_url('/review'); ?>">TripReviewer</a></p></div>
    <div class="middleNav">
    	<ul>
        	<li class="iMes"><a href="#" title="Add a hotel" id="add"><span>Add a hotel</span></a></li>
            
        </ul>
    </div>
    <div id="addForm" title="Add a new hotel">
     		<form id="hform">
                <div id='flash' class="nNote"></div>
                <label>TripAdvisor URL:</label>
                <input type="text" class="oversize input-text" name="hotel_url" />
                <label>Orbitz URL:</label>
                 <input type="text" class="oversize input-text" name="orbitz_url" />
                 <label>Priceline URL:</label>
                 <input type="text" class="oversize input-text" name="priceline_url" />
                <label>Management Company:</label>
                <select name="management">
                     <option value="0">Unknown</option>
                     <option value="1">Crestline</option>
                     <option value="2">Dimension</option>
                     <option value="3">Gateway</option>
                     <option value="4">Hilton-Managed</option>
                     <option value="5">InnVentures</option>
                     <option value="6">Intermountain</option>
                     <option value="7">LBA</option>
                     <option value="8">Newport</option>
                     <option value="9">Stonebridge</option>
                     <option value="10">Tharaldson</option>
                     <option value="11">True North</option>
                     <option value="12">Vista Host</option>
                     <option value="13">Western</option>   
                 </select>
                 <br />
                 <input type="hidden" name="formAction" value="add" />
                 <input type="submit" value="Add Hotel" class="black button medium" />       
            </form>
    </div>
    <div class="fix"></div>
</div>

