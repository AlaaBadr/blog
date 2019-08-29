<h1>Roles</h1>

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
</tr>
<?php foreach($roles as $role) : ?>
<tr>
    <td><?php echo $role['Role']['id'] ?></td>
    <td><?php echo $role['Role']['name'] ?></td>
</tr>
<?php endforeach; ?>
<?php unset($post); ?>