<?php
class CommentsManager
{
	protected $db;

	public function __construct(PDO $db)
	{
		$this->db = $db;
	}

	public function add(Comments $comment)
	{
		$request = $this->db->prepare("INSERT INTO comments(postId, parentId, content, author, addDate) VALUES(:postId, :parentId, :content, :author, NOW())");
		$request->bindValue(':postId', $comment->postId(), PDO::PARAM_INT);
		$request->bindValue(':parentId', $comment->parentId(), PDO::PARAM_INT);
		$request->bindValue(':content', $comment->content());
		$request->bindValue(':author', $comment->author());

		return ($request->execute()) ? header('Location: blog.php?id='. $comment->postId().'&success=1') : header('Location: blog.php?id='. $comment->postId().'&error=1');
	}

	public function delete($id)
	{
		$this->db->exec("DELETE FROM comments WHERE id=". (int) $id);
	}

	public function getComments($postId, $nested, $prevId)
	{
		if($nested)
		{
			$request = $this->db->query("SELECT id, postId, parentId, content, author, addDate FROM comments WHERE postId =". (int) $postId ." AND parentId = ". (int) $prevId);
		}
		else
		{
			$request = $this->db->query("SELECT id, postId, parentId, content, author, addDate FROM comments WHERE postId =". (int) $postId ." AND parentId = 0");
		}

		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Comments');

		$commentsList = $request->fetchAll();

		if(empty($commentsList) && !$nested)
		{
			echo "<h4 class='alert alert-info'>No comment yet, be the first !</h4>";
			return;
		}

		foreach($commentsList as $comment)
		{
			$comment->setAddDate(new Datetime($comment->addDate()));
		}

		$request->closeCursor();

		return $commentsList;
	}
}
?>