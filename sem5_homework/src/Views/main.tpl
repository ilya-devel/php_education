<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/assets/css/style.css">
        <title>{{ title }}</title>
    </head>
    <body>
        {% include "header.tpl" %}
        {% include "menu.tpl" %}
        <div class="content">
            {% include content_template_name %}
        </div>

        {% include "footer.tpl" %}
    </body>
</html>