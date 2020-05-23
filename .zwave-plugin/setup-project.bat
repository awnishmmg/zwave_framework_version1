@echo off
cls
title zwave Terminal @ awisoft.net 
goto :main

:main
set /p name=Enter your name:
echo FRAMEWORK_NAME=ZWAVE >> .env
echo PUBLISHED_YEAR=2020 >> .env
echo COPYWRITE_TO=awisoft.net >> .env
echo VERSION_X=1.0x >> .env
echo APPLICATION_FOR=%name% >> .env
echo APPLICATION_ID=%RANDOM%8820ASKCHHS%RANDOM% >> .env
echo SUPPORTED_PLATEFORM=WINDOWS >> .env

goto :eof