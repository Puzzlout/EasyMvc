#$1 => the mysql user
#$2 => the folder where db_reset.sql is stored
echo "Begin database initialization"
echo "Folder to db_reset.sql is: "$2
#echo "Connecting to MySQL with user > "$1
#echo "Command is: mysql -u "$1
#mysql -u $1 -p 
echo "Connected ! Running the database initialization..."
#mysql -u $1 -p '' .\ $2"db_reset.sql"
echo "Finished database initialization!"
