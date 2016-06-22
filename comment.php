<?php
	require('./lib/autoload.php');

	if(isset($_POST['content']) && isset($_POST['author']) && isset($_GET['postId']) && isset($_GET['parentId']))
	{
		$db = DBFactory::getPDO();
		$commentsManager = new CommentsManager($db);

		$comment = new Comments([
				"postId" => (int) $_GET['postId'],
				"parentId" => (int) $_GET['parentId'],
				"author" => $_POST['author'],
				"content" => nl2br($_POST['content'])
			]);
		$commentsManager->add($comment);
	}
?>