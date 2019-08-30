# Blog
[![Bake Status](https://secure.travis-ci.org/cakephp/cakephp.png?branch=master)](https://travis-ci.org/cakephp/cakephp) 
[![Code consistency](https://squizlabs.github.io/PHP_CodeSniffer/analysis/cakephp/cakephp/grade.svg)](https://squizlabs.github.io/PHP_CodeSniffer/analysis/cakephp/cakephp/)

A simple blog Web App with both authors and admin users, using CakePHP Framework 2.10.12

This is my first CakePHP Project.

# Technical Assumptions
Admin can add comments on posts (e.g moderating comments..)

# PHPUnit Testing
- Model Testing applied on all models, can be accessed using "localhost/blog/tests.php"
- Controller Testing Examples are added to Posts Controller Test

# Restful APIs
Example on how to make Restful APIs along with the Web App Interface applied on posts/index in PostsController index function.

# To Serve Project
Rather than the normal steps to serve any CakePHP Project:
1. Create Schema Database (e.g blog..) with Collation Scheme in order to support Arabic. And add your database configurations to app/Config/database.php file.
2. Run the SQL statements in DBSchema.txt file in the root directory of the project, to create the requird tables and seed the roles needed to serve the Blog Web App successfully.