## TUTORIAL INSTALASI

- composer install
- php artisan optimize
- php artisan migrate:refresh

## TUTORIAL RUN
- php artisan serve

## CATATAN

- PHP, Laravel, Eloquent, Migration, JWT, MySql
- Example in postman at file vhiweb.postman_collection.json
- Link online demo [http://aisoft.id/vhiweb-test/](http://aisoft.id/vhiweb-test/)
- Link repo [github](https://github.com/rizkydwicmt/test-vhiweb)

## TASK LIST
- [x] Get Photos
- [x] Create Photo
- [x] Photo Detail
- [x] Update Photo
- [x] Delete Photo
- [x] Like Photo
- [x] Unlike Photo


## Example requests

- *[ POST ]* Registerasi User **[ No Auth Barrier ]**
- http://aisoft.id/vhiweb-test/api/user/register?email=rizkydwi.cmt2@gmail.com&password=kasihpass123&name=rizky dwi aditya

- *[ POST ]* Login User **[ No Auth Barrier ]**
- http://aisoft.id/vhiweb-test/api/user/login?password=kasihpass123&email=rizkydwi.cmt@gmail.com

- *[ POST ]* Logout User **[ With Auth Barrier ]**
- http://aisoft.id/vhiweb-test/api/user/logout

- *[ GET ]* User Data **[ With Auth Barrier ]**
- http://aisoft.id/vhiweb-test/api/user/

- *[ GET ]* Select All Photo **[ No Auth Barrier ]**
- http://aisoft.id/vhiweb-test/api/photos/

- *[ GET ]* Select Photo Detail By ID **[ No Auth Barrier ]**
- http://aisoft.id/vhiweb-test/api/photos/1

- *[ POST ]* Create Photo **[ With Auth Barrier ]**
- http://aisoft.id/vhiweb-test/api/photos
- **Attribute** add_foto (File), caption (Text), tags (Text)

- *[ PUT ]* Update Photo **[ With Auth Barrier ]**
- http://aisoft.id/vhiweb-test/api/photos/1?caption=caption dua&tags=tags dua

- *[ DELETE ]* Delete Photo **[ With Auth Barrier ]**
- http://aisoft.id/vhiweb-test/api/photos/1

- *[ POST ]* Like Photo **[ With Auth Barrier ]**
- http://aisoft.id/vhiweb-test/api/photos/1/like
- 1 = id_photo

- *[ POST ]* Unlike Photo **[ With Auth Barrier ]**
- http://aisoft.id/vhiweb-test/api/photos/1/unlike
- 1 = id_photo