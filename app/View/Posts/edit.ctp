<h1>Edit an existing Post</h1>

<?php
    echo $this->Form->create('Post');
    echo $this->Form->input('title');
    echo $this->Form->input('body');
    echo $this->Form->end('Edit Post');
?>