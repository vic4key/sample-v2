@ECHO OFF

CD /D "%1"
REM SED -ri "s/content=\"(assets\/img\/background.jpg).*\"/content=\"https:\/\/example.com\/\1\"/g" index.html index.html
REM SED -ri "s/(<link rel=\"icon\" type=\"image\/png\" href=\"favicon.png\">)/  \1/g" index.html index.html
MV index.html views\index.html.php