# Parte 2:  Tarea Automática para Copia de Seguridad de Base de Datos en Windows 10

Este documento describe cómo configurar una tarea automática programada en Windows 10 para realizar una copia de seguridad de una base de datos MySQL utilizando un script batch.

## Contenido

- Creación del script de copia de seguridad
- Programación de la tarea automática con el Programador de tareas de Windows

## Instrucciones

### 1. Crear el script de copia de seguridad

Crea un archivo batch llamado `backup_prueba2.bat` con el siguiente contenido:

```batch
@echo off
setlocal

:: Configuración de la base de datos
set "DB_HOST=localhost"
set "DB_USER=root"
set "DB_PASSWORD=Root1234567890"
set "DB_NAME=prueba2"

:: Configuración de la copia de seguridad
set "BACKUP_DIR=C:\ruta\a\tu\carpeta_de_backup"
set "DATE=%DATE:~-4%%DATE:~3,2%%DATE:~0,2%_%TIME:~0,2%%TIME:~3,2%%TIME:~6,2%"
set "BACKUP_FILE=%BACKUP_DIR%\backup_%DB_NAME%_%DATE%.sql"
set "LOG_FILE=%BACKUP_DIR%\backup_%DB_NAME%_%DATE%.log"

:: Crear directorio de backup si no existe
if not exist "%BACKUP_DIR%" mkdir "%BACKUP_DIR%"

:: Realizar copia de seguridad y redirigir errores a un archivo de log
echo Iniciando backup a las %DATE% %TIME% > "%LOG_FILE%"
"C:\Program Files\MySQL\MySQL Server 8.0\bin\mysqldump.exe" -h %DB_HOST% -u %DB_USER% -p%DB_PASSWORD% %DB_NAME% > "%BACKUP_FILE%" 2>> "%LOG_FILE%"

:: Verificar si el comando mysqldump tuvo éxito
if %ERRORLEVEL% EQU 0 (
    echo Backup realizado con éxito: %BACKUP_FILE% >> "%LOG_FILE%"
) else (
    echo Error al realizar el backup >> "%LOG_FILE%"
    type "%LOG_FILE%"
    exit /b 1
)

endlocal
