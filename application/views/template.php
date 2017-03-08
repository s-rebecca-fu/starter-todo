<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>{pagetitle}</title>
        <meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        
        <link rel="stylesheet" type="text/css" href="/assets/css/default.css"/>
		{caboose_styles}
	</head>
	<body>
        <div class="container">
            <div class="navbar">
                <div class="navbar-inner">
                    {menubar} 
				</div>
            </div>           
            <div id="content">
                <h1>{pagetitle}</h1>
					{alerts}
                {content}
            </div>
            <div id="footer" class="span12">
                Copyright &copy; 2017,  <a href="mailto:someone@somewhere.com">Me</a>.
            </div>
        </div>
        
		{caboose_scripts}
        {caboose_trailings}
	</body>
</html>