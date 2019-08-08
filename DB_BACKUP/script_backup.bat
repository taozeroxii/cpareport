@echo off
For /f "tokens=2-4 delims=/ " %%a in ('date /t') do (set mydate=%%c-%%a-%%b)
For /f "tokens=1-2 delims=/:" %%a in ("%TIME%") do (set mytime=%%a%%b)

SET backupdir=D:\Ampps\www\report\DB_BACKUP
SET mysqluername=report
SET mysqlpassword=report
SET database=cpareportdb
D:\Ampps\mysql\bin\mysqldump.exe -ureport -preport %database% > %backupdir%\%database%_%mydate%_%mytime%.sql
