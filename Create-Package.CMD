@ECHO OFF

SET PATH=%PATH%;C:\Program Files\WinRAR;C:\Program Files (x86)\WinRAR
WinRAR a -afzip -r -x".git" -x".svn" -x".vscode" -x".gitignore" -x"*.rar" -x"*.zip" -x"*.7z" -x"*.sql" -x"*.http" -x"*.cmd" -x"*.bak" -x"frontend" -x"datas" -x"screenshots" -x"TODO.TXT" -x"LICENSE" -x"README.md" -x"error" "www.zip" *.*