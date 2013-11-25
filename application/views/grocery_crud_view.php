<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title><?php echo $subject ?></title>
<?php foreach($renderer->css_files as $file): ?>
<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($renderer->js_files as $file): ?>
<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<style type='text/css'>
body
{
	font-family: Arial;
	font-size: 14px;
}
a {
	color: blue;
	text-decoration: none;
	font-size: 14px;
}
a:hover
{
	text-decoration: underline;
}
</style>
</head>
<body>
	<div>
		<?php echo $renderer->output; ?>
	</div>
</body>
</html>
