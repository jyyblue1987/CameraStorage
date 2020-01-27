<?php $this->load->view('admin/includes/address'); ?>
<div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-search"></i>
                    <span><?php echo $name;?></span>
                </div>               
                <div class="no-move"></div>
            </div>
            <div class="box-content">
<?php
if(isset($view_data)&&!empty($view_data)){
		if(!empty($view_data->image)){
			$image='assets/uploads/users/small/'.$view_data->image;
		}
		else{
			$image= 'assets/uploads/users/profile.jpg';
		}
?>
                            

				<table border="0">
                	<tr height="30">
                    	<td width="100"><strong>ID</strong></td>
                    	<td><?php echo $view_data->id;?></td>
                        <td rowspan="3"><img alt="<?php echo $view_data->username;?>" src="<?php echo $image;?>" class="img-rounded"></td>
                    </tr>
                	<tr height="30">
                    	<td><strong>Username</strong></td>
                    	<td><?php echo $view_data->username;?></td>
                    </tr>
                	<tr height="30">
                    	<td><strong>Email</strong></td>
                    	<td><?php echo $view_data->email;?></td>
                    </tr>
                	<tr height="30">
                    	<td><strong>Created</strong></td>
                    	<td><?php echo date('d-m-Y',$view_data->created);?></td>
                    </tr>
                	
                </table>
<?php
}
?>
                
                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="assets/admin/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    menubar : false
 });
</script>

