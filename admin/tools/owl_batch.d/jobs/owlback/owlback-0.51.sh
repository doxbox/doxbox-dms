#!/bin/sh
# owlbackup version 0.51 
# written by Aaron Sullivan (as7274@sbc.com)

# Set initial variables  
CWD=/
datevar=`/bin/date '+%m-%d-%G-%H-%M-%S'`
deftempdir='/tmp/owlbackup'
defdbdir='/var/lib/mysql/intranet'
defdocdir='/var/www/html/intranet/Documents'
defintradir='/var/www/html/intranet'
defowltmpdir='/tmp'
deftrashdir='/var/www/html/intranet/TrashCan'
defmysqldbname='intranet'
faildir='does not exist. Ensure all specified directories exist before running script.  Exiting...'
passdir='exists, continuing...'

# Gather backup directories and other variables interactively

echo ""
echo "###############################################"
echo "####### OWL Interactive Backup Program ########"
echo "###############################################"
echo ""
echo -n "Enter directory containing MySQL database [$defdbdir]: "
read dbdir
if [ -z "$dbdir" ];
	then
	dbdir=$defdbdir
fi
echo -n "Enter MySQL database name [$defmysqldbname]: "
read mysqldbname
if [ -z "$mysqldbname" ];
	then
	mysqldbname=$defmysqldbname
fi
echo -n "Are you storing your documents in the database or on the filesystem? [db/fs]: "
read docordb
until [ "$docordb" = "db" -o "$docordb" = "fs" ];
	do
	echo -n "Are you storing your documents in the database or on the filesystem? [db/fs]: "
	read docordb
done
if [ "$docordb" = "db" ];
	then continue
elif [ "$docordb" = "fs" ];
	then
	echo -n "Enter directory containing OWL Documents [$defdocdir]: "
	read docdir
		if [ -z "$docdir" ];
		then
		docdir=$defdocdir
		fi
fi
echo -n "Enter directory containing OWL intranet directory [$defintradir]: "
read intradir
if [ -z "$intradir" ];
	then
	intradir=$defintradir
fi
#echo -n "Enter directory containing OWL TMP directory [$defowltmpdir]: "
#read owltmpdir
#if [ -z "$owltmpdir" ];
#	then
#	owltmpdir=$defowltmpdir
#fi
echo -n "Enter directory containing OWL TrashCan [$deftrashdir]: "
read trashdir
if [ -z "$trashdir" ];
	then
	trashdir=$deftrashdir
fi
echo -n "Enter temporary directory where files will store while backup is processing [$deftempdir]: "
read tempdir
if [ -z "$tempdir" ];
        then
        tempdir=$deftempdir
fi
echo -n "Enter final backup destination directory: "
read destdir
while [ -z "$destdir" ];
do
        echo "You MUST input a final backup destination directory"
        echo -n "Enter final backup destination directory:"
        read destdir
done

echo ""
echo "You can opt to compress your backup files so that they use less space on their final destination volume."
echo "However, using compression will cause the backup to take more time to complete and makes it harder for"
echo "this script to determine how much space will be needed in your temporary working/storage directory as"
echo "well as in your final destination volume.  If you use compression, estimates will be offerred as to how"
echo "much space will be needed, but depending on the content of your backup, they may or may not be accurate."
echo ""
echo -n "Would you like to use compression? [y/n]: "

read compression
until [ "$compression" = "y" -o "$compression" = "n" ];
	do
	echo -n "Would you like to use compression? [y/n]: "
	read compression
done

if [ "$compression" = "n" ];
	then
	docomp=0
elif [ "$compression" = "y" ];
	then
	docomp=1
fi

# Verify that interactive variables were input accurately

echo "Please verify your input:"
echo ""
echo "MySQL database directory:		$dbdir"
echo "MySQL database name:			$mysqldbname"

if [ "$docordb" = "fs" ]; # Only echo documents directory verification if filesystem storage is being used
	then
	echo "OWL documents directory:		$docdir"
fi

echo "OWL intranet directory:			$intradir"
#echo "OWL TMP directory:			$owltmpdir"
echo "OWL TrashCan directory:			$trashdir"
echo "Temporary working/storage directory:	$tempdir"
echo "Final backup destination:		$destdir"

if [ "$docomp" = "0" ];
	then
	echo "Compression will be used:		no"
elif [ "$docomp" = "1" ];
	then
	echo "Compression will be used:		yes"
fi

echo ""

# Eval user input on variables to continue

echo -n "Is this correct? [y/n]:"
read cont

if [ "$cont" = "y" ];
        then continue
elif [ "$cont" != "y" ];
	then        
	echo "Cancelling"
        exit 0
fi

echo ""
echo "You selected '$cont', so we'll continue"
echo ""

# Check to make sure that variables input by user exist

echo "Checking to see if MySQL database and specified directories exist"
echo ""

echo "Checking for MySQL database directory"

if [ ! -d "$dbdir" ];
        then
        echo "$dbdir $faildir"
        exit 0
else
        echo "$dbdir $passdir"
fi

echo "Checking for MySQL database by name"

if /usr/bin/mysql -e quit $mysqldbname &>/dev/null
	then
	echo "$mysqldbname exists, continuing..."
else
	echo "$mysqldbname does not exist. Ensure that the database exists before running script.  Exiting..."
	exit 0
fi

if [ "$docordb" = "fs" ];
	then
	echo "Checking for OWL documents directory"
		if [ ! -d "$docdir" ];
        		then
        		echo "$docdir $faildir"
        		exit 0
		else
        		echo "$docdir $passdir"
		fi
fi

#echo "Checking for OWL TMP directory"

#if [ ! -d "$owltmpdir" ];
#        then
#        echo "$owltmpdir $faildir"
#        exit 0
#else
#        echo "$trashdir $passdir"
#fi

echo "Checking for OWL TrashCan directory"

if [ ! -d "$trashdir" ];
        then
        echo "$trashdir $faildir"
        exit 0
else
        echo "$trashdir $passdir"

fi

echo "Checking for Temporary working/storage directory"

if [ ! -d "$tempdir" ];
        then
        echo "$tempdir $faildir"
        exit 0
else
        echo "$tempdir $passdir"
fi

echo "Checking for Final backup destination"

if [ ! -d "$destdir" ];
        then
        echo "$destdir $faildir"
        exit 0
else
        echo "$destdir $passdir"
fi

# Check for available disk space 

echo ""
echo "Checking if there is sufficient disk space available for backup"

if [ "$docomp" = "0" ]; # In case compression isn't used we'll calculate current, temp, and final usage reqs.
	then
		if [ "$docordb" = "fs" ]; # Calculation of diskusage variable dependent upon use of fs or db
			then
			fsdiskusage=`du -kcs $dbdir $docdir $trashdir | grep total | awk '{ printf "%.f", $1 }'`
			dbdumpusage=`du -kcs $dbdir | grep total | awk '{ printf "%.f", $1 }'`
			diskneededtemp1=`echo $fsdiskusage | awk '{ printf "%.f", $0*1.01 }'`
			diskneededtemp=`expr $dbdumpusage + $diskneededtemp1`
			diskneededfinal=$diskneededtemp
			else
			fsdiskusage=`du -kcs $dbdir $trashdir | grep total | awk '{ printf "%.f", $1 }'`
			dbdumpusage=`du -kcs $dbdir | grep total | awk '{ printf "%.f", $1 }'`
			diskneededtemp1=`echo $fsdiskusage | awk '{ printf "%.f", $0*1.01 }'`
			diskneededtemp=`expr $dbdumpusage + $diskneededtemp1`
			diskneededfinal=$diskneededtemp
			fi
fi

if [ "$docomp" = "1" ]; # In case compression is used we'll calculate current, temp, and final usage reqs.
	then
		if [ "$docordb" = "fs" ]; # Calculation of diskusage variable dependent upon use of fs or db
			then
			fsdiskusage=`du -kcs $dbdir $docdir $trashdir | grep total | awk '{ printf "%.f", $1 }'`
			dbdumpusage=`du -kcs $dbdir | grep total | awk '{ printf "%.f", $1*0.62 }'`
			diskneededtemp1=`echo $fsdiskusage | awk '{ printf "%.f", $0*1.38 }'`
			diskneededtemp2=`echo $fsdiskusage | awk '{ printf "%.f", $0*.62 }'`
			diskneededtemp=`expr $dbdumpusage + $diskneededtemp1`
			diskneededfinal=`expr $dbdumpusage + $diskneededtemp2`
			else
			fsdiskusage=`du -kcs $dbdir $trashdir | grep total | awk '{ printf "%.f", $1 }'`
			dbdumpusage=`du -kcs $dbdir | grep total | awk '{ printf "%.f", $1*0.62 }'`
			diskneededtemp1=`echo $fsdiskusage | awk '{ printf "%.f", $0*1.38 }'`
			diskneededtemp2=`echo $fsdiskusage | awk '{ printf "%.f", $0*.62 }'`
			diskneededtemp=`expr $dbdumpusage + $diskneededtemp1`
			diskneededfinal=`expr $dbdumpusage + $diskneededtemp2`
			fi
fi

tempdiskavl=`df -k $tempdir | grep / | awk '{ printf "%.f", $4 }'`
finaldiskavl=`df -k $destdir | grep / | awk '{ printf "%.f", $4 }'`

echo ""

echo "Current disk usage by OWL:                                                $fsdiskusage KB"
echo "Approx. Space temporarily needed while processing backup:                 $diskneededtemp KB"
echo "Approx. Space on partition homing temp directory:                         $tempdiskavl KB"
echo "Approx. Space required by backup once complete:                           $diskneededfinal KB"
echo "Approx. Space on partition homing final backup destination directory:     $finaldiskavl KB"

echo ""

if [ $diskneededtemp -gt $tempdiskavl ];
        then
        tmpdiskissue=1
        echo "You probably don't have enough disk space on the partition homing your temporary working/storage directory"
        echo ""
fi

if [ $diskneededfinal -gt $finaldiskavl ];
        then
        finaldiskissue=1
        echo "You probably don't have enough disk space on the partition homing your final backup destination"
        echo ""
fi

if [ "$tmpdiskissue" = "1" -o "$finaldiskissue" = "1" ];
        then
        echo -n "Do you want to continue anyway? [y/n]: "
        read diskissueresp
        echo ""
                if [ "$diskissueresp" != "y" ];
                        then
                        echo "Cancelling"
                        exit 0
                fi
                if [ "$diskissueresp" = "y" ];
                        then
                        echo "You may need to clean out your temp storage/working and final destination directory manually if the backup fails..."
                fi
fi


# Final verification before launching script

echo ""
echo -n "Everything appears to be in order, shall we proceed with the backup? [y/n]:"
unset cont
read cont

if [ "$cont" = "y" ];
        then
	echo "This can be very time consuming.  Please wait..."
	continue
elif [ "$cont" != "y" ];
	then
        echo "Cancelling"
        exit 0
fi

echo "#######beginning owlbackup script#######" >> /$tempdir/results-$datevar 2>&1

echo "" >> /$tempdir/results-$datevar 2>&1

echo "#######making backup directory#######" >> /$tempdir/results-$datevar 2>&1
/bin/mkdir -v /$destdir//$datevar >> /$tempdir/results-$datevar 2>&1
echo "#######backup directory creation complete" >> /$tempdir/results-$datevar 2>&1

echo "" >> /$tempdir/results-$datevar 2>&1

echo "#######archive operations#######" >> /$tempdir/results-$datevar 2>&1

echo "##archiving owl data directores##" >> /$tempdir/results-$datevar 2>&1
/bin/tar -cv -f /$tempdir/owl_data.tar /$docdir /$trashdir >> /$tempdir/results-$datevar 2>&1
echo "##archiving command for owl data directory complete##" >> /$tempdir/results-$datevar 2>&1

echo "##archiving owl database files##"  >> /$tempdir/results-$datevar 2>&1
/bin/tar -cv -f /$tempdir/owl_database.tar /$dbdir/ >> /$tempdir/results-$datevar 2>&1
echo "##archiving command for owl database complete##" >> /$tempdir/results-$datevar 2>&1

echo "##archiving owl web instance##" >> /$tempdir/results-$datevar 2>&1
/bin/tar -cv -f /$tempdir/owl_intranet.tar /$intradir --exclude --exclude /$trashdir --exclude /$docdir >> /$tempdir/results-$datevar 2>&1
echo "##archiving command for owl web instance complete##" >> /$tempdir/results-$datevar 2>&1

echo "#######archive operations complete#######" >> /$tempdir/results-$datevar 2>&1

echo "" >> /$tempdir/results-$datevar 2>&1

if [ "$docomp" = "0" ]; # If compression disabled, just perform mysqldump
        then

                echo "#######performing mysqldump of $mysqldbname#######" >> /$tempdir/results-$datevar 2>&1
                /usr/bin/mysqldump --opt intranet > /$tempdir/$mysqldbname.sql
                        if [ -f /$tempdir/$mysqldbname.sql ];
                                then
                                echo "#######mysqldump complete#######" >> /$tempdir/results-$datevar 2>&1
                        else
                                echo "#######mysqldump failed#######" >> /$tempdir/results-$datevar 2>&1
                        fi

elif [ "$docomp" = "1" ]; # If compression enabled, compress files, mysqldump
	then

		echo "#######compression operations#######" >> /$tempdir/results-$datevar 2>&1

		echo "##bzipping owl_data.tar##" >> /$tempdir/results-$datevar 2>&1
		/usr/bin/bzip2 -v /$tempdir/owl_data.tar >> /$tempdir/results-$datevar 2>&1
		echo "##bzip2 operation for owl_data.tar complete##" >> /$tempdir/results-$datevar 2>&1

		echo "##bzipping owl_database.tar##" >> /$tempdir/results-$datevar 2>&1
		/usr/bin/bzip2 -v /$tempdir/owl_database.tar >> /$tempdir/results-$datevar 2>&1
		echo "##bzip2 operation for owl_database.tar complete##" >> /$tempdir/results-$datevar 2>&1

		echo "##bzipping owl_intranet.tar##" >> /$tempdir/results-$datevar 2>&1
		/usr/bin/bzip2 -v /$tempdir/owl_intranet.tar >> /$tempdir/results-$datevar 2>&1
		echo "##bzip2 operation for owl_intranet.tar complete##" >> /$tempdir/results-$datevar 2>&1

		echo "#######compression operations complete#######" >> /$tempdir/results-$datevar 2>&1

		echo "#######performing mysqldump of $mysqldbname and compressing#######" >> /$tempdir/results-$datevar 2>&1
		/usr/bin/mysqldump --opt intranet | bzip2 -cz > /$tempdir/$mysqldbname.sql.bz2
			if [ -f /$tempdir/$mysqldbname.sql.bz2 ];
				then
				echo "#######mysqldump and compression complete#######" >> /$tempdir/results-$datevar 2>&1
			else
				echo "#######mysqldump and/or compression failed#######" >> /$tempdir/results-$datevar
			fi

fi

echo "" >> /$tempdir/results-$datevar 2>&1

echo "#######moving files#######" >> /$tempdir/results-$datevar 2>&1
/bin/mv -v /$tempdir/owl_data.* /$destdir//$datevar/ >> /$tempdir/results-$datevar 2>&1
/bin/mv -v /$tempdir/owl_database.* /$destdir//$datevar/ >> /$tempdir/results-$datevar 2>&1
/bin/mv -v /$tempdir/owl_intranet.* /$destdir//$datevar/ >> /$tempdir/results-$datevar 2>&1
/bin/mv -v /$tempdir/$mysqldbname.* /$destdir//$datevar/ >> /$tempdir/results-$datevar 2>&1
/bin/mv -v /$tempdir/results-$datevar /$destdir//$datevar/ >> /$destdir//$datevar/results-$datevar 2>&1
echo "#######moving operations complete#######" >> /$destdir//$datevar/results-$datevar 2>&1

echo "" >> /$destdir//$datevar/results-$datevar 2>&1

echo "#######removing old backups#######" >> /$destdir//$datevar/results-$datevar 2>&1

echo "##backup directories to be deleted (assume there are none to be deleted if empty)##" >> /$destdir//$datevar/results-$datevar 2>&1
/usr/bin/find /$destdir/ -type d \! -iname 'lost*' \! -iname 'san' -mtime +31 >> /$destdir//$datevar/results-$datevar 2>&1

echo "##deleting backup directories##" >> /$destdir//$datevar/results-$datevar 2>&1

/usr/bin/find /$destdir/ -type d \! -iname 'lost*' \! -iname 'san' -mtime +31 | /usr/bin/xargs rm -r

echo "#######removing old backups operations complete#######" >> /$destdir//$datevar/results-$datevar 2>&1

echo "" >> /$destdir//$datevar/results-$datevar 2>&1

echo "#######finished#######" >> /$destdir//$datevar/results-$datevar 2>&1

echo "#######you may find a log of the backup's activity in "$destdir/""$datevar""/results-$datevar"########"

exit 0
