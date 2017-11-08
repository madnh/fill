call common/bat/base.cmd

echo.
echo *----------------=====-----------------*
echo     Extract Profiles From Raw Data
echo *----------------=====-----------------*
echo.

:ASK_PROJECT
call common/bat/input_project_exists.cmd


:ACTION
echo.

SET EXTRACTOR_FILE_NAME=_RawExtractor.php
SET EXTRACTOR_FILE_PATH=%Project%/%EXTRACTOR_FILE_NAME%

IF NOT EXIST %Project%/%EXTRACTOR_FILE_NAME% (
    echo File "%EXTRACTOR_FILE_PATH%" not exists
    echo.
    echo.

    GOTO ASK_PROJECT
)

echo "%Project%" is extracting...
echo.
php "%EXTRACTOR_FILE_PATH%" %Project%


:COMPLETE
call common/bat/messages/complete.cmd


:BYE
call common/bat/messages/bye.cmd

pause