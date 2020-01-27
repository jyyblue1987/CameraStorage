<link rel="stylesheet" href="assets/plugins/chat/chat_styles.css" type="text/css" />
<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
            <div class="panel-heading">                
                <h4 class="panel-title"><?=$name?></h4>
            </div>
            <div class="panel-body">
            <div class="col-md-12">						                        
				<b><?=$question->name;?></b>
                <hr>                        
				<?=$question->description;?>
					<br>	
				<h3>Answer</h3> 
                    <hr>		
<?php
if(isset($answers)&&!empty($answers)){
?>
<ul class="ad-chats">
<?php
	foreach($answers as $set_answer){
		$user = $this->comman_model->get_by('users',array('id'=>$set_answer->user_id), FALSE, FALSE, true);
		if($user){
?>
<li class="in">
<img src="assets/uploads/profile.jpg" alt="" class="avatar">
<div class="message">
<span class="arrow">
</span>
<a class="name"><?=$user->first_name.' '.$user->last_name;?></a>
<span class="datetime" style="color:#ccc"><?=date('F d, Y',$set_answer->created);?></span>
<span class="body"><?=$set_answer->description?></span>
</div>
</li>
<?php
		}
	}	
?>
</ul>
<?php
}
?>

</ul>
			</div>
			<div style="clear:both"></div>

            </div>
        </div>
        <!-- end panel -->
    </div>

	<!--col-md-12-->

    
    
    

    
    <!--end col-md-12-->
</div>


