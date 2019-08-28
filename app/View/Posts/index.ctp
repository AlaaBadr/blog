<h1>Posts</h1>

<table>
    <tr>
        <th>Title</th>
        <th>Body</th>
        <th>User ID</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>

    <?php foreach($posts as $post) : ?>
        <tr>
            <td>
                <?php echo $this->HTML->link(
                    $post['Post']['title'],
                    array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])
                ); ?>
            </td>
            <td><?php echo $post['Post']['body']; ?></td>
            <td><?php echo $post['Post']['user_id']; ?></td>
            <td><?php echo $post['Post']['created_at']; ?></td>
            <td><?php echo $post['Post']['updated_at']; ?></td>
            <td>
                <?php echo $this->HTML->link(
                    'Edit',
                    array('controller' => 'posts', 'action' => 'edit', $post['Post']['id'])
                ); ?>
            </td>
            <td>
                <?php echo $this->Form->postLink(
                    'Delete',
                    array('controller' => 'posts', 'action' => 'delete', $post['Post']['id']),
                    array('confirm' => 'Are you sure you want to delete this post?')
                ); ?>
            </td>
        </tr>
    <?php endforeach; ?>

    <?php unset($post); ?>

</table>