<script>
function get_status1(value){
	//alert(name+' '+id+' '+value);
    $.ajax({
       type: "POST",
       url: "admin/set_lang", /* The country id will be sent to this file */
       data: "lang="+value,
       beforeSend: function () {
//      $("#show_class").html("Loading ...");
        },
       success: function(msg){
		   location.reload();
//		 alert(msg);
       //  $("#show_class").html(msg);
       }
       });
} 
</script>
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft">
<?php
$admin = $this->comman_model->get_data_by_id('admin',array('id'=>$login['admin_id']));
?>                
                <img src="assets/templates/image/logo.png" alt="Logo"  style="float:left;margin-right:20px;margin-top:-12px;" height="50" width="52"/>
<?php /*?>				<span style="font-size:25px;color:#FFF"><?php echo $this->lang->line('balance');?> : <?php echo 'R $'.$admin['balance']; ?></span>
<?php */?>
                </div>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="assets/user/img/img-profile.jpg" alt="Profile Pic" /></div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li><?php echo $this->lang->line('hello');?> Admin</li>
                            <li><a href="admin/password"><?php echo $this->lang->line('change_password');?></a></li>
<?php /*?>                            <li><a href="admin/update_balance"><?php echo $this->lang->line('update_balance');?></a></li>
                            <li><a href="admin/setting"><?php echo $this->lang->line('website_setting');?></a></li><?php */?>

                            <li><a href="admin/logout"><?php echo $this->lang->line('logout');?></a></li>
<?php /*?>                            <li style="margin-left:10px"><select onchange="get_status1(this.value)" style="width:120px;">
                        	<option value=""><?php echo $this->lang->line('select');?></option>
                        	<option value="english"><?php echo $this->lang->line('english');?></option>
                        	<option value="portuguese"><?php echo $this->lang->line('portuguese');?></option>
                        </select></li>
<?php */?>                        </ul>
                        <br />
<!--                        <span class="small grey">Last Login: 3 hours ago</span>-->
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="admin/dashboard"><span><?php echo $this->lang->line('dashboard');?></span></a> </li>
                <!--<li class="ic-form-style"><a href="javascript:"><span>Controls</span></a>
                    <ul>
                        <li><a href="form-controls.html">Forms</a> </li>
                        <li><a href="buttons.html">Buttons</a> </li>
                        <li><a href="form-controls.html">Full Page Example</a> </li>
                        <li><a href="table.html">Page with Sidebar Example</a> </li>
                    </ul>
                </li>-->
                <li class="ic-grid-tables"><a href="front" target="_blank"><span><?php echo $this->lang->line('visit_site');?></span></a></li>
                <li class="ic-form-style"><a href="admin/transaction_history" ><span><?php echo $this->lang->line('');?>Payment Histroy</span></a></li>
<?php /*?>                <li class="ic-form-style"><a href="admin/partner" ><span><?php echo $this->lang->line('');?>Partners Approve</span></a></li>
                <li class="ic-form-style"><a href="admin/girl" ><span><?php echo $this->lang->line('');?>Girls</span></a></li>
                <li class="ic-form-style"><a href="admin/employee" ><span><?php echo $this->lang->line('');?>Employee</span></a></li>
                <li class="ic-form-style"><a href="admin/chat" ><span><?php echo $this->lang->line('');?>Chat</span></a></li>
                <li class="ic-form-style"><a href="admin/dashboard" ><span><?php echo $this->lang->line('');?>Feedback</span></a></li>
                <li class="ic-form-style"><a href="admin/dashboard" ><span><?php echo $this->lang->line('');?>Payments</span></a></li>
                <li class="ic-grid-tables"><a href="admin/admin_manage" target=""><span><?php echo $this->lang->line('manage_roles');?></span></a></li>
                <li class="ic-grid-tables"><a href="admin/ticket" target=""><span><?php echo $this->lang->line('ticket');?></span></a></li>
                <li class="ic-grid-tables"><a href="admin/tax" target=""><span><?php echo $this->lang->line('tax');?></span></a></li>
                <li class="ic-grid-tables"><a href="admin/withdrawal" target=""><span><?php echo $this->lang->line('withdrawal');?></span></a></li>
                <li class="ic-grid-tables"><a href="admin/new_entries" target=""><span><?php echo $this->lang->line('new_entries');?></span></a></li>
                <li class="ic-grid-tables"><a href="admin/propaganda_list" target=""><span><?php echo $this->lang->line('propaganda');?></span></a></li>
                <li class="ic-grid-tables"><a href="admin/message" target=""><span><?php echo $this->lang->line('message');?></span></a></li>
                <li class="ic-grid-tables"><a href="admin/my_backup" target=""><button class="btn btn-blue"><?php echo $this->lang->line('my_backup');?></button></a></li>
<?php */?>
<!--				<li class="ic-charts"><a href="charts.html"><span>Charts & Graphs</span></a></li>
                <li class="ic-grid-tables"><a href="table.html"><span>Data Table</span></a></li>
                <li class="ic-gallery dd"><a href="javascript:"><span>Image Galleries</span></a>
               		 <ul>
                        <li><a href="image-gallery.html">Pretty Photo</a> </li>
                        <li><a href="gallery-with-filter.html">Gallery with Filter</a> </li>
                    </ul>
                </li>
                <li class="ic-notifications"><a href="notifications.html"><span>Notifications</span></a></li>
-->
            </ul>
        </div>
        <div class="clear">
        </div>
