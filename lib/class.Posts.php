<?php
  class Posts
  {
    protected $errors = [],
              $id,
              $author,
              $title,
              $leadContent,
              $content,
              $tags,
              $addDate,
              $uppDate;

    const author_INVALID = 1;
    const title_INVALID = 2;
    const content_INVALID = 3;
    const leadcontent_INVALID = 4;
    const tags_INVALID = 5;

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

    public function isNew()
    {
      return empty($this->id);
    }

    public function isValid()
    {
      return !(empty($this->author) || empty($this->title) || empty($this->content));
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

    public function setTitle($title)
    {
      if(!is_string($title) || empty($title))
      {
        $this->errors[] = self::title_INVALID;
      }
      else
      {
        $this->title = $title;
      }
    }

    public function setLeadContent($leadContent)
    {
      if(!is_string($leadContent) || empty($leadContent))
      {
        $this->errors[] = self::leadcontent_INVALID;
      }
      else
      {
        $this->leadContent = $leadContent;
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

    public function setTags($tags)
    {
      if(!is_string($tags) || empty($tags))
      {
        $this->errors[] = self::tags_INVALID;
      }
      else
      {
        $this->tags = $tags;
      }
    }

    public function setAddDate(Datetime $addDate)
    {
      $this->addDate = $addDate;
    }

    public function setUppDate(Datetime $uppDate)
    {
      $this->uppDate = $uppDate;
    }

    // Getters //

    public function errors()
    {
      return $this->errors;
    }

    public function id()
    {
      return $this->id;
    }

    public function author()
    {
      return $this->author;
    }

    public function title()
    {
      return $this->title;
    }

    public function leadContent()
    {
      return $this->leadContent;
    }

    public function content()
    {
      return $this->content;
    }

    public function tags()
    {
      return $this->tags;
    }

    public function addDate()
    {
      return $this->addDate;
    }

    public function uppDate()
    {
      return $this->uppDate;
    }
  }
?>
