# .fly/scripts/1_storage_init.sh

# Add this below the storage folder initialization snippet
FOLDER=/var/www/html/storage/database
if [ ! -d "$FOLDER" ]; then
    echo "$FOLDER is not a directory, initializing database"
    mkdir $FOLDER
    touch $FOLDER/database.sqlite
fi
