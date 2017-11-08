call _files/base.cmd

echo.
echo *----------------=====-----------------*
echo           Fill Data To Template
echo *----------------=====-----------------*
echo.

:ASK_PROJECT
call _files/last_project.cmd
call _files/input_project_exists.cmd

:ACTION
echo.
echo "%Project%" is filling...

php _files/fill.php %Project%


:COMPLETE
call _files/messages/complete.cmd


:BYE
call _files/messages/bye.cmd

pause