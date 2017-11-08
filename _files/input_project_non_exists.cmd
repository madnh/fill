:START

SET Project=Sample
SET /P Project="Project name: [%Project%] "

IF NOT [%Project%] == [] (
    IF EXIST %Project% (
        echo Project "%Project%" already exists.
        echo.
        echo.

        GOTO START
    )
)
