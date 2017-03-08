# package-caboose
Client-side widget management for CodeIgniter 3

This is an **example package** at this point, not guaranteed to be
complete or bug-free! I am working on whipping it into shape, but
it is not my highest priority.

To use, copy the source into your project, so that "caboose" ends up inside the 
"third_party" folder of your application.

Then add the package path to your config/.autoload...
    
    $autoload['packages'] = array(APPPATH.'third_party/caboose/');

Configure the package by modifying the settings at the top of libraries/Caboose.
You would only need to do this if adding additional widgets, or if changing
the default CSS & Javascript files loaded.

In your base controller's <code>render()</code> method, set appropriate template
view parameters before invoking the parser on the template file...

    function render() {
        ...

        // integrate any needed CSS framework & components
        $this->data['caboose_styles'] = $this->caboose->styles();
        $this->data['caboose_scripts'] = $this->caboose->scripts();
        $this->data['caboose_trailings'] = $this->caboose->trailings();

        $this->parser->parse(...);
    }

Modify your view template(s) to include the Caboose view parameters in the right place...

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            ...
            {caboose_styles}
        </head>
        <body ...>
            ...
            {caboose_scripts}
            {caboose_trailings}
        </body>
    </html>

If you use any of the formfield helper functions included with Caboose, they will automatically
call the appropriate Caboose library methods.
