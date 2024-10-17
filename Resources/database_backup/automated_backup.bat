@echo off

REM Set your MySQL database credentials
set DB_NAME=woods
set DB_USER=root

REM Set the output file path for the backup
set OUTPUT_FILE=C:\xampp\htdocs\woods_v1\Resources\database_backup\woods_backup.sql

REM Create the backup using mysqldump (no password required)
"C:\xampp\mysql\bin\mysqldump" -u %DB_USER% %DB_NAME% > %OUTPUT_FILE%

REM Check if the backup was successful
if %ERRORLEVEL% neq 0 (
    echo Backup failed!
    exit /b 1
) else (
    echo Backup successful!
)

REM Notify that the process is complete
echo Backup complete!
pause
