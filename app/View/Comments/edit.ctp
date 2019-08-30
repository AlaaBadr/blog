<h2>Edit an existing Comment</h2>

<?php
    echo $this->Form->create('Comment');
    echo $this->Form->input('body');
    echo $this->Form->end('Edit Comment');
?>