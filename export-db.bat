@echo off
echo ========================================
echo Export Database ke database_import.sql
echo ========================================
echo.

REM Ganti dengan nama database Anda
set DB_NAME=main
set DB_USER=root
set DB_PASS=

echo Exporting database: %DB_NAME%
echo.

REM Cek apakah mysqldump ada
where mysqldump >nul 2>nul
if %errorlevel% neq 0 (
    echo ERROR: mysqldump tidak ditemukan!
    echo.
    echo Gunakan cara manual via phpMyAdmin:
    echo 1. Buka http://localhost/phpmyadmin
    echo 2. Pilih database: %DB_NAME%
    echo 3. Klik tab Export
    echo 4. Klik Go
    echo 5. Save sebagai database_import.sql
    echo.
    pause
    exit /b 1
)

REM Export database
if "%DB_PASS%"=="" (
    mysqldump -u %DB_USER% %DB_NAME% > database_import.sql
) else (
    mysqldump -u %DB_USER% -p%DB_PASS% %DB_NAME% > database_import.sql
)

if %errorlevel% equ 0 (
    echo.
    echo ========================================
    echo Export BERHASIL!
    echo ========================================
    echo.
    echo File: database_import.sql
    for %%A in (database_import.sql) do echo Size: %%~zA bytes
    echo.
    echo File siap untuk di-upload ke InfinityFree!
    echo.
) else (
    echo.
    echo ERROR: Export gagal!
    echo Cek username/password database di script ini.
    echo.
)

pause
