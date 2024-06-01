@echo off
setlocal

:: Configuración de la base de datos
set "DB_HOST=localhost"
set "DB_USER=root"
set "DB_PASSWORD=Root1234567890"
set "DB_NAME=prueba2"

:: Configuración de la carpeta de copia de seguridad
set "BACKUP_DIR=C:\carpeta_de_backup"

:backup
:: Obtener la fecha y hora actuales
for /f "tokens=2 delims==" %%I in ('wmic os get localdatetime /value') do set dt=%%I
set "DATE=%dt:~0,4%%dt:~4,2%%dt:~6,2%_%dt:~8,2%%dt:~10,2%%dt:~12,2%"
set "BACKUP_FILE=%BACKUP_DIR%\backup_%DB_NAME%_%DATE%.sql"
set "LOG_FILE=%BACKUP_DIR%\backup_%DB_NAME%_%DATE%.log"

:: Crear directorio de backup si no existe
if not exist "%BACKUP_DIR%" mkdir "%BACKUP_DIR%"

:: Realizar copia de seguridad y redirigir errores a un archivo de log
echo Iniciando backup a las %DATE% %TIME% > "%LOG_FILE%"
"C:\Program Files\MySQL\MySQL Server 8.4\bin\mysqldump.exe" -h %DB_HOST% -u %DB_USER% -p%DB_PASSWORD% %DB_NAME% > "%BACKUP_FILE%" 2>> "%LOG_FILE%"

:: Verificar si el archivo SQL contiene datos
for %%A in ("%BACKUP_FILE%") do (
    if %%~zA EQU 0 (
        echo Error: El archivo de copia de seguridad está vacío.
        msg * Error: La copia de seguridad está vacía. No se ha generado ninguna copia de seguridad.
        exit /b 1
    )
)

:: Notificar al usuario que la copia de seguridad se realizó con éxito
echo Copia de seguridad realizada con éxito: %BACKUP_FILE%
msg * Copia de seguridad realizada con éxito: %BACKUP_FILE%

:: Esperar hasta la próxima copia de seguridad (24 horas)
timeout /t 86400 /nobreak

:: Realizar la copia de seguridad nuevamente
goto backup

endlocal
