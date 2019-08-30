<?php App::import('controller', 'Users'); ?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

/* Add a gray background color with some padding */
body {
  font-family: Arial;
  padding: 20px;
}

/* Card Container */
.card {
  margin: auto;
  width: 60%;
}

/* Create two unequal columns that floats next to each other */
/* Right column */
.rightcolumn {
  float: right;
  width: 25%;
  padding-left: 20px;
}

/* Add a card effect for articles */
.card {
   background-color: white;
   padding: 20px;
   margin-top: 20px;
}

</style>
</head>
<body>
<div class="card">
    <h2>
        <?php echo $this->Html->link(
            $post['Post']['title'],
            array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])
        ); ?>
    </h2>
    <p><?php echo $post['Post']['body']; ?></p>
    <br>
    <h5 class="rightcolumn">
        <?php
            echo "By: ".$post['User']['username']."<br>
            Created: ".$post['Post']['created_at']."<br>
            Updated: ".$post['Post']['updated_at'];
        ?>
    </h5>
    <br><br><br>
    <?php
        if (AuthComponent::user('role_id') == 1 || AuthComponent::user('id') == $post['Post']['user_id']) {
            echo $this->Html->link(
                'Edit',
                array('controller' => 'posts', 'action' => 'edit', $post['Post']['id'])
            )." ";
            echo $this->Form->postLink(
                'Delete',
                array('controller' => 'posts', 'action' => 'delete', $post['Post']['id']),
                array('confirm' => 'Are you sure you want to delete this post?')
            );
        }
    ?>
    <br><br><br>
    <h4>Comments</h4>
    <?php
        echo $this->Html->link(
            'Add a new Comment',
            array('controller' => 'comments', 'action' => 'add', $post['Post']['id'])
        );
    ?>
    <br><br>
    <?php foreach ($post['Comment'] as $comment) : ?>
        <div>
            <?php
                echo $comment['body']."<br><br>";
                $userController = new UsersController;
                $username = $userController->getUsernameById($comment['user_id']);
                echo "By: ".$username."<br>";
                echo "Created: ".$comment['created_at']."<br>";
                echo "Updated: ".$comment['updated_at']."<br><br>";
                if (AuthComponent::user('id') == $comment['user_id']) {
                echo $this->Html->link(
                    'Edit',
                     array('controller' => 'comments', 'action' => 'edit', $comment['id'])
                )." ";
                }
                if (AuthComponent::user('id') == $comment['user_id'] || AuthComponent::user('role_id') == 1) {
                echo $this->Form->postLink(
                    'Delete',
                    array('controller' => 'comments', 'action' => 'delete', $comment['id']),
                    array('confirm' => 'Are you sure you want to delete this Comment?')
                )."<br>";
                }
                echo "------------------------------------------------------";
            ?>
        </div>
    <?php endforeach; ?>
    <?php unset($comment); ?>
</div>
</body>
</html>