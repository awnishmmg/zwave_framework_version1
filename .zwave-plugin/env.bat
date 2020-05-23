@echo off
cls
goto :main
	
:main

cd module/.safe/ && cls && type license.dat
cd ..

pause
exit
goto :eof