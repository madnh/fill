call "_files/base.cmd"

echo Fill data to template
echo ------
echo.

:START

SET Project=Sample
SET /P Project="Ten project: [%Project%] "

IF NOT [%Project%] == [] (
    IF NOT EXIST %Project% (
        echo Project "%Project%" is not exists.
        echo.
        GOTO START
    )
)

echo.
echo "%Project%" is filling...

php "_files/fill.php" %Project%


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