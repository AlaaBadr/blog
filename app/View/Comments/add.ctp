<h1>Add a new Comment</h1>

<?php
    echo $this->Form->create('Comment');
    echo $this->Form->input('body');
    echo $this->Form->end('Save Comment');
?>