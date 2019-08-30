<h2>Create a new Post</h2>

<?php
    echo $this->Form->create('Post');
    echo $this->Form->input('title');
    echo $this->Form->input('body');
    echo $this->Form->end('Save Post');
?>