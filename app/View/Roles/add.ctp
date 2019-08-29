<h1>Add a new Role</h1>

<?php
    echo $this->Form->create('Role');
    echo $this->Form->input('name');
    echo $this->Form->end('Save Role');
?>