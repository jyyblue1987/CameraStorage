<?php
if(isset($this->data['error_message'])) {
    $msg = $this->data['error_message'];
?>
<div class="alert alert-block alert-danger fade in">
    <button data-dismiss="alert" class="close" type="button"></button>
	<?php echo $msg;?>
</div>
<?php    
}
if(isset($this->data['success_message'])) {
    $msg = $this->data['success_message'];
?>
<div class="alert alert-block alert-success fade in">
    <button data-dismiss="alert" class="close" type="button"></button>
	<?php echo $msg;?>
</div>
<?php    
}
if($this->session->flashdata('success')) {
    $msg = $this->session->flashdata('success');
?>
<div class="alert alert-block alert-success fade in">
    <button data-dismiss="alert" class="close" type="button"></button>
	<?php echo $msg;?>
</div>

<?php    
}
if($this->session->flashdata('error')) {
    $msg = $this->session->flashdata('error');
?>
<div class="alert alert-block alert-danger fade in">
    <button data-dismiss="alert" class="close" type="button"></button>
	<?php echo $msg;?>
</div>
<?php    
}
?>            

