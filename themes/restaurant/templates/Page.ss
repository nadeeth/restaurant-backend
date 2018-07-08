<!DOCTYPE html>
<!--[if !IE]><!-->
<html lang="$ContentLocale">
<!--<![endif]-->
<!--[if IE 6 ]><html lang="$ContentLocale" class="ie ie6"><![endif]-->
<!--[if IE 7 ]><html lang="$ContentLocale" class="ie ie7"><![endif]-->
<!--[if IE 8 ]><html lang="$ContentLocale" class="ie ie8"><![endif]-->
<head>
	<% if not $WebpackDevServer || $Form %>
    	<% base_tag %>
	<% else %>
		<base href = "http://localhost:3000" />
    <% end_if %>
    $MetaTags
</head>
<body>
	<noscript>
		You need to enable JavaScript to run this app.
	</noscript>
	<div id="root"></div>
	$Layout
	<% if not $WebpackDevServer %>
    	
	<% else %>
		<script type="text/javascript" src="http://localhost:3000/static/js/bundle.js"></script>
    <% end_if %>
</body>
</html>
