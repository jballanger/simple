<?php
class Comments
{
  protected $errors = [],
            $id,
            $postId,
            $parentId,
            $author,
            $content,
            $addDate;

  const author_INVALID = 1;
  const content_INVALID = 2;

  public function __construct($values = [])
  {
    if(!empty($values))
    {
      $this->hydrate($values);
    }
  }

  public function hydrate($values)
  {
    foreach($values as $key => $value)
    {
      $method = 'set'.ucfirst($key);

      if(is_callable([$this, $method]))
      {
        $this->$method($value);
      }
    }
  }

  public function isValid()
  {
    return !(empty($this->author) || empty($this->content));
  }

  // Setters //

  public function setId($id)
  {
    $this->id = $id;
  }

  public function setPostId($postId)
  {
    $this->postId = $postId;
  }

  public function setParentId($parentId)
  {
    $this->parentId = $parentId;
  }

  public function setAuthor($author)
  {
    if(!is_string($author) || empty($author))
    {
      $this->errors[] = self::author_INVALID;
    }
    else
    {
      $this->author = $author;
    }
  }

  public function setContent($content)
  {
    if(!is_string($content) || empty($content))
    {
      $this->errors[] = self::content_INVALID;
    }
    else
    {
      $this->content = $content;
    }
  }

  public function setAddDate(Datetime $addDate)
  {
    $this->addDate = $addDate;
  }

  // Getters //

  public function id()
  {
    return $this->id;
  }

  public function postId()
  {
    return $this->postId;
  }

  public function parentId()
  {
    return $this->parentId;
  }

  public function author()
  {
    return $this->author;
  }

  public function content()
  {
    return $this->content;
  }

  public function addDate()
  {
    return $this->addDate;
  }

  public function error()
  {
    return $this->error;
  }
}
?>