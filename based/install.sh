#!/bin/bash

./yii migrate
./yii migrate --migrationPath=@yii/rbac/migrations

./yii migrate --migrationPath=@app/modules/auth/migrations
./yii auth/create --name=auth/auth --login=webmaster
./yii auth/create --name=auth/role --login=webmaster
./yii auth/create --name=auth/permission --login=webmaster

./yii auth/create --name=default --methods=index --login=webmaster
./yii auth/create --name=imperavi/manage --methods=FileUpload,FileList,ImageUpload,ImageList,PageList --login=webmaster

./yii migrate --migrationPath=@app/modules/language/migrations
./yii auth/create --name=language/manage --login=webmaster

./yii migrate --migrationPath=@app/modules/translation/migrations
./yii auth/create --name=translation/manage --login=webmaster

./yii migrate --migrationPath=@app/modules/page/migrations
./yii auth/create --name=page/manage --login=webmaster

./yii migrate --migrationPath=@app/modules/magic/migrations
./yii auth/create --name=magic/manage --methods=upload,update,delete --login=webmaster
