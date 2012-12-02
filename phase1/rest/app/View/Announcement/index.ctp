<?php foreach ($students as $student): ?>
<table>
	<tr>
		<th>First Name</th>
                <th>Last Name</th>

	<tr>
		<td><?php echo $student['Student']['fname']; ?></td>
                <td><?php echo $student['Student']['lname']; ?></td>
	</tr>
	<?php endforeach; ?>
	<?php unset($student); ?>
</table>

