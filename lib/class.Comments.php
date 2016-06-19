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
}
?>