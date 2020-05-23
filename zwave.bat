@echo off
cls
title zwave project Terminal  

cd module/
:loop
set /p command=Enter Your command:$ 
php manage.php %command%
set /p option=try another command yes or no:$ 
if %option%==no (
	goto exitloop
)
goto loop
:exitloop
cd ..
pause