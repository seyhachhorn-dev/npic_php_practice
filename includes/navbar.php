<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand brand-name" href="<?php echo "/npic-practice/?page=home" ?>">한국드라마</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/npic-practice/?page=login">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Advanture</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Auth
          </a>
          <ul class="dropdown-menu">
            <?php if (empty($user)) { ?>
              <li><a class="dropdown-item"
                  href="/npic-practice/?page=login">Login</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item"
                  href="/npic-practice/?page=register">Register</a></li>
            <?php } else { ?>
              <li><a class="dropdown-item"
                  href="/npic-practice/?page=profile">Prfile</a></li>
              <li><a class="dropdown-item"
                  href="/npic-practice/?page=logout">Logout</a></li>
            <?php } ?>
            <!-- <li><a class="dropdown-item" href="/pages/asd.php">Something else here</a></li> -->
          </ul>

        </li>
      </ul>
      <?php if (!empty($user)) { ?>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      <?php } ?>
    </div>
  </div>
</nav>