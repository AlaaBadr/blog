<h1>Edit an existing Comment</h1>

<?php
    echo $this->Form->create('Comment');
    echo $this->Form->input('body');
    echo $this->Form->end('Edit Comment');
?>