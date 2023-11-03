# bee-test

1. Please install Docker and Warden from warden.dev.
2. Clone the project.
3. Please open terminal and generate certificate with next command: warden sign-certificate exampleproject.test
4. Enter in terminal: warden env up.
5. warden shell
6. composer install
7. mysql -uroot -pmagento -hdb
8. source magento.sql (this dump is in project core folder)
9. bin/magento setup:upgrade && bin/magento s:d:c && bin/magento s:s:d -f

After this you can check the form on following path: https://bee-test.test/bee_search/index/index
Admin will be available on: https://bee-test.test/admin. Both Login and password: admin123
