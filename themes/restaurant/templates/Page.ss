<!DOCTYPE html>
<!--[if !IE]><!-->
<html lang="$ContentLocale">
<!--<![endif]-->
<!--[if IE 6 ]><html lang="$ContentLocale" class="ie ie6"><![endif]-->
<!--[if IE 7 ]><html lang="$ContentLocale" class="ie ie7"><![endif]-->
<!--[if IE 8 ]><html lang="$ContentLocale" class="ie ie8"><![endif]-->
<head>
    <%-- $MetaTags --%>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name="theme-color" content="#000000">
    <link rel="manifest" href="public/manifest.json">
    <link rel="shortcut icon" href="public/favicon.ico">
    <title>Restaurant App</title>

	<% if not $WebpackDevServer || $Form %>
    	<% base_tag %>
	<% else %>
		<base href = "http://localhost:3000" />
    <% end_if %>
    <% if not $WebpackDevServer %>
        <link href="public/static/css/main.c17080f1.css" rel="stylesheet">
    <% end_if %>
</head>
<body>
	<noscript>
		You need to enable JavaScript to run this app.
	</noscript>
	<div id="root"></div>
	$Layout
	<% if not $WebpackDevServer %>
    	<script type="text/javascript" src="public/static/js/main.a0b7d8d3.js"></script>
	<% else %>
		<script type="text/javascript" src="http://localhost:3000/static/js/bundle.js"></script>
    <% end_if %>
</body>
</html>
