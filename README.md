### Install

`composer install`

`php artisan key:generate`

`npm install`

`npm run dev`

`php artisan serve`

### Notes


Lol Spectate


REM Generated from http://lolprofile.net.
@ECHO OFF
SETLOCAL
FOR /F "skip=2 tokens=2,*" %%A IN ('reg.exe query "HKEY_CLASSES_ROOT\VirtualStore\MACHINE\SOFTWARE\Wow6432Node\Riot Games\RADS" /v "LocalRootFolder"') DO set "LocalRootFolder=%%B\solutions\lol_game_client_sln\releases"
FOR /F "delims=" %%i IN ('dir "%LocalRootFolder%" /b /ad-h /t:c /od') DO SET ver=%%i
CD %LocalRootFolder%\%ver%\deploy\
START "" "League of Legends.exe" "8394" "LoLLauncher.exe" "" "spectator spectator.na.lol.riotgames.com:80 Z8B50IqAr1iws/+A509WzfXPH58b4CQR 3331163641 NA1" "-UseRads"

Z8B50IqAr1iws/+A509WzfXPH58b4CQR = encryption key
3331163641 = gameId

@ELRECO the encryption key and the gameId
[19:07] Dart: you get them from spectator-v4
