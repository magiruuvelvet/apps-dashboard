<?php

require __DIR__ . "/../vendor/autoload.php";

$config = apc_fetch("config");
if (!$config)
{
    $config = json5_decode(file_get_contents("./../config.json5"));
    apc_store("config", $config);
}

$icon_url = $config->icon_url;
$apps = $config->apps;

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $config->title; ?></title>
    <link rel="stylesheet" href="/style.css" type="text/css">
    <link rel="stylesheet" href="/user-style.css" type="text/css">
    <style>
        html, body, #background {
            background-color: <?php echo $config->background_color; ?>;
        }
    </style>
</head>
<body>

<div id="background"></div>

<!-- BEGIN HEADER (unused) -->
<header>
</header>

<!-- BEGIN MAIN -->
<main>
<div class="body-wrapper">

    <!-- search engine, works best with Searx -->
    <?php if ($config->search) { ?>
    <section id="search-bar">
        <form method="get" action="<?php echo $config->search_url; ?>">
        <!-- search query --> <input type="text" placeholder="<?php echo $config->search_placeholder; ?>" name="q" autofocus>
        <!-- categories   --> <input type="hidden" name="categories" value="general">
        <!-- language     --> <input type="hidden" name="lang" value="all">
        <!-- locale       --> <input type="hidden" name="locale" value="<?php echo $config->search_locale; ?>">
        </form>
    </section>
    <?php } ?>

    <!-- applications -->
    <section id="applications">

        <?php

        foreach ($apps as $app)
        {
            if (array_key_exists("break", $app))
            {
                ?><div class="flex-break"></div><?php
            }
            else
            {
                ?>
                <a
                    class="application <?php echo array_key_exists("class", $app) ? $app->class : "" ?>"
                    href="<?php echo $app->url; ?>"
                    target="<?php echo $config->open_in_new_tab ? "_blank" : ""; ?>"
                >

                    <div class="content">
                        <img src="<?php echo $config->icon_url . "/" . $app->icon; ?>">
                        <p><?php echo $app->name; ?></p>
                    </div>

                </a>
                <?php
            }
        }

        ?>

    </section>

</div>
</main>

<!-- BEGIN FOOTER (unused) -->
<footer>
</footer>

</body>
</html>
