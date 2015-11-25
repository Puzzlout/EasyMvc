echo "Begin database initialization"
SCRIPTPATH=$(dirname "$SCRIPT")
echo $SCRIPTPATH
mysql -u "webdevjl" -p "jUL%C9%15"
mysql .\ /workspace/$SCRIPTPATH/db_reset.sql
echo "Finished database initialization"
