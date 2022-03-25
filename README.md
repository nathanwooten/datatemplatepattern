For the the original Data Template Pattern example, head on over to the branch labeled "one".

This is a much simplified example that comes with dummy content about how it was built (it's complete) which is presented here below

#Homepage

This site is essentially what's included in every site I build. It is a simple PHP application that runs on Apache. It is a very simple example of what I call the Data Template Pattern. You are worried about only two things here, pulling data from your data source and printing the template with that data included. If you use this basic formula your can but together simple websites relatively easily.

Installation

To install this package, simply download the archive (.zip) from the repository on GitHub and extract the contents into the root folder of your website. Pick a suitable location for the root path of your project on your device. If you are working at home then you may need to create a virtual host to run the site on. Directions for that with WampServer can be found on the Internet. To check to see if your website is working go to the host in your browser address bar. It might be something like me.localhost or www.example.com. If everyting is working, then you should see this article appear in your browser.

Adding Content

To add content simply save your text to a text file (.txt) in the "WRITEPATH". This is the path named "write" just inside the root folder. This is where the application looks for content. Each file is a post or article on your site. The menu includes all files in this folder, so you may want to store development content in a subfolder of the WRITEPATH. For things to work correctly your filenames should be in lowercase with words separated by dashes.

#Application Layout

The application is divided into two main layers, the data and template layers. The data takes a URL (a Uniform Resource Locator, ie example.com/great-page) and converts it to a file path reference, then pulls the content from that file. Because we are working in just one file (php file), and in the global scope, we can simply define our template with the appropriate variables calls to the variables defined above. After that we simply print to the screen and wala, you have a website.

There are a few details I iron out in the PHP file (the index file), some layer related some not. There are also a few defines I lay out right off the bat such as ROOTPATH and WRITEPATH. A website is a static (non-changing) thing (at least at any given moment) but before that consists of a request and a response. The request is for a file(s) and is sent to the Apache server and that returns a response resembling a webpage (probably in HTML). In the PHP, the request part of this application is encapsulated by fetching the path portion of the URL (ie "great-page" in example.com/great-page). The response is the template and printing it to the screen.

The Files

The site is basically two files and your personal content files. The index file (application file and website single entry point), the .htaccess file (which creates the single entry point). To view your website you need a web server to run it on. You have the options of getting an online hosting service or putting a server on your computer. These may sound hard, but it really isn't that tough. I recommend GoDaddy for the first and WampServer for the latter. Please note that GoDaddy is a pay service and that there may be installation requirements when installing WampServer, although these are pretty low hurdles.

The Filesystem

Your website consists of three folders. The first is the root folder of your website (outside of public scope). The other two are folders that reside with the root folder. The first is the "www" folder, where the index file is kept. This is the folder (and subfolders) that the public has access to. The second is the "write" folder, where your keep your content files.

Content

For simplicity, content is stored in flat text files with a .txt extension (plain text). When the user requests a URL/filename, the contents of the file are retrieved and then converted to HTML paragraphs, finally being printed to the screen. You can create your content in any text editor, just remember to save it in the "write" folder and in the .txt file format, and don't forget your filename is in lowercase letters, with words separated by dashes "-",. Note that because we use dashes to separate words, you can not use dashes in the title of your pages (in short you can't have urls like this /my---url, and expect it to work).

The URL

The URL is retrieved from the SERVER global variable, nothing you need to do there, which then essentially functions as the title and filename of the content. The URL is basically a filesystem reference, starting with the base 'www' folder. In some systems, each url points to it's own file, but with single entry point, you only need a much smaller set of files. If you wanted URLs to go directly to files other than the index file, simply remove the .htaccess file (I suggest when moving it you store it somewhere safe). You could then specify urls like this /page.php or somefolder/somepage.php (instead of /title-here).
