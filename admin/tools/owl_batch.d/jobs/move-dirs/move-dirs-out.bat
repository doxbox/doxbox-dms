@echo off
rem ***********************************************************
rem * move-dirs-out.bat - Reorganize Owl distribution folders
rem * 
rem * Author: Robert Geleta   www.rgeleta.com
rem * 
rem ***********************************************************

echo Reorganizing folder configuration from distribution to working

rem ********************************************************
rem *** Initialize variables
rem ********************************************************

echo 000 initialize names

SET owl_name_package=owl-1.10

SET owl_name_container=owl_current

SET owl_name_webserver_root=public_html

echo -------------------------------------------------------

rem ********************************************************
rem *** Verify distribution package is in current folder
rem ********************************************************
 
echo 100 standardizing package name

if not exist %owl_name_package%\NUL goto 801_missing_package
rename %owl_name_package% Intranet

rem ********************************************************
rem *** Make new distribution container
rem ********************************************************

echo 120 make new distribution container

if exist %owl_name_container%\NUL goto 802_container_exists
mkdir %owl_name_container%

echo -------------------------------------------------------

rem ********************************************************
rem *** Relocate batch jobs folder
rem ********************************************************

echo 200 move owl_batch.d folder
move Intranet\admin\tools\owl_batch.d %owl_name_container%\

echo -------------------------------------------------------

rem ********************************************************
rem *** Make miscellaneous container and move folders
rem ********************************************************

echo 300 move miscellaneous documentation directories

echo 310 make misc dir
mkdir %owl_name_container%\owl_misc.d

echo 320 move DOCS
move Intranet\DOCS %owl_name_container%\owl_misc.d\

echo 330 move CONTRIB
move Intranet\CONTRIB %owl_name_container%\owl_misc.d\

echo 340 move TODO
move Intranet\TODO %owl_name_container%\owl_misc.d\

echo -------------------------------------------------------

rem ********************************************************
rem *** Make data container and move folders
rem ********************************************************

echo 500 move data directories

echo 510 make owl_repos.d
mkdir %owl_name_container%\owl_repos.d

echo 520 move Trashcan
move Intranet\TrashCan %owl_name_container%\owl_repos.d\

echo 530 make repo_0
mkdir %owl_name_container%\owl_repos.d\owl_repo_0.d

echo 540 move Documents to owl_repo_0.d
move Intranet\Documents  %owl_name_container%\owl_repos.d\owl_repo_0.d\

echo -------------------------------------------------------

rem ********************************************************
rem *** Make webserver container and move webserver files
rem ********************************************************

echo 610 make webserver directory
mkdir %owl_name_container%\%owl_name_webserver_root%

echo 620 move Intranet to webserver root
move Intranet %owl_name_container%\%owl_name_webserver_root%


echo -------------------------------------------------------

rem ********************************************************
rem *** Make customizations container
rem ********************************************************

echo 700 make customizations folders
mkdir _customizations
mkdir _customizations\Intranet
mkdir _customizations\Intranet\config
mkdir _customizations\Intranet\templates
mkdir _customizations\Intranet\locale
mkdir _customizations\owl_batch.d
mkdir _customizations\owl_batch.d\configs

echo 790 move customizations folder
move _customizations %owl_name_container%\

goto 999_end

rem ********************************************************
rem *** Error message display and exit routines
rem ********************************************************

:801_missing_package
echo folder %owl_name_package% missing
goto 999_exit

:802_container_exists
echo folder %owl_name_container% already exists
goto 999_exit


rem ********************************************************
rem *** Exit
rem ********************************************************
:999_exit
rem set
echo done

