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
echo.
echo 2. Create project files...
echo.

xcopy ".\common\base_project" %Project%\

echo.
echo.
echo 3. Create default config...
echo.

xcopy ".\common\default_config.json" %Project%\config.*

echo.


:COMPLETE
call common/bat/messages/complete.cmd


:BYE
call common/bat/messages/bye.cmd

pause