<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Edit Profile'); ?></legend>
	<?php
	    echo $this->Form->label('Username');
        echo $this->Form->value('User.username')."<br><br>";
		echo $this->Form->input('id');
		echo $this->Form->input('full_name');
		echo $this->Form->input('email');
		echo $this->Form->input('phone_number');
		echo $this->Form->input('role_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('User.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Posts'), array('controller' => 'posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Post'), array('controller' => 'posts', 'action' => 'add')); ?> </li>
	</ul>
</div>
