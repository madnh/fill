call common/bat/base.cmd

echo.
echo *----------------=====-----------------*
echo           Fill Data To Template
echo *----------------=====-----------------*
echo.

:ASK_PROJECT
call common/bat/last_project.cmd
call common/bat/input_project_exists.cmd

:ACTION
echo.
echo "%Project%" is filling...

php common/php/fill.php %Project%


:BYE
call common/bat/messages/bye.cmd

pause