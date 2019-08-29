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

/* Header/Blog Title */
.header {
  padding: 30px;
  font-size: 40px;
  text-align: center;
  background: white;
}

/* Create two unequal columns that floats next to each other */
/* Right column */
.rightcolumn {
  float: right;
  width: 25%;
  padding-left: 20px;
}

/* Create two unequal columns that floats next to each other */
/* Posts Container */
.posts {
  margin: auto;
  width: 60%;
}

/* Fake image */
.fakeimg {
  background-color: #aaa;
  width: 100%;
  padding: 20px;
}

/* Add a card effect for articles */
.card {
   background-color: white;
   padding: 20px;
   margin-top: 20px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 800px) {
  .posts {
    width: 100%;
    padding: 0;
  }
}
</style>
</head>
<body>

<div class="header">
  <h2>dlc. MTG Blog</h2>
</div>



<div class="row">
    <div class="rightcolumn">
        <h4>
        <?php
            if (AuthComponent::user()) {
                echo $this->HTML->link(
                    'Logout',
                    array('controller' => 'users', 'action' => 'logout')
                );
            } else {
                echo $this->HTML->link(
                    'Login',
                    array('controller' => 'users', 'action' => 'login')
                );
            }
        ?>
        </h4>
        <br>
        <h3>
            <?php
                echo $this->HTML->link(
                    'Add a new Post',
                    array('controller' => 'posts', 'action' => 'add')
                );
            ?>
        </h3>

    </div>
    <br>
    <div class="posts">
        <?php foreach($posts as $post) : ?>
            <div class="card">
                <h2>
                    <?php echo $this->HTML->link(
                        $post['Post']['title'],
                        array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])
                    ); ?>
                </h2>
                <p><?php echo $post['Post']['body']; ?></p>
                <br>
                <h5 class="rightcolumn">
                    <?php
                        echo "By: ".$post['Post']['user_id']."<br>
                        Created: ".$post['Post']['created_at']."<br>
                        Updated: ".$post['Post']['updated_at'];
                    ?>
                </h5>
                <br><br><br>
                <?php echo $this->HTML->link(
                    'Edit',
                    array('controller' => 'posts', 'action' => 'edit', $post['Post']['id'])
                ); ?>
                <?php echo $this->Form->postLink(
                    'Delete',
                    array('controller' => 'posts', 'action' => 'delete', $post['Post']['id']),
                    array('confirm' => 'Are you sure you want to delete this post?')
                ); ?>
            </div>
        <?php endforeach; ?>
        <?php unset($post); ?>
  </div>
</div>

</body>
</html>