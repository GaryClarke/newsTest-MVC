<!DOCTYPE html>
<html>
  <head>
    <title>
      <?= isset($title) ? $title : 'My Super Site' ?>
</title>

<meta charset="utf-8" />

<link rel="stylesheet" href="/css/Envision.css" type="text/css" />
</head>

<body>
<div id="wrap">
    <header>
        <h1><a href="/">My Super Site</a></h1>
        <p>Huh? There's nothing here!</p>
    </header>

    <nav>
        <ul>
            <li><a href="/">Welcome</a></li>
            <?php if ($user->isAuthenticated()) { ?>
                <li><a href="/admin/">Admin</a></li>
                <li><a href="/admin/news-insert.html">Add a news item</a></li>
            <?php } ?>
        </ul>
    </nav>

    <div id="content-wrap">
        <section id="main">
            <?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>

            <?= $content ?>
        </section>
    </div>

    <footer></footer>
</div>
</body>
</html>