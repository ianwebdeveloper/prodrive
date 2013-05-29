<div class="wrapper">
<h3 class="heading">Users</h3>
<div class="minidashboard">
    	<div class="panelOne">        	<p>Users Count: <strong><?php ''; ?></strong></p>            
        </div>        
  </div>
<div class="toolbar"><a href="<?php echo base_url() . 'master/users/section/addusers'; ?>">Add New User</a></div>
	<div id="view_form">
		<?php if(!empty($users)):?>
		<table  class="regdatagrid">
    	<thead>
        	<tr> 
            	<th>Username</th> 
            	<th>User Type</th>    
            	<th>Fullname</th>
            	<th>Address</th>
            	<th>Status</th>
            	<th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user):?>
        	<tr>
        		<td><?php echo $user->username;?></td>
        		<td><?php echo $user->type;?></td>
        		<td><?php echo ucfirst($user->fname) . ' ' . ucfirst($user->mname[0]) . '. ' . ucfirst($user->lname);?></td>
        		<td><?php echo $user->addr;?></td>
        		<td><?php if($user->status == 1){echo 'Active';}else{echo 'In Active';}?></td>
        		<td><a class="reggrideditbtn" href="<?php echo base_url() . 'master/users/section/editusers/' . $user->u_id;?>">Edit</a>|<a class="reggriddelbtn" href="<?php echo base_url() . 'master/users/section/deleteusers/' . $user->u_id;?>">delete</a></td>
        	</tr>
        <?php endforeach;?>
        </tbody>
        </table>
		<?php else:?>
		<p>No Users</p>
		<?php endif;?>
	</div>
</div>