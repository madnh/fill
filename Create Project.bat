call _files/base.cmd

echo.
echo *----------------=====-----------------*
echo             Create Profile
echo *----------------=====-----------------*
echo.

:ASK_PROJECT
call _files/input_project_non_exists.cmd

:ACTION
echo.
echo 1. Create project folder
mkdir %Project%
echo.

echo 2. Copy project files...
echo.
xcopy "_files\base_project" %Project%\
echo.


:COMPLETE
call _files/messages/complete.cmd


:BYE
call _files/messages/bye.cmd

pause