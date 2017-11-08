:START

SET Project=Sample

call common/bat/last_project.cmd

SET /P Project="Project name: [%Project%] "

IF NOT [%Project%] == [] (
    IF NOT EXIST %Project% (
        echo Project "%Project%" is not exists.
        echo.
        echo.

        GOTO START
    )
)

echo SET Project=%Project%> "common/bat/last_project.cmd"