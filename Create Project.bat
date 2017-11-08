call common/bat/base.cmd

echo.
echo *----------------=====-----------------*
echo             Create Profile
echo *----------------=====-----------------*
echo.

:ASK_PROJECT
call common/bat/input_project_non_exists.cmd

:ACTION
echo.
echo 1. Create project folder
mkdir %Project%
echo.

echo 2. Copy project files...
echo.

xcopy "common\base_project" %Project%\
xcopy "common\default_config.json" %Project%\config.json

echo.


:COMPLETE
call common/bat/messages/complete.cmd


:BYE
call common/bat/messages/bye.cmd

pause