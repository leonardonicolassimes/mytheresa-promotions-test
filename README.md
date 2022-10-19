# Mytheresa Promotion Test

## Run 

``` php -S localhost:8000 -t public/ ```

## Test

``` vendor/bin/phpunit --filter=testShouldReturnArrayWithProducts ```

## Decisions taken

- I developed the api with Lumen because it is a light but complete framework.
- I used a Sqlite relational database, also because it is light but I have all the advantages of relational databases.
- In a real environment and not a challenge, I would use the AWS cloud, for example, and services such as RDS for relational databases or DinamoDB for NoSql and EKS.

