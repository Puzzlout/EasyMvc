echo "Begin database initialization"
SCRIPTPATH=$(dirname "$SCRIPT")
echo $SCRIPTPATH
# mysql -u "webdevjl" -p ""
mysql .\ /workspace/$SCRIPTPATH/db_reset.sql
echo "Finished database initialization"
