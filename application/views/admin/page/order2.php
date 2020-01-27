<div class="tableDemo">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="showlist" id="table-3">
<thead>
  <tr >
    <td width="122" >Icon</td>
    <td width="425">Title</td>
	 <td width="425">Entity Group</td>
    <td width="122">Status</td>
    <td width="141">Actions</td>  
  </tr>
</thead>
<tbody>  
<?php
if(count($all_data)){
	foreach($all_data as $set_data){
?>

   <tr height="40" id="<?=$d['typeID']?>">
    <td align="center"><input type="checkbox" name="list<?=$d['typeID']?>" /></td>
   <td align="left"><img src="<?=$location?>"   style="max-width:40px; max-height:40px" /></td>
 
	<td align="left"><?=$d['title']?></td>
  
    <td align="left"><?=$d_entitygroup['title']?></td>
    <td align="left">
  </tr>
<?php
	}
}
?>  
</tbody>
</table>
</div>
