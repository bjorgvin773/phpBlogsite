<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo (isset($page_title)) ? $page_title : 'Blogs'; ?></title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/">Bloggalicious</a>
        <div class="ml-auto">
            <ul class="navbar-nav">
                <li class="nav-item <?php echo (isset($page_id) && $page_id == 'add_blog') ? 'active' : ''; ?>">
                    <a class="nav-link" href="/phpVerkefniblogg/add_blog.php">Add a blog</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container py-5">
