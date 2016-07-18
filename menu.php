<!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Simple</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="blog.php">Blog</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          <?php
            if(!isset($_SESSION['email']))
            {
          ?>
          <form id="signin" class="navbar-form navbar-right" role="form" method="POST" action="login.php">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input id="email" type="email" class="form-control" name="email" value="" placeholder="Email Address">
            </div>
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input id="password" type="password" class="form-control" name="password" value="" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
          </form>
          <?php
            }
            else
            {
            ?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <?php echo $_SESSION['email']; ?>
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#">Home</a></li>
                  <li><a href="#">Users</a></li>
                  <li><a href="#">Logs</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="#">New Ticket</a></li>
                  <li><a href="#">New Blog Post</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="logout.php">Logout</a></li>
                </ul>
              </li>
          <?php
            }
          ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>