call _files/base.cmd

echo.
echo *----------------=====-----------------*
echo     Extract Profiles From Raw Data
echo *----------------=====-----------------*
echo.

:ASK_PROJECT
call _files/input_project_exists.cmd


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
call _files/messages/complete.cmd


:BYE
call _files/messages/bye.cmd

pause