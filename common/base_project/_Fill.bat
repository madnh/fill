call ../common/bat/base.cmd

echo.
echo *----------------=====-----------------*
echo           Fill Data To Template
echo *----------------=====-----------------*
echo.

:ACTION
echo.

php ../common/php/fill.php


:BYE
call ../common/bat/messages/bye.cmd

pause