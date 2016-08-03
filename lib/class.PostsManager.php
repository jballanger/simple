<?php
  class PostsManager
  {
    protected $db;

    public function __construct(PDO $db)
    {
      $this->db = $db;
    }

    protected function add(Posts $post)
    {
      $request = $this->db->prepare('INSERT INTO posts(author, title, content, addDate, uppDate) VALUES(:author, :title, :content, NOW(), NOW())');
      $request->bindValue(':title', $post->title());
      $request->bindValue(':author', $post->author());
      $request->bindValue(':content', $post->content());

      $request->execute();
    }

    public function count()
    {
      return $this->db->query('SELECT COUNT(*) FROM posts')->fetchColumn();
    }

    public function delete($id)
    {
      $this->db->exec('DELETE FROM posts WHERE id='.(int) $id);
    }

    public function exists($id)
    {
      return $this->db->query('SELECT COUNT(*) FROM posts WHERE id ='. (int) $id)->fetchColumn();
    }

    public function getList($start = -1, $limit = -1)
    {
      $sql = "SELECT id, title, leadContent, addDate, tags, author FROM posts ORDER BY id DESC";

      if($start != -1 || $limit != -1)
      {
        $sql .= " LIMIT ".(int) $limit." OFFSET ".(int) $start;
      }

      $request = $this->db->query($sql);
      $request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Posts');

      $postsList = $request->fetchAll();

      foreach($postsList as $post)
      {
        $post->setAddDate(new DateTime($post->addDate()));
      }

      $request->closeCursor();

      return $postsList;
    }

    public function getUnique($id)
    {
      $request = $this->db->prepare('SELECT id, author, title, leadContent, content, addDate, uppDate FROM posts WHERE id = :id');
      $request->bindValue(':id', (int) $id, PDO::PARAM_INT);
      $request->execute();

      $request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Posts');

      $post = $request->fetch();

      return $post;
    }

    public function getRandom($i, $nList)
    {
      while($i > 0)
      {
        $n = rand(1, $this->count());
        while(in_array($n, $nList))
        {
          if($this->count() == count($nList))
          {
            return;
          }
          $n = rand(1, $this->count());
        }
        array_push($nList, $n);
        $post = $this->getUnique($n);
        echo "<li><a href='blog.php?id=". $post->id() ."'>". $post->title() ."</a></li>";
        $i--;

        if(count($nList) == 3)
        {
          return $nList;
        }
      }
    }

    public function getSearch($string, $type)
    {
      if($type == "byAuthor")
      {
        $request = $this->db->prepare("SELECT id, title, leadContent, addDate, author, tags FROM posts WHERE author = :string");
        $request->bindValue(':string', $string, PDO::PARAM_STR);
      }
      else
      {
        $request = $this->db->prepare("SELECT id, title, leadContent, addDate, author, tags FROM posts WHERE title LIKE :string OR leadContent LIKE :string OR content LIKE :string");
        $request->bindValue(':string', '%'.$string.'%', PDO::PARAM_STR);
      }

      $request->execute();
      $request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'posts');
      $postsList = $request->fetchAll();

      if(empty($postsList))
      {
        echo "<p class='alert alert-info' style='text-align:center;'>No result found.</p>";
        return;
      }

      foreach($postsList as $post)
      {
        $post->setAddDate(new DateTime($post->addDate()));
      }

      $request->closeCursor();

      return $postsList;
    }

    protected function update(Posts $post)
    {
      $request = $this->db->prepare('UPDATE posts SET author = :author, title = :title, content = :content, uppDate = NOW() WHERE id = :id');

      $request->bindValue(':title', $post->title());
      $request->bindValue(':author', $post->author());
      $request->bindValue(':content', $post->content());
      $request->bindValue(':id', $post->id(), PDO::PARAM_INT);

      $request->execute();
    }
  }
?>