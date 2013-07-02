@echo off
:ItemGen
cls
@title Welcome to ItemGen
php "generate.php"
echo -------------------------------------------------------------------------------
set /p choice=Press enter to restart:
goto ItemGen