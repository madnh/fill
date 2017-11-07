call "_files/base.cmd"

echo Create Profile
echo ------
echo.

:START

SET /P Project="Ten project: "

IF [%Project%] == [] GOTO BYE

IF EXIST %Project% (
    echo Project already exists.
    echo.
    GOTO START
)

echo.
echo 1. Create project folder
mkdir %Project%
echo.

echo 2. Copy project files...
echo.
xcopy "_files\base_project" %Project%\
echo.

echo.
echo ---
echo Complete.
echo ---
echo.

:BYE

echo.
echo Bye~
echo.

pause