<!DOCTYPE html>
<html>
<head>
	<?= $this->Html->charset() ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?= $cakeDescription ?>
	</title>
	<?= $this->Html->meta('icon') ?>
	<?= $this->Html->css('base.css') ?>
	<?= $this->Html->css('cake.css') ?>
</head>
<body>
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<img class="pull-left" src="<?php echo $user->profile_image_url ;?>">
					<p class="pull-right"><?php echo $user->name ; ?></p>
				</div>
			</div>
		</div>
		<p><?php echo $user->screen_name ; ?></p>
		<table>
			<tbody>
				<tr>
					<td>created_at</td>
					<td><?php echo $user->created_at ;?></td>
				</tr>
				<tr>
					<td>favourites_count</td>
					<td><?php echo $user->favourites_count ;?></td>
				</tr>
				<tr>
					<td>friends_count</td>
					<td><?php echo $user->friends_count ;?></td>
				</tr>
				<tr>
					<td>location</td>
					<td><?php echo $user->location ;?></td>
				</tr>
				<tr>
					<td>description</td>
					<td><?php echo $user->description ;?></td>
				</tr>
				<tr>
					<td>profile_img_url</td>
					<td><img src="<?php echo $user->profile_image_url ;?>"></td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>