<h2>Change Password</h2>

<?php
    echo $this->Form->create('User');
    echo $this->Form->input('oldPassword', array('type' => 'password'));
    echo $this->Form->input('newPassword', array('type' => 'password'));
    echo $this->Form->input('passwordConfirmation', array('type' => 'password'));
    echo $this->Form->end('Change Password');
?>