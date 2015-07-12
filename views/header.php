<!DOCTYPE HTML>
<html lang="bg">
    <head>
        <title>Animal Planet</title>
        <meta charset="utf-8" />
        <meta name="description" content="This is test site developed by Krasimir Kostadinov" />
        <meta name="author" content="Krasimir Kostadinov" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="<?php echo HOST_PATH; ?>/public/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo HOST_PATH; ?>/public/css/style.css">
        <script src="<?php echo HOST_PATH; ?>/public/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo HOST_PATH; ?>/public/js/bootstrap.min.js"></script>
        <script src="<?php echo HOST_PATH; ?>/public/js/main.js"></script>
        <script>
            var host_path = '<?php echo HOST_PATH; ?>';
        </script>
    </head>
    <body>
        <nav role="navigation" class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="container">
                        <div class="row clearfix">
                            <div class="navbar-header">
                                <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                                    <span class="sr-only"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a href="<?php echo HOST_PATH; ?>" class="navbar-brand">Animal Planet</a>
                            </div>
                            <div class="navbar-collapse collapse" id="navbar">
                                <form class="navbar-form navbar-right search-form">
                                    <input type="search" id="search-text" placeholder="Search animal by name" class="form-control">
                                    <button type="submit" id="search-btn" class="btn btn-default">Find</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
