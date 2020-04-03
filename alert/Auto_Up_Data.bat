echo EAKTAMP Script Update Data Send : %date%  ****** %time%
timeout /t 3
start /min %0
taskkill /f /im Firefox.exe >nul 2>nul && (
    echo SCRITP was killed
) || (
    echo no process was killed
)
if [%~1] == [] (
    timeout %~1 > NUL
) else (
    timeout 10> NUL
)
echo Wakeup : %time%
Start Firefox.exe  http://localhost/alert/pdf.php
